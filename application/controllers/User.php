<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model','user');
    }

    public function index()
    {
        $data['title'] = 'User Management';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        $data['users'] = $this->user->GetUserRoleAdmin();

        $this->load->model('Role_model', 'role');

        $data['role'] = $this->role->getRoleXadmin();
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $is_active = $this->input->post('is_active');

            $is_active_val = 0;
        
            if (! empty($is_active)) {
                $is_active_val = 1;
            }

            $data = [
                'name' => $this->input->post('name'),
                'user_name' => $this->input->post('username'),
                'password' => password_hash('000000', PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role'),
                'is_active' => $is_active_val,
                'date_created' => time()
            ];

            $this->user->AddUser($data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            New User Successfully Added</div>');
            redirect('user');
        }
        
    }

    public function edit($id)
    {
        $data['title'] = 'User Management';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        $data['users'] = $this->user->GetUserRoleAdmin();

        $this->load->model('Role_model', 'role');

        $data['role'] = $this->role->getRoleXadmin();
        
        $this->form_validation->set_rules('name_edit', 'Name', 'required');
        $this->form_validation->set_rules('username_edit', 'Username', 'required|trim');
        $this->form_validation->set_rules('role_edit', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $is_active = $this->input->post('is_active_edit');

            $is_active_val = 0;
        
            if (! empty($is_active)) {
                $is_active_val = 1;
            }

            $data = [
                'name' => $this->input->post('name_edit'),
                'user_name' => $this->input->post('username_edit'),
                'role_id' => $this->input->post('role_edit'),
                'is_active' => $is_active_val
            ];

            $this->user->editUser($id, $data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            User Data Successfully Updated</div>');
            redirect('user');
        }
    }

    public function delete($id)
    {
        $this->user->deleteUser($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">User data has been deleted!</div>');
        redirect('user');
    }

}