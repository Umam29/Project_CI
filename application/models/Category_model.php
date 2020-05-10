<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_model
{
    public function getAll()
    {
        return $this->db->get('tbl_category')->result_array();
    }

    public function addCategory(array $data){
        $this->db->insert('tbl_category', $data);
    }

    public function editCategory($id, array $data)
    {
        $this->db->update('tbl_category', $data, array('id' => $id));
    }

    public function deleteCategory($id)
    {
        $this->db->delete('tbl_category', ['id' => $id]);
    }

}