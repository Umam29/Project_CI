<?php

//Fungsi helper untuk penjagaan akses menu admin dan user
function is_logged_in()
{
    $ci = get_instance();

    if(!$ci->session->userdata('username'))
    {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('tblusermenu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('tbluseraccessmenu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
            ]);

        if($userAccess->num_rows() < 1)
        {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('tbluseraccessmenu', [
                'role_id' => $role_id,
                'menu_id' => $menu_id
            ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}