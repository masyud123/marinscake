<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Tambah Slider
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php echo $this->session->flashdata('slider'); ?>
                        <form action="<?php echo base_url("admin/Slider/insert_slider") ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Gambar Produk</label>
                                <input type="file" name="gambar" id="slider_pic" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control selectric" name="status">
                                    <option value="1">Tampil</option>
                                    <option value="0">Sembunyi</option>
                                </select>
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
                        <img id="gambar_slider" src="" alt="" style="border-radius:5px;max-height: 200px;" class="img-fluid my-2">
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