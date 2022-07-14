<?php

class Model_kota extends CI_Model
{
    // get data daerah kirim
    public function get_kota()
    {
        return $this->db->get('daerah_kirim');
    }

    // get data daerah kirim sesuai id kota
    public function get_kota_where($id_kota)
    {
        $this->db->select('*');
        $this->db->from('daerah_kirim');
        $this->db->where('id_daerah', $id_kota);
        return $this->db->get('');
    }
}
