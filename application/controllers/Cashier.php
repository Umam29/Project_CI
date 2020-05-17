<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('cart');
        $this->load->model('Recipe_model', 'recipe');
        $this->load->model('Stuff_model', 'stuff');
        $this->load->model('Sale_model', 'sale');
        $this->load->model('Product_model', 'product');
    }

    public function index()
    {
        $data['title'] = 'Sale';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['product'] = $this->product->getAllProduct();
        $data['struck_no'] = $this->sale->getStruckNo();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('cashier/index', $data);
        $this->load->view('templates/footer');
    }

    public function addCart()
    {
       
        $product_id = $_POST["id"];
        $qty = $_POST["qty"];

        $recipe = $this->recipe->getAllRecipe($product_id);

        $i = 0;

        foreach ($recipe as $res) {
            $stock_stuff = $res['s_stock'];
            $measure = $qty * $res['measure'];

            if ($measure > $stock_stuff) {
                $i++;
                break;
            } else {
                $this->stuff->editStuff($res['stuff_id'], ['stock' => ($stock_stuff - $measure)]);
            }
        }

        if ($i > 0) {
            echo '<div class="alert alert-danger" role="alert">Limited Stock</div>';
        } else {    
            $data = array(
                "id" => $product_id,
                "name" => $_POST["product_name"],
                "price" => $_POST["price"],
                "qty" => $qty
            );

            $this->cart->insert($data);
        }
        echo $this->showCart();
    }

    public function loadCart()
    {
        echo $this->showCart();
    }

    public function removeCart()
    {
       
        $row_id = $_POST["row_id"];
        $cart = $this->cart->get_item($row_id);

        $recipe = $this->recipe->getAllRecipe($cart['id']);
    
        $qty = $cart['qty'];

        foreach ($recipe as $value) {
            $stock_stuff = $value['s_stock'];
            $measure = $qty * $value['measure'];

            $this->stuff->editStuff($value['stuff_id'], ['stock' => ($stock_stuff + $measure)]);
        }

        $data = array(
            'rowid' => $row_id,
            'qty' => 0
        );
        $this->cart->update($data);
        echo $this->showCart();
    }

    public function addSale()
    {
        $struck_no = $this->sale->getStruckNo();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d H:i:s');
        $total = $this->cart->total();
        $payfee = $this->input->post('payfee');
        $change = $this->input->post('change');
        $user = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        $cashier = $user['name'];
        $cart = $this->cart->contents();

        $data_sale = [
            'struck_no' => $struck_no,
            'date' => $date,
            'total' => $total,
            'payfee' => $payfee,
            'change' => $change,
            'cashier' => $cashier
        ];

        $this->sale->addSale($data_sale);

        foreach ($cart as $item) {
            $data_sale_detail = [
                'struck_no' => $struck_no,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'total' => $item['subtotal']
            ];

            $this->sale->addSaleDetail($data_sale_detail);
        }

        $disp = [
            'struck_no' => $struck_no,
            'cart' => $cart,
            'total' => $total,
            'payfee' => $payfee,
            'change' => $change,
            'date' => $date,
            'cashier' => $cashier
        ];

        $this->printBill($disp);
        $this->cart->destroy();
        redirect('cashier');
    }

    public function history()
    {
        $data['title'] = 'History';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        $data['sales'] = $this->sale->getSale();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('cashier/history', $data);
        $this->load->view('templates/footer');
    }

    public function printBill(array $data)
    {
        $this->load->view('cashier/print', $data);
    }

    public function showCart()
    {
        $this->load->library('cart');
        $output = '';
        $output .= '
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
        ';

        $count = 0;
        foreach ($this->cart->contents() as $item) {
            $count++;
            $output .= '
                    <tr>                    
                        <td>'. $item["name"] .'</td>
                        <td>Rp. '. number_format($item["price"],2,',','.') .'</td>
                        <td>'. $item["qty"] .'</td>
                        <td>Rp. '. number_format($item["subtotal"],2,',','.') .'</td>
                        <td>
                            <button type="button" name="remove" class="btn btn-danger remove_inventory" id="'. $item["rowid"] .'">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
            ';
        }
        $output .= '
                    <tr>
                        <td colspan="4" align="center">Total</td>
                        <td>Rp. '. number_format($this->cart->total(),2,',','.') .'</td>
                    </tr>
                </tbody>
            </table>
            <form action="'. base_url() .'cashier/addSale" method="post" target="_blank">
            <table>
                <tr>
                    <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg"> Pay</button></td>
                    <th style="width:140px;">Total to Pay(Rp)</th>
                    <th style="text-align:right;width:200px;"><input type="text" name="total2" id="total2" value="'. $this->cart->total() .'" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                    <input type="hidden" id="total" name="total" value="'. $this->cart->total() .'" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                </tr>
                <tr>
                    <th>Payfee(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="payfee" name="payfee" class="payfee form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                </tr>
                <tr>
                    <td></td>
                    <th>Change(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="change" name="change" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                </tr>

            </table>
            </form>
        </div>
        ';

        if ($count == 0) {
            $output = '
            <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td colspan="5" align="center">Cart Is Empty</td>
                        </tr>
                    </tbody>
                </table>
                <form action="'. base_url() .'cashier/addSale" method="post" target="_blank">
                <table>
                <tr>
                    <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-info btn-lg"> Pay</button></td>
                    <th style="width:140px;">Total to Pay(Rp)</th>
                    <th style="text-align:right;width:200px;"><input type="text" name="total2" value="'. 0 .'" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                    <input type="hidden" id="total" name="total" value="'. 0 .'" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                </tr>
                <tr>
                    <th>Payfee(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="payfee" name="payfee" class="payfee form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                </tr>
                <tr>
                    <td></td>
                    <th>Change(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="change" name="change" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                </tr>

            </table>
            </form>
            </div>
            ';
        }

        return $output;
    }

}
