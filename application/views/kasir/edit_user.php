<?php echo $this->session->flashdata('akun'); ?>
<div class="main-content">
    <section class="section">
        <form action="<?= base_url() ?>kasir/Akun/update_user" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Edit Profil
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label><span class="text-danger">*</span>Nama</label>
                                <input class="form-control" type="text" name="nama" value="<?= $user->nama ?>" required>
                            </div>
                            <div class="form-group">
                                <label><span class="text-danger">*</span>Email</label>
                                <input class="form-control" type="email" name="email" value="<?= $user->email ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password">
                                <span class="text-danger">*kosongkan jika tidak ingin mengubah password</span>
                            </div>
                            <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="far fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </section>
</div>

<script>
    input_foto.onchange = evt => {
        const [file] = input_foto.files
        if (file) {
            gambar_profil.src = URL.createObjectURL(file)
        }
    }
</script>