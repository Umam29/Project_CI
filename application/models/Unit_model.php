<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_model
{
    public function getAll()
    {
        return $this->db->get('tbl_satuan')->result_array();
    }

    public function addUnit(array $data){
        $this->db->insert('tbl_satuan', $data);
    }

    public function editUnit($id, array $data)
    {
        $this->db->update('tbl_satuan', $data, array('id' => $id));
    }

    public function deleteUnit($id)
    {
        $this->db->delete('tbl_satuan', ['id' => $id]);
    }

}