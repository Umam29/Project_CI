<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Sale';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        $this->load->model('Product_model', 'product');

        $data['product'] = $this->product->getAllProduct();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('cashier/index', $data);
        $this->load->view('templates/footer');
    }

    public function addCart()
    {
        $this->load->library('cart');
        $data = array(
            "id" => $_POST["id"],
            "name" => $_POST["product_name"],
            "price" => $_POST["price"],
            "qty" => $_POST["qty"]
        );

        $this->cart->insert($data);
        echo $this->showCart();
    }

    public function loadCart()
    {
        echo $this->showCart();
    }

    public function removeCart()
    {
        $this->load->library('cart');
        $row_id = $_POST["row_id"];
        $data = array(
            'rowid' => $row_id,
            'qty' => 0
        );
        $this->cart->update($data);
        echo $this->showCart();
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
            </div>
            ';
        }

        return $output;
    }

}
