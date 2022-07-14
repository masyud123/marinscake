<?php echo $this->session->flashdata('akun'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Profil
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="name" value="<?= $user->nama ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email" value="<?= $user->email ?>" disabled>
                        </div>
                        <a href="<?= base_url() ?>kasir/akun/edit_user" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i>Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>