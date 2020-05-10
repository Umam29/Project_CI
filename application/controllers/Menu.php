<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        $data['menu'] = $this->db->get('tblusermenu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');


        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tblusermenu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Menu Added!</div>');
            redirect('menu');
        }
    }

    public function delete($id)
    {
        $this->load->model('Menu_model');
        $this->Menu_model->deleteDataMenu($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('menu');
    }

    public function detail($id)
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        $this->load->model('Menu_model');
        $data['menu'] = $this->Menu_model->getMenuByID($id);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/detail', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('menu_edit', 'Menu', 'required');
        $this->load->model('Menu_model');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu', $data);
            $this->load->view('templates/footer');
        } else {
            $list = [
                'menu' => $this->input->post('menu_edit')
            ];
            $this->Menu_model->editMenu($id, $list);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been updated!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        $this->load->model('Menu_model','menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('tblusermenu')->result_array();

        $this->form_validation->set_rules('title', 'Submenu Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Submenu URL', 'required');
        $this->form_validation->set_rules('icon', 'Submenu Icon', 'required');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->menu->addSubMenu($data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Sub Menu Added!</div>');
            redirect('menu/submenu');
        }
        
    }

    public function editSubMenu($id)
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        $data['menu'] = $this->db->get('tblusermenu')->result_array();

        $this->form_validation->set_rules('title_edit', 'Submenu Title', 'required');
        $this->form_validation->set_rules('menu_id_edit', 'Menu', 'required');
        $this->form_validation->set_rules('url_edit', 'Submenu URL', 'required');
        $this->form_validation->set_rules('icon_edit', 'Submenu Icon', 'required');

        $this->load->model('Menu_model');

        $is_active = $this->input->post('is_active_edit');

        $is_active_val = 0;
        
        if (! empty($is_active)) {
            $is_active_val = 1;
        }

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title_edit'),
                'menu_id' => $this->input->post('menu_id_edit'),
                'url' => $this->input->post('url_edit'),
                'icon' => $this->input->post('icon_edit'),
                'is_active' => $is_active_val
            ];
            $this->Menu_model->editSubMenu($id, $data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Sub Menu Updated!</div>');
            redirect('menu/submenu');
        }
    }

    public function deleteSubMenu($id)
    {
        $this->load->model('Menu_model');
        $this->Menu_model->deleteSubMenu($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('menu/submenu');
    }
}