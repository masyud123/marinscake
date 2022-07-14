<?php echo $this->session->flashdata('karyawan'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>
                            Daftar Karyawan
                        </h4>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_tambah_karyawan"><i class="fas fa-plus mr-2"></i> Tambah Karyawan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10px">NO</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Posisi</th>
                                        <th>No HP</th>
                                        <th>Gaji</th>
                                        <th>Status</th>
                                        <th class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_karyawan as $data_kr) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td>
                                                <?php echo $data_kr['nama'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data_kr['jenis_kelamin'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data_kr['posisi'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data_kr['no_hp'] ?>
                                            </td>
                                            <td>
                                                Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                                            </td>
                                            <td>
                                                <?= $data_kr['status'] == 1 ? "Aktif" : "Tidak Aktif" ?>
                                            </td>
                                            <td class="d-flex justify-content-around">
                                                <button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#modal_edit_karyawan<?php echo $data_kr['id_karyawan'] ?>"><i class="fas fa-pen mr-1"></i> Edit</button>
                                                <!--<button onclick="hapus_karyawan(<?php echo $data_kr['id_karyawan']; ?>)" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_hapus_karyawan<?php echo $data_kr['id_karyawan'] ?>"><i class="fas fa-trash mr-1"></i> Hapus</button>-->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal tambah Karyawan-->
<div class="modal fade" id="modal_tambah_karyawan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/Karyawan/tambah_karyawan/'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>
                            Nama
                        </label>
                        <input type="text" name="nama" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>
                                    Jenis Kelamin
                                </label>
                                <select class="form-control selectric" name="kelamin" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                                    <option>
                                        Laki-Laki
                                    </option>
                                    <option>
                                        Perempuan
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>
                                    Posisi
                                </label>
                                <input type="text" name="posisi" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>
                                    No. HP/WA
                                </label>
                                <input type="number" name="noHp" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>
                                    Status
                                </label>
                                <select class="form-control selectric" name="status" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                                    <option value="1">
                                        Aktif
                                    </option>
                                    <option value="0">
                                        Tidak Aktif
                                    </option>
                                </select>
                            </div>
                        </div>
                        
                    </div>

                    
                    <div class="form-group">
                        <label>
                            Gaji
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" name="gaji" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
                            <i class="fas fa-check mr-1"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit Karyawan-->
<?php foreach ($data_karyawan as $data_kr) : ?>
    <div class="modal fade" id="modal_edit_karyawan<?php echo $data_kr['id_karyawan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/karyawan/update_karyawan/') . $data_kr['id_karyawan']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>
                                Nama
                            </label>
                            <input type="text" name="nama" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $data_kr['nama'] ?>">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>
                                        Jenis Kelamin
                                    </label>
                                    <select class="form-control selectric" name="kelamin" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                                        <option <?php if ($data_kr['jenis_kelamin'] == 'Laki-Laki') : echo "selected";
                                                endif; ?>>
                                            Laki-Laki
                                        </option>
                                        <option <?php if ($data_kr['jenis_kelamin'] == 'Perempuan') : echo "selected";
                                                endif; ?>>
                                            Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>
                                        Posisi
                                    </label>
                                    <input type="text" name="posisi" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $data_kr['posisi'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                            <div class="form-group">
                            <label>
                                No. HP/WA
                            </label>
                            <input type="number" name="noHp" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $data_kr['no_hp'] ?>">
                        </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>
                                        Status
                                    </label>
                                    <select class="form-control selectric" name="status" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                                        <option value="1" <?php if ($data_kr['status'] == '1') : echo "selected";
                                                endif; ?>>
                                            Aktif
                                        </option>
                                        <option value="0" <?php if ($data_kr['status'] == '0') : echo "selected";
                                                endif; ?>>
                                            Tidak Aktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label>
                                Gaji
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" name="gaji" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $data_kr['gaji'] ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
                                <i class="fas fa-check mr-1"></i>
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Pop up hapus Karyawan-->
<script type="text/javascript">
    function hapus_karyawan($id_karyawan) {
        swal({
            title: "Hapus karyawan",
            text: "Apakah anda yakin ingin menghapus data karyawan ini ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "<?php echo base_url('admin/Karyawan/hapus_karyawan/') ?>" + $id_karyawan;
            } else {
                swal("Data karyawan batal dihapus");
            }
        });
    }
</script>