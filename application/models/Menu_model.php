<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_model
{
    public function deleteDataMenu($id)
    {
        $this->db->delete('tblusermenu', ['id' => $id]);
    }

    public function getMenuByID($id)
    {
       return $this->db->get_where('tblusermenu',['id' => $id])->row_array();
    }

    public function editMenu($id, array $data)
    {
        $this->db->update('tblusermenu', $data, array('id' => $id));
    }

    // public function editMenu()
    // {
    //     $id = $this->input->post('id',true);
    //     $data = ["menu" => $this->input->post('menu',true)];
    //     $this->db->where('id', $id);
    //     $this->db->update('tblusermenu',$data);
    // }

    public function getSubMenu()
    {
        $query = "SELECT `tblUserSubmenu`.*,`tblUserMenu`.`menu`
                    FROM `tblUserSubmenu` JOIN `tblUserMenu`
                    ON `tblUserSubmenu`.`menu_id` = `tblUserMenu`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function addSubMenu(array $data){
        $this->db->insert('tblusersubmenu', $data);
    }

    public function editSubMenu($id, array $data)
    {
        $this->db->update('tblusersubmenu', $data, array('id' => $id));
    }

    public function deleteSubMenu($id)
    {
        $this->db->delete('tblusersubmenu', ['id' => $id]);
    }

    public function getAllMenu()
    {
        $this->db->where('id !=', 1);
        return $this->db->get('tblusermenu')->result_array();
    }

    public function getMenuByRoleId($role_id)
    {
        $this->db->select('tbluseraccessmenu.*, tblusermenu.menu');
        $this->db->from('tbluseraccessmenu');
        $this->db->join('tblusermenu','tbluseraccessmenu.menu_id = tblusermenu.id');
        $this->db->where('tbluseraccessmenu.menu_id !=', 1);
        $this->db->where('tbluseraccessmenu.role_id', $role_id);
        return $this->db->get()->result_array();
    }

}
