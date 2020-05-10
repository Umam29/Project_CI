<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stuff_model extends CI_model
{
    public function getAll()
    {
        $query = "SELECT `tbl_trx_stuff`.*,`tbl_satuan`.`satuan`,`tbl_category`.`category`
                    FROM `tbl_trx_stuff` JOIN `tbl_satuan`
                    ON `tbl_trx_stuff`.`unit_id` = `tbl_satuan`.`id`
                    JOIN `tbl_category` ON `tbl_trx_stuff`.`category_id` = `tbl_category`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function addStuff(array $data){
        $this->db->insert('tbl_trx_stuff', $data);
    }

    public function editStuff($id, array $data)
    {
        $this->db->update('tbl_trx_stuff', $data, array('id' => $id));
    }

    public function deleteStuff($id)
    {
        $this->db->delete('tbl_trx_stuff', ['id' => $id]);
    }

    public function checkStuffCode($code, $id = null)
    {
        $this->db->from('tbl_trx_stuff');
        $this->db->where('stuff_code', $code);
        if ($id != null) {
            $this->db->where('id !=', $id);
        }
        return $this->db->get();
    }
    
    public function getStuffById($id)
    {
        return $this->db->get_where('tbl_trx_stuff', ['id' => $id])->row();
    }

}