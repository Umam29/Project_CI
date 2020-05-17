<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_model
{
    public function GetStuffData()
    {
        $query = "SELECT `tbl_trx_stuff`.*,`tbl_satuan`.`satuan`,`tbl_category`.`category`
                    FROM `tbl_trx_stuff` JOIN `tbl_satuan`
                    ON `tbl_trx_stuff`.`unit_id` = `tbl_satuan`.`id`
                    JOIN `tbl_category` ON `tbl_trx_stuff`.`category_id` = `tbl_category`.`id`
        ";

        return $this->db->query($query);
    }

    public function GetProductData()
    {
        $this->db->select('tbl_product.*, tbl_product_category.name as pc_name')
        ->from('tbl_product')
        ->join('tbl_product_category', 'tbl_product.product_category_id = tbl_product_category.id');
        $this->db->order_by('tbl_product.product_category_id', 'asc');
        return $this->db->get();
    }

    public function GetSalesData()
    {
        $this->db->select('tbl_sale.*, tbl_sale_detail.*')
        ->from('tbl_sale')
        ->join('tbl_sale_detail', 'tbl_sale.struck_no = tbl_sale_detail.struck_no');
        $this->db->order_by('tbl_sale.date', 'desc');
        return $this->db->get()->result_array();
    }

    public function GetTotal()
    {
        return $this->db->query("SELECT sum(total) as total FROM tbl_sale");
    }

    public function GetSalesDataByDate($date)
    {
        return $this->db->query("SELECT tbl_sale.*, tbl_sale_detail.* FROM tbl_sale JOIN tbl_sale_detail ON tbl_sale.struck_no=tbl_sale_detail.struck_no WHERE DATE(tbl_sale.date)='$date' ORDER BY tbl_sale.struck_no DESC")->result_array();
    }

    public function GetTotalByDate($date)
    {
        return $this->db->query("SELECT sum(total) as total FROM tbl_sale WHERE DATE(`date`) = '$date'");
    }

    public function GetMonthSale()
    {
		return $this->db->query("SELECT DISTINCT DATE_FORMAT(`date`,'%M %Y') AS `month` FROM tbl_sale")->result_array();
    }
    
    public function GetYearSale()
    {
		return $this->db->query("SELECT DISTINCT YEAR(`date`) AS `year` FROM tbl_sale")->result_array();
    }
    
    public function GetSalesDataByMonth($month)
    {
        return $this->db->query("SELECT tbl_sale.*, tbl_sale_detail.* FROM tbl_sale JOIN tbl_sale_detail ON tbl_sale.struck_no=tbl_sale_detail.struck_no WHERE DATE_FORMAT(tbl_sale.`date`,'%M %Y') ='$month' ORDER BY tbl_sale.struck_no DESC")->result_array();
    }

    public function GetTotalByMonth($month)
    {
        return $this->db->query("SELECT sum(total) as total FROM tbl_sale WHERE DATE_FORMAT(tbl_sale.`date`,'%M %Y') = '$month'");
    }

    public function GetSalesDataByYear($year)
    {
        return $this->db->query("SELECT tbl_sale.*, tbl_sale_detail.* FROM tbl_sale JOIN tbl_sale_detail ON tbl_sale.struck_no=tbl_sale_detail.struck_no WHERE YEAR(tbl_sale.`date`) ='$year' ORDER BY tbl_sale.struck_no DESC")->result_array();
    }

    public function GetTotalByYear($year)
    {
        return $this->db->query("SELECT sum(total) as total FROM tbl_sale WHERE YEAR(tbl_sale.`date`) = '$year'");
    }

    public function GetTotalProduct()
    {
        return $this->db->query("SELECT count(id) as total FROM tbl_product");
    }

    public function GetTotalStuff()
    {
        return $this->db->query("SELECT count(id) as total FROM tbl_trx_stuff");
    }
}