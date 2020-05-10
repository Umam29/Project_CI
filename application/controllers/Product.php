<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Product_model','product');
        $this->load->model('Product_category_model','pc');
    }

    public function index()
    {
        $data['title'] = 'Product';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        $data['product'] = $this->product->getAllProduct();
        $data['pc'] = $this->pc->getAllProductCategory();

        $this->form_validation->set_rules('code', 'Product Name', 'required');
        $this->form_validation->set_rules('name', 'Product Name', 'required');
        $this->form_validation->set_rules('category', 'Category', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/index', $data);
            $this->load->view('templates/footer');
        } else {
            $product = [
                'product_code' => $this->input->post('code'),
                'name' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'product_category_id' => $this->input->post('category')
            ];

            $code = $this->product->checkProductCode($this->input->post('code'));

            if ($code->num_rows() > 0) {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Code Already Exists!</div>');
            } else {
                $this->product->addProduct($product);
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Product Added!</div>');
            } 
            redirect('product');
        }
        
    }

    public function editProduct($id)
    {
        $data['title'] = 'Edit Product';

        $this->form_validation->set_rules('code_edit', 'Product Name', 'required');
        $this->form_validation->set_rules('name_edit', 'Product Name', 'required');
        $this->form_validation->set_rules('category_edit', 'Category', 'required');
        $this->form_validation->set_rules('price_edit', 'Price', 'required');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
            $data['product'] = $this->product->getAllProduct();
            $data['pc'] = $this->pc->getAllProductCategory();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/index', $data);
            $this->load->view('templates/footer');
        } else {
            $product = [
                'product_code' => $this->input->post('code_edit'),
                'name' => $this->input->post('name_edit'),
                'price' => $this->input->post('price_edit'),
                'product_category_id' => $this->input->post('category_edit')
            ];

            $code = $this->product->checkProductCode($this->input->post('code'), $id);

            if ($code->num_rows() > 0) {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Code Already Exists!</div>');
            } else {
                $this->product->editProduct($id, $product);
                $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Product Updated!</div>');
            }

            redirect('product');
        }
    }

    public function deleteProduct($id)
    {
        $this->product->deleteProduct($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('product');
    }

    public function productCategory()
    {
        $data['title'] = 'Product Category';
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        $data['pc'] = $this->pc->getAllProductCategory();

        $this->form_validation->set_rules('category', 'Category Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/category', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('tbl_product_category', ['name' => $this->input->post('category')]);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Product Category Added!</div>');
            redirect('product/productCategory');
        }
    }

    public function editProductCategory($id)
    {
        $data['title'] = 'Edit Product';

        $this->form_validation->set_rules('category_edit', 'Category Name', 'required');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
            $data['product'] = $this->product->getAllProduct();
            $data['pc'] = $this->pc->getAllProductCategory();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/productCategory', $data);
            $this->load->view('templates/footer');
        } else {
            $product_category = [
                'name' => $this->input->post('category_edit')
            ];

            $this->pc->editProductCategory($id, $product_category);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Product Category Updated!</div>');

            redirect('product/productCategory');
        }
    }

    public function deleteProductCategory($id)
    {
        $this->pc->deleteProductCategory($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('product/productCategory');
    }

    public function showRecipe($id)
    {
        $product = $this->product->getById($id);
        foreach ($product as $prod) {
            $data['title'] = 'Recipe '.$prod['name'];
            $data['prod_id'] = $prod['id'];
        }
        $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
        $this->load->model('Recipe_model', 'recipe');
        $data['recipe'] = $this->recipe->getAllRecipe($id);

        $this->load->model('Stuff_model', 'stuff');
        $data['stuff'] = $this->stuff->getAll();

        $this->form_validation->set_rules('stuff', 'Stuff', 'required');
        $this->form_validation->set_rules('measure', 'Measure', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/recipe', $data);
            $this->load->view('templates/footer');
        } else {
            $recipe_data = [
                'product_id' => $id,
                'stuff_id' => $this->input->post('stuff'),
                'measure' => $this->input->post('measure')
            ];

            $this->recipe->addRecipe($recipe_data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">New Recipe Added!</div>');

            redirect('product/showRecipe/'.$id);
        }
        
    }

    public function editRecipe($prod_id, $id)
    {
        $this->load->model('Recipe_model', 'recipe');
        $this->load->model('Stuff_model', 'stuff');
        $this->form_validation->set_rules('stuff_edit', 'Stuff', 'required');
        $this->form_validation->set_rules('measure_edit', 'Measure', 'required');

        if ($this->form_validation->run() == false) {
            $product = $this->product->getById($prod_id);
            foreach ($product as $prod) {
                $data['title'] = 'Recipe '.$prod['name'];
                $data['prod_id'] = $prod['id'];
            }
            $data['user'] = $this->db->get_where('tblUser', ['user_name' => $this->session->userdata('username')])->row_array();
            
            $data['recipe'] = $this->recipe->getAllRecipe($prod_id);
            $data['stuff'] = $this->stuff->getAll();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('product/recipe', $data);
            $this->load->view('templates/footer');
        } else {
            $recipe_data = [
                'stuff_id' => $this->input->post('stuff_edit'),
                'measure' => $this->input->post('measure_edit')
            ];

            $this->recipe->editRecipe($id, $recipe_data);
            $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Recipe Uptaded!</div>');

            redirect('product/showRecipe/'.$prod_id);
        }
        
    }

    public function deleteRecipe($prod_id, $id)
    {
        $this->load->model('Recipe_model', 'recipe');
        $this->recipe->deleteRecipe($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Record has been deleted!</div>');
        redirect('product/showRecipe/'.$prod_id);
    }
}