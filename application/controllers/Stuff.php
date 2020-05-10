<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stuff extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Satuan_model','satuan');
        $this->load->model('Stuff_model', 'stuff');
    }

    public function index()
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
            $this->load->view('Stuff', $data);
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
            redirect('Stuff');
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
            $this->load->view('Stuff', $data);
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
            redirect('Stuff');
        }
    }

    public function deleteStuff($id)
    {
        $this->trx->deleteTrxBeli($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('Stuff');
    }
}