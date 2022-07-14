<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit Slider
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php echo $this->session->flashdata('slider') ?>
                        <form action="<?= base_url("admin/Slider/update_slider/") . $slide->id_slider; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <label>Gambar Slider</label>
                                        <input type="file" id="slider_pic" name="gambar" value="<?= base_url() ?>uploads/slider/<?= $slide->gambar ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <label>Status</label>
                                        <select class="form-control selectric" name="status">
                                            <option value="1" <?= $slide->status == 1 ? 'selected' : '' ?>>Tampil</option>
                                            <option value="0" <?= $slide->status == 0 ? 'selected' : '' ?>>Sembunyi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Simpan</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Gambar Produk</h4>
                    </div>
                    <div class="card-body">
                        <img id="gambar_slider" src="<?= base_url() . 'uploads/slider/' . $slide->gambar ?>" alt="" style="border-radius:5px;max-height: 200px;" class="img-fluid my-2">
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<script>
    slider_pic.onchange = evt => {
        const [file] = slider_pic.files
        if (file) {
            gambar_slider.src = URL.createObjectURL(file)
        }
    }
</script>