<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recipe_model extends CI_model
{
    public function getAllRecipe($id)
    {
        $this->db->select('tbl_recipe.*, tbl_product.name as p_name, tbl_trx_stuff.name as s_name, tbl_satuan.nama_satuan');
        $this->db->from('tbl_recipe');
        $this->db->join('tbl_product', 'tbl_recipe.product_id = tbl_product.id');
        $this->db->join('tbl_trx_stuff', 'tbl_recipe.stuff_id = tbl_trx_stuff.id');
        $this->db->join('tbl_satuan', 'tbl_trx_stuff.unit_id = tbl_satuan.id');
        $this->db->where('tbl_recipe.product_id', $id);
        return $this->db->get()->result_array();
    }

    public function addRecipe(array $data)
    {
        $this->db->insert('tbl_recipe', $data);
    }

    public function editRecipe($id, array $data)
    {
        $this->db->update('tbl_recipe', $data, array('id' => $id));
    }

    public function deleteRecipe($id)
    {
        $this->db->delete('tbl_recipe', ['id' => $id]);
    }
}