<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slider extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('role') != 77) {
            redirect('admin/auth/login');
        }
        
    }

    // tampil produk
    public function index()
    {
        $data['slider'] = $this->Model_slider->get_data_slider()->result_array();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/slider/data_slider', $data);
        $this->load->view('admin/template/footer');

    }

    // tampil edit produk
    public function edit_slider($id_slider)
    {
        $data['slide']     = $this->Model_slider->get_slider_where($id_slider)->row();
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/slider/edit_slider', $data);
        $this->load->view('admin/template/footer');
    }

    // tampil tambah produk
    public function tambah_slider()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/slider/tambah_slider');
        $this->load->view('admin/template/footer');
    }

    // tambah data produk
    public function insert_slider()
    {
        $gambar = $_FILES['gambar']['name'];
        $status = $this->input->post("status");

        if ($gambar != '') {
            $config['upload_path'] = './uploads/slider';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata(
                    'slider',
                    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","Gambar slider gagal ditambahkan","error")  
                            </script>'
                );
                redirect('admin/slider/tambah_slider');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }

        $data = array(
            'status'    => $status,
            'gambar'    => $gambar,
        );

        $this->db->insert('slider', $data);
        $this->session->set_flashdata(
            'slider',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Gambar Slider berhasil ditambahkan","success")  
                            </script>'
        );
        redirect('admin/slider');
    }

    //hapus data produk
    public function hapus_slider($id_slider)
    {
        $data = array('id_slider' => $id_slider);
        $this->db->delete('slider', $data);
        $this->session->set_flashdata(
            'slider',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Slider berhasil dihapus","success"); 
                            </script>'
        );
        redirect('admin/slider');
    }

    // hapus data produk
    public function update_slider($id_slider)
    {
        $status         = $this->input->post("status");
        $gambar         = $_FILES['gambar']['name'];

        if ($gambar != null) {
            $config['upload_path'] = './uploads/slider';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata(
                    'slider',
                    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","Data Slider gagal diubah","error")  
                            </script>'
                );
                redirect('admin/slider/edit_slider/', $id_slider);
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }

        if ($gambar == null) {
            $data = array(
                'status'        => $status,
            );
        } else {
            $data = array(
                'status'        => $status,
                'gambar'        => $gambar
            );
        }

        $where = array('id_slider' => $id_slider);
        $this->db->update('slider', $data,  $where);
        $this->session->set_flashdata(
            'slider',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data Slider berhasil diupdate","success"); 
                            </script>'
        );
        redirect('admin/slider/');
    }
}
