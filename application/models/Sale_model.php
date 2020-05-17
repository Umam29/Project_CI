<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_model extends CI_model
{
    public function getStruckNo()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(`struck_no`,6)) AS `kd_max` FROM `tbl_sale` WHERE DATE(`date`)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
        return date('dmy').$kd;
    }

    public function addSale(array $data)
    {
        $this->db->insert('tbl_sale', $data);
    }

    public function getAll()
    {
        return $this->db->get('tbl_sale')->result_array();
    }

    public function editRecipe($id, array $data)
    {
        $this->db->update('tbl_sale', $data, array('id' => $id));
    }

    public function deleteSale($id)
    {
        $this->db->delete('tbl_sale', ['id' => $id]);
    }

    public function addSaleDetail(array $data)
    {
        $this->db->insert('tbl_sale_detail', $data);
    }

    public function getSale()
    {
        $this->db->select('tbl_sale.*, tbl_sale_detail.*')
        ->from('tbl_sale')
        ->join('tbl_sale_detail', 'tbl_sale.struck_no = tbl_sale_detail.struck_no');
        $this->db->order_by('tbl_sale.date', 'desc');
        return $this->db->get()->result_array();
    }
}