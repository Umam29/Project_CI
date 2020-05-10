<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_model extends CI_model
{
    public function getAll()
    {
        $query = "SELECT `tbl_trx_purchase`.*,`tbl_satuan`.`satuan`,`tbl_trx_stuff`.`name`, `tbl_trx_stuff`.`stuff_code`, `tbl_trx_stuff`.`price`, `tbl_trx_stuff`.`stock`
                    FROM `tbl_trx_purchase` 
                    JOIN `tbl_trx_stuff` ON `tbl_trx_purchase`.`stuff_id` = `tbl_trx_stuff`.`id`
                    JOIN `tbl_satuan` ON `tbl_trx_stuff`.`unit_id` = `tbl_satuan`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function addPurchase(array $data){
        $this->db->insert('tbl_trx_purchase', $data);
    }

    // public function editStuff($id, array $data)
    // {
    //     $this->db->update('tbl_trx_stuff', $data, array('id' => $id));
    // }

    public function getPurchaseById($id)
    {
        return $this->db->get_where('tbl_trx_purchase', ['id' => $id])->row();
    }

    public function deletePurchase($id)
    {
        $this->db->delete('tbl_trx_purchase', ['id' => $id]);
    }

    // public function checkStuffCode($code, $id = null)
    // {
    //     $this->db->from('tbl_trx_stuff');
    //     $this->db->where('stuff_code', $code);
    //     if ($id != null) {
    //         $this->db->where('id !=', $id);
    //     }
    //     return $this->db->get();
    // }

}