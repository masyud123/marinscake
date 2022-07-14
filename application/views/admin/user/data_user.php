<?php echo $this->session->flashdata('user'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>
                            Daftar user
                        </h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_user"><i class="fas fa-plus"></i> Tambah User</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($user as $usr) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td>
                                                <?php echo $usr['nama'] ?>
                                            </td>
                                            <td>
                                                <?php echo $usr['email'] ?>
                                            </td>
                                            <td>
                                                <?php $status = $usr['role'];
                                                if ($status == 77) : ?>
                                                    <span class="badge badge-success">Admin</span>
                                                <?php
                                                elseif ($status == 24) : ?>
                                                    <span class="badge badge-warning">Kasir</span>
                                                <?php
                                                endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_edit_user<?php echo $usr['id_user'] ?>"><i class="fas fa-pen"></i> Edit</button>
                                                <button type="button" class="btn btn-sm btn-danger ml-5" onclick="hapus_akun(<?=$usr['id_user']?>)" data-toggle="modal" data-target="#modal_hapus_user<?php echo $usr['id_user'] ?>"><i class="fas fa-trash"></i> Hapus</button>
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


<!-- Modal Tambah User-->
<div class="modal fade" id="modal_tambah_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-center bg-light">
                <h4 class="modal-title" id="exampleModalLabel"><strong>Tambah user</strong></h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/User/tambah_user'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>
                            <h6>Nama</h6>
                        </label>
                        <input type="text" name="nama" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label>
                            <h6>Email</h6>
                        </label>
                        <input type="email" name="email" class="form-control" oninvalid="this.setCustomValidity('Form input email belum sesuai!')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label>
                            <h6>Password</h6>
                        </label>
                        <input type="password" name="password" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label>
                            <h6>Level User</h6>
                        </label>
                        <select class="form-control selectric" name="role" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                            <option value="77">
                                <h6>Admin</h6>
                            </option>
                            <option value="24">
                                <h6>Kasir</h6>
                            </option>
                        </select>
                    </div>
                    <div class="row justify-content-around">
                        <button type="button" class="btn btn-danger col-2" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary col-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit User-->
<?php foreach ($user as $usr) : ?>
    <div class="modal fade" id="modal_edit_user<?php echo $usr['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center bg-light">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Edit User</strong></h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/User/update_user/') . $usr['id_user']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>
                                <h6>Nama</h6>
                            </label>
                            <input type="text" name="nama" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $usr['nama'] ?>">
                        </div>
                        <div class="form-group">
                            <label>
                                <h6>Email</h6>
                            </label>
                            <input type="email" name="email" class="form-control" oninvalid="this.setCustomValidity('Form input email belum sesuai!')" oninput="setCustomValidity('')" required value="<?= $usr['email'] ?>">
                        </div>
                        <div>
                            <label>
                                <h6>Password</h6>
                            </label>
                            <small class="text-danger col-12">*biarkan kosong jika tidak merubah password</small>
                            <input type="text" name="password" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label>
                                <h6>Level User</h6>
                            </label>
                            <select class="form-control selectric" name="role" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                                <option value="77" <?php if ($usr['role'] == 77) : echo "selected";
                                                    endif; ?>>
                                    <h6>Admin</h6>
                                </option>
                                <option value="24" <?php if ($usr['role'] == 24) : echo "selected";
                                                    endif; ?>>
                                    <h6>Kasir</h6>
                                </option>
                            </select>
                        </div>
                        <div class="row justify-content-around">
                            <button type="button" class="btn btn-danger col-2" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary col-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<!-- Modal Hapus User-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    function hapus_akun(param) {
        swal({
            title: "Hapus Akun",
            text: "Apakah anda yakin ingin menghapus akun ini ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "<?php echo base_url('admin/User/hapus_user/') ?>" + param;
            } else {
                swal("Akun batal dihapus");
            }
        });
    }
</script>
<!--<?php foreach ($user as $usr) : ?>-->
<!--    <div class="modal fade" id="modal_hapus_user<?php echo $usr['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--        <div class="modal-dialog modal-dialog-centered">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header text-center bg-light">-->
<!--                    <h4 class="modal-title" id="exampleModalLabel"><strong>Hapus User</strong></h4>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <form action="<?= base_url('admin/User/hapus_user/') . $usr['id_user']; ?>" method="post" enctype="multipart/form-data">-->
<!--                        <div class="form-group">-->
<!--                            <h6>Apakah anda yakin ingin menghapus akun <?php echo $usr['nama'] ?> ?</h6>-->
<!--                        </div>-->
<!--                        <div class="row justify-content-around">-->
<!--                            <button type="button" class="btn btn-danger col-2" data-dismiss="modal">Tidak</button>-->
<!--                            <button type="submit" class="btn btn-primary col-2">Iya</button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--<?php endforeach; ?>-->