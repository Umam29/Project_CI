<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category_model extends CI_model
{
    public function getAllProductCategory()
    {
        return $this->db->get('tbl_product_category')->result_array();
    }

    public function editProductCategory($id, array $data)
    {
        $this->db->update('tbl_product_category', $data, array('id' => $id));
    }

    public function deleteProductCategory($id)
    {
        $this->db->delete('tbl_product_category', ['id' => $id]);
    }
}
