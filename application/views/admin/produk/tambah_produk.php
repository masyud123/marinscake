<?php echo $this->session->flashdata('gagal_insert_produk'); ?>
<div class="main-content">
    <section class="section">
        <form action="<?php echo base_url("admin/Produk/insert_produk") ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                Tambah Produk
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Nama Produk</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-quote-left"></i>
                                            </div>
                                        </div>
                                        <input required type="text" class="form-control" name="nama_produk">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input required type="text" class="form-control" name="harga">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Kategori</label>
                                    <select class="form-control selectric" name="kategori">
                                        <?php foreach ($kategori as $ktg) : ?>
                                            <option value="<?php echo $ktg['id_jenis'] ?>">
                                                <?php echo $ktg['nama_jenis'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Status</label>
                                    <select class="form-control selectric" name="status">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>Stok</label>
                                    <input required type="number" class="form-control" name="stok">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Minimal Order</label>
                                    <input required type="number" class="form-control" name="min_order">
                                </div>
                            </div>
                            <div class="form-group " style="height: auto;">
                                <label>Deskripsi Produk</label>
                                <textarea required style="resize: none;" class="form-control" cols="59" rows="5" name="deskripsi"></textarea>
                            </div>
                            <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i>Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Gambar Produk</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-4 text-center">
                                    <strong>Gambar</strong>
                                </div>
                                <div class="col-6 text-center">
                                    <strong>Nama File</strong>
                                </div>
                                <div class="col-2 text-center">
                                    <strong>Aksi</strong>
                                </div>
                            </div>
                            <div class="input_gambar" id="jumlah_gambar">
                                <div class="row">
                                    <div class="col-4 col align-self-center" align="center">
                                        <img id="gambar0" alt="your image" width="100" height="auto" />
                                    </div>
                                    <div class="col-6 col align-self-center">
                                        <input id="upload0" class="form-control-file" name="gambar[0]" type="file" accept="image/*" onchange="gambar(<?= 0 ?>)" required>
                                    </div>
                                    <div class="col-2">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button class="btn btn-info tambah_gambar" type="button"><i class="fas fa-plus mr-2"></i>Tambah Gambar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var max_fields = 20; 
        var wrapper = $(".input_gambar"); 
        var add_button = $(".tambah_gambar"); 
        var jumlah = document.getElementById('jumlah gambar')
        var x = 1; 
        a = 1;
        b = 1;
        c = 1;
        d = 1;
        $(add_button).click(function(e) { 
            e.preventDefault();
            x++; 
            $(wrapper).append('' +
                '<div class="row mt-2">' +
                '<div class="col-4 col align-self-center" align="center">' +
                '<img id="gambar' + a++ + '" alt="your image" width="100" height="auto"/>' +
                '</div>' +
                '<div class="col-6 col align-self-center">' +
                '<input required id="upload' + d++ + '" class="form-control-file" type="file" accept="image/*" name="gambar[' + b++ + ']" onchange="gambar(' + c++ + ')">' +
                '</div>' +
                '<div class="col-2 col align-self-center" align="right">' +
                '<button href="#" class="btn btn-danger remove_field mt-1"><i class="fas fa-trash fa-1x"></button>' +
                '</div>' +
                '</div>'
            ); 
        });
        $(wrapper).on("click", ".remove_field", function(e) { 
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;
        })
    });
    function gambar(id) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("upload" + id).files[0]);
        oFReader.onload = function(oFREvent) {
            document.getElementById("gambar" + id).src = oFREvent.target.result;
        };
    };
</script>