<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model
{
    public function editUser($id, array $data)
    {
        $this->db->update('tbluser', $data, array('id' => $id));
    }

    public function GetUserRoleAdmin()
    {
        $query = "SELECT `tbluser`.*,`tbluserrole`.`role_name`
                    FROM `tbluser` JOIN `tbluserrole`
                    ON `tbluser`.`role_id` = `tbluserrole`.`id`
                    WHERE `tbluserrole`.`id` != 1 AND `tbluser`.`is_active` = 1
        ";

        return $this->db->query($query)->result_array();
    }

    public function AddUser(array $data)
    {
        $this->db->insert('tbluser', $data);
    }

    public function deleteUser($id)
    {
        $this->db->delete('tbluser', ['id' => $id]);
    }
}
