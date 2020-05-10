<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Satuan_model','satuan');
        $this->load->model('Transaksi_model', 'trx');
        $this->load->model('Stuff_model', 'stuff');
    }

    public function index()
    {
        $data['title'] = 'Purchasing';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['satuan'] = $this->satuan->getAllSatuan();
        $data['trx'] = $this->trx->getTrxBeli();
        $data['category'] = $this->trx->getCategory();
        
        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaction/purchase', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tblusermenu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Menu Added!</div>');
            redirect('menu');
        }
    }

    public function addBeli()
    {
        $data['title'] = 'Tambah Pembelian';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['satuan'] = $this->satuan->getAllSatuan();
        $data['trx'] = $this->trx->getTempTrx();

        $this->form_validation->set_rules('kode', 'Kode', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal', 'required');
        $this->form_validation->set_rules('barang', 'Barang', 'required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('id_satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaction', $data);
            $this->load->view('templates/footer');
        } else {
            $code = $this->input->post('kode');
            $tgl = $this->input->post('tgl');
            $barang = $this->input->post('barang');
            $category = $this->input->post('kategori');
            $satuan = $this->input->post('id_satuan');
            $is_total = $this->input->post('Radios');
            $harga = $this->input->post('harga');
            $jumlah = $this->input->post('jumlah');
            $desc = $this->input->post('desc');
            $harga_total;
            $harga_satuan;

            if ($is_total == "total") {
                $harga_total = $harga;
                $harga_satuan = $harga / $jumlah;
            } else {
                $harga_total = $harga * $jumlah;
                $harga_satuan = $harga;
            }

            $data = [
                'stuff_code' => $code,
                'tgl_beli' => $tgl,
                'nama_barang' => $barang,
                'category_id' => $category,
                'id_satuan' => $satuan,
                'jumlah' => $jumlah,
                'deskripsi' => $desc,
                'harga_total' => $harga_total,
                'harga_satuan' => $harga_satuan
            ];
            $this->db->insert('tbl_trx_beli', $data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been added!</div>');
            redirect('transaction');
        }
    }

    public function editPurchase($id)
    {
        $data['title'] = 'Purchasing';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['satuan'] = $this->satuan->getAllSatuan();
        $data['trx'] = $this->trx->getTrxBeli();
        $data['category'] = $this->trx->getCategory();

        $this->form_validation->set_rules('tgl_edit', 'Tanggal', 'required');
        $this->form_validation->set_rules('barang_edit', 'Barang', 'required');
        $this->form_validation->set_rules('kategori_edit', 'Kategori', 'required');
        $this->form_validation->set_rules('harga_edit', 'Harga', 'required');
        $this->form_validation->set_rules('id_satuan_edit', 'Satuan', 'required');
        $this->form_validation->set_rules('jumlah_edit', 'Jumlah', 'required');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('transaction', $data);
            $this->load->view('templates/footer');
        } else {
            $code = $this->input->post('kode_edit');
            $tgl = $this->input->post('tgl_edit');
            $barang = $this->input->post('barang_edit');
            $category = $this->input->post('kategori_edit');
            $satuan = $this->input->post('id_satuan_edit');
            $is_total = $this->input->post('Radios_edit');
            $harga = $this->input->post('harga_edit');
            $jumlah = $this->input->post('jumlah_edit');
            $desc = $this->input->post('desc_edit');
            $harga_total;
            $harga_satuan;

            if ($is_total == "total") {
                $harga_total = $harga;
                $harga_satuan = $harga / $jumlah;
            } else {
                $harga_total = $harga * $jumlah;
                $harga_satuan = $harga;
            }

            $data = [
                'stuff_code' => $code,
                'tgl_beli' => $tgl,
                'nama_barang' => $barang,
                'category_id' => $category,
                'id_satuan' => $satuan,
                'jumlah' => $jumlah,
                'deskripsi' => $desc,
                'harga_total' => $harga_total,
                'harga_satuan' => $harga_satuan
            ];
            $this->trx->editPurchase($id, $data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Purchasing Updated!</div>');
            redirect('transaction');
        }
    }

    public function deleteTrxBeli($id)
    {
        $this->trx->deleteTrxBeli($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('transaction');
    }

    public function stuff()
    {
        $data['title'] = 'Storage Stuff';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['satuan'] = $this->satuan->getAllSatuan();
        $data['stuff'] = $this->stuff->getAll();
        $data['category'] = $this->trx->getCategory();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Stuff/index', $data);
        $this->load->view('templates/footer');
    }

    public function addStuff()
    {
        $data['title'] = 'Add Stuff';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
       
        $data = [
            'stuff_code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'stock' => $this->input->post('stock'),
            'price' => $this->input->post('price'),
            'unit_id' => $this->input->post('unit'),
            'category_id' => $this->input->post('category')
        ];

        $code = $this->stuff->checkStuffCode($this->input->post('code'));

        if ($code->num_rows() > 0) {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Code Already Exists!</div>');
        } else {
            $this->stuff->addStuff($data);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been added!</div>');
        }        
        redirect('transaction/stuff');
    }

    public function editStuff($id)
    {
        $data['title'] = 'Edit Stuff';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['stuff'] = $this->stuff->getAll();

        $data = [
            'stuff_code' => $this->input->post('code_edit'),
            'name' => $this->input->post('name_edit'),
            'stock' => $this->input->post('stock_edit'),
            'price' => $this->input->post('price_edit'),
            'unit_id' => $this->input->post('unit_edit'),
            'category_id' => $this->input->post('category_edit')
        ];

        $code = $this->stuff->checkStuffCode($this->input->post('code'), $id);

        if ($code->num_rows() > 0) {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Code Already Exists!</div>');
        } else {
            $this->stuff->editStuff($id, $data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Stuff Updated!</div>');
        } 
        
        redirect('transaction/stuff');        
    }

    public function deleteStuff($id)
    {
        $this->stuff->deleteStuff($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('transaction/stuff');
    }

    public function StockIn()
    {
        $data['title'] = 'Add Stock';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
       
        $data['stuff'] = $this->stuff->getAll();

        $this->form_validation->set_rules('date_stock', 'Date', 'required');
        $this->form_validation->set_rules('code', 'Code', 'required');
        $this->form_validation->set_rules('stuff_name', 'Stuff', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('stock', 'Stock', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required');

        $this->load->model('Purchase_model', 'chase');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('Stuff/stockin', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'date' => date('Y-d-m', strtotime($this->input->post('date_stock'))),
                'stuff_id' => $this->input->post('id'),
                'qty' => $this->input->post('qty'),
                'description' => $this->input->post('desc'),
                'total_price' => ($this->input->post('price') * $this->input->post('qty'))
            ];

            $update = [
                'stock' => ($this->input->post('stock') + $this->input->post('qty'))
            ];
    
            $this->chase->addPurchase($data);
            $this->stuff->editStuff($this->input->post('id'), $update);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been added!</div>');
            redirect('transaction/historyStockIn');            
        }  
    }

    public function historyStockIn()
    {
        $data['title'] = 'Stock In';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
       
        $this->load->model('Purchase_model', 'chase');

        $data['purchase'] = $this->chase->getAll();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaction/history', $data);
        $this->load->view('templates/footer');
    }

    public function deletePurchase($id)
    {
        $this->load->model('Purchase_model', 'chase');
                
        $qty = $this->chase->getPurchaseById($id)->qty;
        $stuff_id = $this->chase->getPurchaseById($id)->stuff_id;
        $stock = $this->stuff->getStuffById($stuff_id)->stock;

        $decreaseStock = $stock - $qty;

        $this->stuff->editStuff($stuff_id, ['stock' => $decreaseStock]);
        $this->chase->deletePurchase($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('transaction/historyStockIn');
    }

    //FOR DUMMY
    public function cart()
    {
        // $data['title'] = 'Cart';
        // $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        // $this->load->view('transaction/cart');
        // $this->load->view('templates/footer');
        var_dump(date('Y-d-m', strtotime('01/04/2020')));
    }

    public function Dummy()
    {
        $data['title'] = 'Tes';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['satuan'] = $this->satuan->getAllSatuan();
        $data['category'] = $this->trx->getCategory();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaction/dummy');
        $this->load->view('templates/footer');
    }

    public function loadDataPurchase()
    {
        $data = $this->trx->getTrxBeli();
        echo json_encode($data);
    }
    //END DUMMY
}