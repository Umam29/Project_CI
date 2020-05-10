<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_model
{
    public function getAllProduct()
    {
        $this->db->select('tbl_product.*, tbl_product_category.name as pc_name')
        ->from('tbl_product')
        ->join('tbl_product_category', 'tbl_product.product_category_id = tbl_product_category.id');
        $this->db->order_by('tbl_product.product_category_id', 'asc');
        return $this->db->get()->result_array();
    }

    public function checkProductCode($code, $id = null)
    {
        $this->db->from('tbl_product');
        $this->db->where('product_code', $code);
        if ($id != null) {
            $this->db->where('id !=', $id);
        }
        return $this->db->get();
    }

    public function addProduct(array $data)
    {
        $this->db->insert('tbl_product', $data);
    }

    public function editProduct($id, array $data)
    {
        $this->db->update('tbl_product', $data, array('id' => $id));
    }

    public function deleteProduct($id)
    {
        $this->db->delete('tbl_product', ['id' => $id]);
    }

    public function getById($id)
    {
        return $this->db->get_where('tbl_product', ['id' => $id])->result_array();
    }
}