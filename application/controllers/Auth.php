<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false){
            $data['title'] = 'REBCONS - Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        }else{
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tblUser', ['user_name' => $username])->row_array();
     
        if($user){
            if($user['is_active'] == 1){
                if(password_verify($password,$user['password'])){
                    $data = [
                        'username' => $user['user_name'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if($user['role_id'] == 1){
                        redirect('admin');
                    }else {
                        redirect('user');
                    }
                    
                }else{
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    Wrong password!</div>');
                    redirect('auth');
                }
            }else{
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                This Username has not been activated!</div>');
                redirect('auth');
            }
        }else {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
            Username is not registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {

        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tblUser.user_name]', [
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'The password dont match!',
            'min_length' => 'The password too short! (min. 6)'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if($this->form_validation->run() == false)
        {
            $data['title'] = 'REBCONS - User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        }else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name',true)),
                'user_name' => htmlspecialchars($this->input->post('username',true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('tblUser', $data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
            Congratulation! your account has been created. Please Login!</div>');
            redirect('auth');
        }
    
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
        You have been logged out!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}