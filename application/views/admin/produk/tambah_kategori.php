<?php echo $this->session->flashdata('kategori'); ?>
<div class="main-content">
    <section class="section">
        <form action="<?php echo base_url("admin/Produk/insert_kategori") ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Tambah Kategori
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Nama Kategori</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-quote-left"></i>
                                            </div>
                                        </div>
                                        <input required type="text" class="form-control" name="kategori">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i>Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>