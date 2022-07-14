<?php echo $this->session->flashdata('kategori'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Daftar Kategori
                        </h4>
                        <button class="btn btn-primary d-flex" data-toggle="modal" data-target="#modal_tambah_kategori">
                            <div class="fas fa-plus my-auto mr-2"></div>
                            Tambah Kategori
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No
                                        </th>
                                        <th>Nama Kategori</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kategori as $ktg) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $no++ ?>
                                            </td>
                                            <td>
                                                <?php echo $ktg['nama_jenis'] ?>
                                            </td>
                                            <td>
                                                <?php echo ($ktg['status'] == 1) ? "Aktif" : "Tidak Aktif" ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal_edit_kategori<?php echo $ktg['id_jenis'] ?>">
                                                        <i class="fas fa-edit mr-1"></i>Edit
                                                    </button>
                                                </div>
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

<!-- Modal tambah kategori-->
<div class="modal fade" id="modal_tambah_kategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/Produk/insert_kategori/') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>
                                    Nama Kategori
                                </label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="kategori" placeholder="nama kategori" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>
                                    Status
                                </label>
                                <div class="input-group">
                                    <select name="status" id="" class="form-control" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
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

<!-- Modal edit kategori-->
<?php foreach ($kategori as $ktg) : ?>
    <div class="modal fade" id="modal_edit_kategori<?php echo $ktg['id_jenis'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/produk/edit_kategori/') . $ktg['id_jenis']; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>
                                        Nama Kategori
                                    </label>
                                    <div class="input-group">
                                        <input value="<?= $ktg['nama_jenis'] ?>" class="form-control" type="text" name="kategori" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>
                                        Status
                                    </label>
                                    <div class="input-group">
                                        <select name="status" id="" class="form-control" required>
                                            <option value="1" <?= ($ktg['status'] == 1) ? "selected" : "" ?>>Aktif</option>
                                            <option value="0" <?= ($ktg['status'] == 0) ? "selected" : "" ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
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

<script type="text/javascript">
    function hapus_produk($id_kategori) {
        swal({
            title: "Hapus produk",
            text: "Apakah anda yakin ingin menghapus kategori ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "<?php echo base_url('admin/Produk/hapus_kategori/') ?>" + $id_kategori;
            } else {
                swal("Produk gagal dihapus");
            }
        });
    }
</script>