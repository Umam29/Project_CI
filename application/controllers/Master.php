<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Category_model', 'category');
        $this->load->model('Unit_model', 'unit');
    }

    public function index()
    {
        $data['title'] = 'Stuff Category';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['category'] = $this->category->getAll();

        $this->form_validation->set_rules('category', 'Category', 'required|trim');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/index', $data);
            $this->load->view('templates/footer');
        } else {
            $list = ['category' => $this->input->post('category')];
            $this->category->addCategory($list);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Category Added!</div>');
            redirect('master');
        }
    }

    public function editCategory($id)
    {
        $data['title'] = 'Stuff Category';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['category'] = $this->category->getAll();

        $this->form_validation->set_rules('category_edit', 'Category', 'required|trim');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/index', $data);
            $this->load->view('templates/footer');
        } else {
            $list = ['category' => $this->input->post('category_edit')];
            $this->category->editCategory($id, $list);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Category Updated!</div>');
            redirect('master');
        }
    }

    public function deleteCategory($id)
    {
        $this->category->deleteCategory($id);
        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Category Deleted!</div>');
        redirect('master');
    }

    public function unit()
    {
        $data['title'] = 'Unit';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['unit'] = $this->unit->getAll();

        $this->form_validation->set_rules('unit_name', 'Unit Name', 'required|trim');
        $this->form_validation->set_rules('unit', 'Unit', 'required|trim');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/unit', $data);
            $this->load->view('templates/footer');
        } else {
            $list = [
                'nama_satuan' => $this->input->post('unit_name'),
                'satuan' => $this->input->post('unit')
                
            ];
            $this->unit->addUnit($list);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Unit Added!</div>');
            redirect('master/unit');
        }
    }

    public function editUnit($id)
    {
        $data['title'] = 'Unit';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['unit'] = $this->unit->getAll();

        $this->form_validation->set_rules('unit_name_edit', 'Unit Name', 'required|trim');
        $this->form_validation->set_rules('unit_edit', 'Unit', 'required|trim');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('master/unit', $data);
            $this->load->view('templates/footer');
        } else {
            $list = [
                'nama_satuan' => $this->input->post('unit_name_edit'),
                'satuan' => $this->input->post('unit_edit')
                
            ];
            $this->unit->editUnit($id, $list);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Unit Updated!</div>');
            redirect('master/unit');
        }
    }

    public function deleteUnit($id)
    {
        $this->unit->deleteUnit($id);
        $this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Unit Deleted!</div>');
        redirect('master/unit');
    }
}