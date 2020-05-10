<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_model extends CI_model
{
    public function getAllRole()
    {
        return $this->db->get('tbluserrole')->result_array();
    }

    public function getRoleXadmin()
    {
        $this->db->where('id !=', 1);
        return $this->db->get('tbluserrole')->result_array();
    }

    public function getRoleByID($id)
    {
       return $this->db->get_where('tbluserrole',['id' => $id])->row_array();
    }

    public function addRole(array $data){
        $this->db->insert('tbluserrole', $data);
    }

    public function editRole($id, array $data)
    {
        $this->db->update('tbluserrole', $data, array('id' => $id));
    }

    public function deleteRole($id)
    {
        $this->db->delete('tbluserrole', ['id' => $id]);
    }

    public function getUserAccessMenu(array $data)
    {
        return $this->db->get_where('tbluseraccessmenu', $data);
    }

    public function addAccessMenu(array $data)
    {
        $this->db->insert('tbluseraccessmenu', $data);
    }

    public function delAccessMenu(array $data)
    {
        $this->db->delete('tbluseraccessmenu', $data);
    }
}
