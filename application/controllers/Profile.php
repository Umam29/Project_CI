<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model','user');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('profile/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $name = $this->input->post('name');

            //cek jika ada gambar yang di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')) {
                    $old_img = $data['user']['image'];

                    if($old_img != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_img);
                    }

                    $new_img = $this->upload->data('file_name');
                    $user = ['image' => $new_img];
                    $this->db->set('image', $new_img);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('id', $id);
            $this->db->update('tbluser');
            
            // $this->user->editUser($id, $user);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Your Profile Has Been Updated!</div>');
            redirect('profile');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('CurrentPassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('NewPass1', 'New Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('NewPass2', 'Confirm New Password', 'required|trim|min_length[6]|matches[NewPass1]');

        if($this->form_validation->run() == false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('profile/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_pass = $this->input->post('CurrentPassword');
            $new_pass = $this->input->post('NewPass1');
            $id = $this->input->post('id');
            if (password_verify($current_pass,$data['user']['password'])) {
                if($current_pass == $new_pass) {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">New Password Cannot Be Same With Current Password!</div>');
                    redirect('profile/changepassword');
                } else {
                    $password_hash = password_hash($new_pass, PASSWORD_DEFAULT);

                    $data = ['password' => $password_hash];
                    $this->user->editUser($id, $data);
                    $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password Updated!</div>');
                    redirect('profile/changepassword');
                }
            } else {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
                redirect('profile/changepassword');
            }
        }
        
    }
}