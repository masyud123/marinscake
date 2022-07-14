<?php

class Model_user extends CI_Model
{
    // get data user
    public function get_data_user()
    {
        return $this->db->get('user');
    }

    // get data user sesuai parameter
    public function get_user_id($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->get('user');
    }
}
