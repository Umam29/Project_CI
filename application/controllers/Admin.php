<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Report_model', 'report');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        date_default_timezone_set('Asia/Jakarta');
        $month = date('F Y');
        $year = date('Y');

        $data['total_month'] = $this->report->GetTotalByMonth($month)->row_array();
        $data['total_year'] = $this->report->GetTotalByYear($year)->row_array();
        $data['total_product'] = $this->report->GetTotalProduct()->row_array();
        $data['total_stuff'] = $this->report->GetTotalStuff()->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        $this->load->model('Role_model','role');

        $data['role'] = $this->role->getAllRole();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        }
        else {
            $list = ['role_name' => $this->input->post('role')];
            $this->role->addRole($list);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Role Added!</div>');
            redirect('admin/role');
        }
        
    }

    public function roleEdit($id)
    {
        $this->form_validation->set_rules('role_edit', 'Menu', 'required');
        $this->load->model('Role_model','role');

        $this->form_validation->set_rules('role_edit', 'Role', 'required');

        if ($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $list = [
                'role_name' => $this->input->post('role_edit')
            ];
            $this->role->editRole($id, $list);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been updated!</div>');
            redirect('admin/role');
        }
    }

    public function deleteRole($id)
    {
        $this->load->model('Role_model');
        $this->Role_model->deleteRole($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('admin/role');
    }

    public function roleAccess($id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        
        $this->load->model('Role_model','role');
        $this->load->model('Menu_model','menu');

        $data['role'] = $this->role->getRoleByID($id);
        $data['menu'] = $this->menu->getAllMenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');
        
        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $this->load->model('Role_model','role');
        $result = $this->role->getUserAccessMenu($data);

        if($result->num_rows() < 1) {
            $this->role->addAccessMenu($data);
        } else {
            $this->role->delAccessMenu($data);
        }

        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function showReport()
    {
        $data['title'] = 'Report';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();

        $data['month'] = $this->report->GetMonthSale();
        $data['year'] = $this->report->GetYearSale();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/report', $data);
        $this->load->view('templates/footer');
    }

    public function reportStuff()
    {
        $data['title'] = 'Report Stuff';
        $data['data'] = $this->report->GetStuffData();
        $this->load->view('report/stuff', $data);
    }

    public function reportProduct()
    {
        $data['title'] = 'Report Product';
        $data['data'] = $this->report->GetProductData();
        $this->load->view('report/product', $data);
    }

    public function reportSales()
    {
        $data['title'] = 'Report Sales';
        $data['data'] = $this->report->GetSalesData();
        $data['total'] = $this->report->GetTotal();
        $this->load->view('report/sales', $data);
    }

    public function reportSalesPerDate()
    {
        $data['title'] = 'Report Sales';

        $date = date("Y-m-d", strtotime($this->input->post('date')));

        $data['data'] = $this->report->GetSalesDataByDate($date);
        $data['total'] = $this->report->GetTotalByDate($date);
        $this->load->view('report/sales', $data);
    }

    public function reportSalesPerMonth()
    {
        $data['title'] = 'Report Sales';

        $month = $this->input->post('month');

        $data['data'] = $this->report->GetSalesDataByMonth($month);
        $data['total'] = $this->report->GetTotalByMonth($month);
        $this->load->view('report/sales', $data);
    }

    public function reportSalesPerYear()
    {
        $data['title'] = 'Report Sales';

        $year = $this->input->post('year');

        $data['data'] = $this->report->GetSalesDataByYear($year);
        $data['total'] = $this->report->GetTotalByYear($year);
        $this->load->view('report/sales', $data);
    }
}