<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan_model extends CI_model
{
    public function getAllSatuan()
    {
        return $this->db->get('tbl_satuan')->result_array();
    }

}
