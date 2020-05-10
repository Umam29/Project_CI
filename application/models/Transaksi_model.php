<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_model
{
    public function getTempTrx()
    {
        $query = "SELECT `tbl_trx_beli_temp`.*,`tbl_satuan`.`satuan`
                    FROM `tbl_trx_beli_temp` JOIN `tbl_satuan`
                    ON `tbl_trx_beli_temp`.`id_satuan_temp` = `tbl_satuan`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function addTempTrx(array $data){
        $this->db->insert('tbl_trx_beli_temp', $data);
    }

    public function deleteTempTrx($id)
    {
        $this->db->delete('tbl_trx_beli_temp', ['id_temp' => $id]);
    }

    public function emptyTempTrx()
    {
        $this->db->empty_table('tbl_trx_beli_temp');
    }

    public function saveTrxBeli()
    {
        $query = "INSERT INTO `tbl_trx_beli` (nama_barang, deskripsi, jumlah, harga_satuan, harga_total, tgl_beli, id_satuan)
                  SELECT nama_barang_temp, deskripsi_temp, jumlah_temp, harga_satuan_temp, harga_total_temp, tgl_beli_temp, id_satuan_temp
                  FROM `tbl_trx_beli_temp`
        ";

        $this->db->query($query);
    }

    public function getTrxBeli()
    {
        $query = "SELECT `tbl_trx_beli`.*,`tbl_satuan`.`satuan`,`tbl_category`.`category`
                    FROM `tbl_trx_beli` JOIN `tbl_satuan`
                    ON `tbl_trx_beli`.`id_satuan` = `tbl_satuan`.`id`
                    JOIN `tbl_category` ON `tbl_trx_beli`.`category_id` = `tbl_category`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function deleteTrxBeli($id)
    {
        $this->db->delete('tbl_trx_beli', ['id' => $id]);
    }

    public function getCategory()
    {
        return $this->db->get('tbl_category')->result_array();
    }

    public function editPurchase($id, array $data)
    {
        $this->db->update('tbl_trx_beli', $data, array('id' => $id));
    }

    // public function getAllMenu()
    // {
    //     $this->db->where('id !=', 1);
    //     return $this->db->get('tblusermenu')->result_array();
    // }

}
