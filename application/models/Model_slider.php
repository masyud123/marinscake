<?php

class Model_slider extends CI_Model
{
    // get data slider
    public function get_data_slider()
    {
        return $this->db->get('slider');
    }

    // get data slider sesuai parameter
    public function get_slider_where($id_slider)
    {
        $this->db->where('id_slider', $id_slider);
        return $this->db->get('slider');
    }

    //get data slider aktif
    public function get_slider_aktif()
    {
        $this->db->where('status', 1);
        return $this->db->get('slider');
    }
}
