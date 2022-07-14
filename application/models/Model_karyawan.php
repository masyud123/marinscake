<?php

class Model_karyawan extends CI_Model
{
	// get data karyawan
	public function get_data_karyawan()
	{
		return $this->db->get('karyawan');
	}
}