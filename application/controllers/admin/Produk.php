<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        if ($this->session->userdata('role') != 77) {
            redirect('admin/auth/login');
        }
        error_reporting(0);
    }

    // tampil produk
    public function index()
    {
        $data['produk']     = $this->Model_produk->get_produk()->result_array();
        $data['kategori']   = $this->Model_produk->get_kategori_produk()->result_array();
        $data['gambar']     = $this->db->get('gambar_produk')->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/produk/data_produk', $data);
        $this->load->view('admin/template/footer');
    }

    // tampil edit produk
    public function edit_produk($id_produk)
    {
        $data['kategori']   = $this->Model_produk->get_kategori_produk()->result_array();
        $data['produk']     = $this->Model_produk->get_produk_where($id_produk)->result_array();
        $data['gambar']     = $this->Model_produk->get_gambar_produk($id_produk)->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/produk/edit_produk', $data);
        $this->load->view('admin/template/footer');
    }

    // tampil tambah produk
    public function tambah_produk()
    {
        $data['kategori'] = $this->Model_produk->get_kategori_produk()->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/produk/tambah_produk', $data);
        $this->load->view('admin/template/footer');
    }

    // tambah data produk
    public function insert_produk()
    {
        $nama_produk    = $this->input->post("nama_produk");
        $harga          = $this->input->post("harga");
        $status         = $this->input->post("status");
        $kategori       = $this->input->post("kategori");
        $stok           = $this->input->post("stok");
        $min_order      = $this->input->post("min_order");
        $deskripsi      = $this->input->post("deskripsi");
        $jumlah_gambar  = count($_FILES['gambar']['name']);


        $data = array(
            'nama_produk'   => $nama_produk,
            'harga'         => $harga,
            'status_produk' => $status,
            'id_jenis'      => $kategori,
            'stok'          => $stok,
            'min_order'     => $min_order,
            'deskripsi'     => $deskripsi,
        );

        $this->db->insert('produk', $data);
        $id_produk = $this->db->insert_id();

        $data2 = [];
        for ($i = 0; $i < $jumlah_gambar; $i++) :
            if (!empty($_FILES['gambar']['name'][$i])) {
                $tipe   = $_FILES['gambar']['type'][$i];
                $format = substr($tipe, strpos($tipe, "/") + 1);
                $name = date('YmdHis') . "_" . rand(1000, 10000) . "_" . $_FILES['gambar']['name'][$i];
                $nama = md5($name) . "." . $format;
                $_FILES['file']['name']     = $nama;
                $_FILES['file']['type']     = $_FILES['gambar']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['gambar']['tmp_name'][$i];
                $_FILES['file']['error']    = $_FILES['gambar']['error'][$i];
                $_FILES['file']['size']     = $_FILES['gambar']['size'][$i];

                $config['upload_path']     = './uploads/gambar_produk';
                $config['allowed_types']   = 'jpg|jpeg|png|gif';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('file')) {
                    // upload ke folder sesuai nama
                    $this->upload->data()['file_name'];
                    // replace spasi menjadi "_"
                    $replace_spasi[$i] = str_replace(" ", "_", $nama);
                    // file gambar dimasukkan ke array
                    $data2[] = array(
                        'id_produk' => $id_produk,
                        'gambar'    => $replace_spasi[$i],
                    );
                } else {
                    $this->session->set_flashdata(
                        'gagal_insert_produk',
                        '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","Format gambar tidak sesuai","error")  
                            </script>'
                    );
                }
            }
        endfor;

        // insert gambar ke db
        $this->db->insert_batch('gambar_produk', $data2);
        $this->session->set_flashdata(
            'produk',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Data berhasil ditambahkan","success")  
                            </script>'
        );
        redirect('admin/Produk/');
    }

    //hapus data produk 
    public function hapus_produk($id_produk)
    {
        $where = array('id_produk' => $id_produk);
        $produk = $this->db->get_where('detail_preorder', $where)->result_array();
        $produk2 = $this->db->get_where('detail_transaksi', $where)->result_array();

        if ($produk == null && $produk2 == null) {
            $hapus = $this->db->delete('produk', $where);
            if ($hapus) {
                $this->session->set_flashdata(
                    'produk',
                    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                                <script type ="text/JavaScript">  
                                swal("Sukses","Produk berhasil dihapus","success"); 
                                </script>'
                );
            } else {
                $this->session->set_flashdata(
                    'produk',
                    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                                <script type ="text/JavaScript">  
                                swal("Sukses","Produk gagal dihapus","success"); 
                                </script>'
                );
            }
            redirect('admin/Produk/');
        } else {
            $this->session->set_flashdata(
                'produk',
                '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","Produk tidak dapat dihapus, karena terdapat data didalam transaksi atau preorder!","error")  
                            </script>'
            );
            redirect('admin/Produk');
        }
    }

    // update data produk
    public function update_produk($id_produk)
    {
        $nama_produk    = $this->input->post("nama_produk");
        $harga          = $this->input->post("harga");
        $status         = $this->input->post("status");
        $kategori       = $this->input->post("kategori");
        $stok           = $this->input->post("stok");
        $min_order      = $this->input->post("min_order");
        $deskripsi      = $this->input->post("deskripsi");

        $data = array(
            'nama_produk'    => $nama_produk,
            'harga'         => $harga,
            'status_produk'        => $status,
            'id_jenis'       => $kategori,
            'stok'          => $stok,
            'min_order'     => $min_order,
            'deskripsi'     => $deskripsi,
        );

        $where = array('id_produk' => $id_produk);

        $this->db->update('produk', $data,  $where);
        $this->session->set_flashdata(
            'produk',
            '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Produk berhasil diupdate","success"); 
                            </script>'
        );
        redirect('admin/Produk/');
    }

    //tambah gambar
    public function insert_gambar($id_produk)
    {
        if (($_FILES['gambar']['name']) != null) {
            // get format file
            $tipe   = $_FILES['gambar']['type'];
            $format = substr($tipe, strpos($tipe, "/") + 1);

            //rename gambar
            $name = date('YmdHis') . "_" . rand(1000, 10000) . "_" . $_FILES['gambar']['name'];
            $nama = md5($name) . "." . $format;

            $config['upload_path']     = './uploads/gambar_produk';
            $config['allowed_types']   = 'jpg|jpeg|png|gif';
            $config['file_name']       = $nama;


            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $this->upload->data()['file_name'];
            } else {
                echo "Gambar gagal diupload";
            }

            $data   = array(
                'id_produk' => $id_produk,
                'gambar'    => $nama,
            );
            echo json_encode($data);
            $this->db->insert('gambar_produk', $data);
            $id_gambar = $this->db->insert_id();
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(array(
                    'data' => $id_gambar
                )));
        }
    }

    //update gambar
    public function update_gambar($id_gambar)
    {
        if (!empty($_FILES['gambar']['name'])) {
            // get format file
            $tipe   = $_FILES['gambar']['type'];
            $format = substr($tipe, strpos($tipe, "/") + 1);

            //rename gambar
            $name = date('YmdHis') . "_" . rand(1000, 10000) . "_" . $_FILES['gambar']['name'];
            $nama = md5($name) . "." . $format;

            $config['upload_path']     = './uploads/gambar_produk';
            $config['allowed_types']   = 'jpg|jpeg|png|gif';
            $config['file_name']       = $nama;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('gambar')) {
                $this->upload->data()['file_name'];
            } else {
                echo "Gambar gagal diupload";
            }

            $data   = array('gambar' => $nama);
            $where  = array('id_gambar_produk' => $id_gambar);
            $gambar = $this->db->get_where('gambar_produk', $where)->row()->gambar;
            $update = $this->db->update('gambar_produk', $data, $where);
            if ($update) {
                $path = './uploads/gambar_produk/' . $gambar;
                chmod($path, 0777);
                unlink($path);
            }
        }
    }

    // hapus gambar produk
    public function hapus_gambar()
    {
        $where = array('id_gambar_produk' => $this->input->post('id_gambar_produk'));
        $delete = $this->db->delete('gambar_produk', $where);
        if ($delete) {
            $gambar = $this->db->get_where('gambar_produk', $where)->row()->gambar;
            $path = './uploads/gambar_produk/' . $gambar;
            chmod($path, 0777);
            unlink($path);
        }
    }

    // kategori produk
    public function kategori()
    {
        $data['kategori']   = $this->Model_produk->get_kategori_produk()->result_array();

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar');
        $this->load->view('admin/produk/kategori', $data);
        $this->load->view('admin/template/footer');
    }

    // insert kategori
    public function insert_kategori()
    {
        $kategori   = $this->input->post("kategori");
        $status     = $this->input->post('status');

        $data = array(
            'nama_jenis'    => $kategori,
            'status'        => $status
        );

        $simpan = $this->db->insert('jenis_produk', $data);

        if ($simpan) {
            $this->session->set_flashdata(
                'kategori',
                '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Kategori berhasil ditambahkan","success")  
                            </script>'
            );
            redirect('admin/Produk/kategori');
        } else {
            $this->session->set_flashdata(
                'kategori',
                '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","Kategori gagal ditambahkan","error")  
                            </script>'
            );
            redirect('admin/Produk/kategori');
        }
    }

    // update kategori
    public function edit_kategori($id_kategori)
    {
        $nama_kategori  = $this->input->post('kategori');
        $status         = $this->input->post('status');
        $data = array(
            'nama_jenis'    => $nama_kategori,
            'status'        => $status
        );

        $where = array(
            'id_jenis' => $id_kategori
        );

        $update = $this->db->update('jenis_produk', $data, $where);

        if ($update) {
            $this->session->set_flashdata(
                'kategori',
                '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Sukses","Kategori berhasil diupdate","success")  
                            </script>'
            );
            redirect('admin/Produk/Kategori');
        } else {
            $this->session->set_flashdata(
                'kategori',
                '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                            <script type ="text/JavaScript">  
                            swal("Gagal","Kategori gagal diupdate","error")  
                            </script>'
            );
            redirect('admin/Produk/kategori');
        }
    }

    // hapus kategori
    public function hapus_kategori($id_kategori)
    {
        $kategori = $this->db->get_where('produk', array('id_jenis' => $id_kategori))->result_array();
        if ($kategori == null) {
            $delete = $this->db->delete('jenis_produk', array('id_jenis' => $id_kategori));

            if ($delete) {
                $this->session->set_flashdata(
                    'kategori',
                    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                                <script type ="text/JavaScript">  
                                swal("Sukses","Kategori berhasil dihapus","success")
                                </script>'
                );
                redirect('admin/Produk/kategori');
            } else {
                $this->session->set_flashdata(
                    'kategori',
                    '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                                <script type ="text/JavaScript">  
                                swal("Gagal","Kategori gagal dihapus","error")  
                                </script>'
                );
                redirect('admin/Produk/kategori');
            }
        } else {
            $this->session->set_flashdata(
                'kategori',
                '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
                                <script type ="text/JavaScript">  
                                swal("Gagal","Kategori tidak dapat dihapus, karena terdapat produk dalam kategori ini!","error")  
                                </script>'
            );
            redirect('admin/Produk/kategori');
        }
    }
}
