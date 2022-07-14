<div class="main-content">
    <section class="section">
        <?php echo $this->session->flashdata('gagal_edit_produk');
        foreach ($produk as $data_produk) : ?>
            <div class="row">
                <div class="col-lg-6">
                    <form id="form_edit_produk" action="<?php echo base_url("admin/Produk/update_produk/") . $data_produk['id_produk']; ?>" method="post" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    Edit Produk
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
                                            <input required id="nama_produk" type="text" class="form-control" name="nama_produk" value="<?php echo $data_produk['nama_produk'] ?>">
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
                                            <input required id="harga" type="text" class="form-control" name="harga" value="<?php echo $data_produk['harga'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>Kategori</label>
                                        <select id="kategori" class="form-control selectric" name="kategori">
                                            <?php foreach ($kategori as $ktg) : ?>
                                                <option value="<?php echo $ktg['id_jenis'] ?>" <?php if ($data_produk['id_jenis'] == $ktg['id_jenis']) : echo "selected";
                                                                                                endif; ?>>
                                                    <?php echo $ktg['nama_jenis'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Status</label>
                                        <select id="status" class="form-control selectric" name="status">
                                            <option value="1" <?php if ($data_produk['status_produk'] == '1') : echo "selected";
                                                                endif; ?>>Aktif</option>
                                            <option value="0" <?php if ($data_produk['status_produk'] == '0') : echo "selected";
                                                                endif; ?>> Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label>Stok</label>
                                        <input required id="stok" type="number" class="form-control" name="stok" value="<?php echo $data_produk['stok'] ?>">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Minimal Order</label>
                                        <input required id="min_order" type="number" class="form-control" name="min_order" value="<?= $data_produk['min_order'] ?>">
                                    </div>
                                </div>
                                <div class="form-group " style="height: auto;">
                                    <label>Deskripsi Produk</label>
                                    <textarea id="deskripsi" class="form-control" name="deskripsi"><?= $data_produk['deskripsi'] ?></textarea>
                                </div>
                                <button onclick="simpanPerubahan()" type="button" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Gambar Produk</h4>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid" style="overflow-y: auto; height: 380px;">
                                <div class="row mb-2">
                                    <div class="col-4 text-center">
                                        <strong>Gambar</strong>
                                    </div>
                                    <div class="col-6 text-center">
                                        <strong>Input File</strong>
                                    </div>
                                    <div class="col-2 text-center">
                                        <strong>Aksi</strong>
                                    </div>
                                </div>
                                <!-- id produk -->
                                <input hidden id="id_produk" type="text" value="<?= $data_produk['id_produk'] ?>">
                                <!-- total gambar -->
                                <input hidden id="total_gambar" type="text" value="">
                                <!-- random kode -->
                                <input hidden id="list_kode" type="text" value="">
                                <div class="col-12 input_gambar" id="jumlah_gambar">
                                    <?php foreach ($gambar as $gb_produk) :
                                        if ($data_produk['id_produk'] == $gb_produk['id_produk']) : ?>
                                            <form onsubmit="return false" id="form_gambar<?= $gb_produk['id_gambar_produk'] ?>" method="POST" enctype="multipart/form-data">
                                                <div class="row mb-2" id="row_gambar<?= $gb_produk['id_gambar_produk']; ?>">
                                                    <div class="col-4 col align-self-center" align="center">
                                                        <img id="gambar<?= $gb_produk['id_gambar_produk'] ?>" alt="your image" width="100" height="auto" src="<?php echo base_url() . '/uploads/gambar_produk/' . $gb_produk["gambar"]; ?>" />
                                                    </div>
                                                    <div class="col-6 col align-self-center">
                                                        <input name="gambar" id="upload<?= $gb_produk['id_gambar_produk'] ?>" class="form-control-file" type="file" accept="image/*" onchange="update_gambar(<?= $gb_produk['id_gambar_produk'] ?>)">
                                                    </div>
                                                    <div class="col-2 col align-self-center">
                                                        <button type="button" class="btn btn-danger" onclick="hapus_gambar(<?= $gb_produk['id_gambar_produk'] ?>)">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                    <?php endif;
                                    endforeach; ?>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="text-center mt-4">
                                    <button class="btn btn-info tambah_gambar" type="button"><i class="fas fa-plus mr-2"></i>Tambah Gambar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var max_fields = 20;
        var wrapper = $(".input_gambar");
        var add_button = $(".tambah_gambar");
        var jumlah = document.getElementById('jumlah_gambar');

        var x = 1;
        a = 0;
        $(add_button).click(function(e) {
            e.preventDefault();

            x++;
            var random_kode = Math.floor((Math.random() * 1000000) + 1);
            $(wrapper).append('' +
                '<form onsubmit="return false" id="form_gambar' + random_kode + '" method="POST" enctype="multipart/form-data"> ' +
                '<div class="row mb-2" id="row_gambar' + random_kode + '">' +
                '<div class="col-4 col align-self-center" align="center">' +
                '<img id="gambar' + random_kode + '" alt="your image" width="100" height="auto"/>' +
                '</div>' +
                '<div class="col-6 col align-self-center">' +
                '<input required id="upload' + random_kode + '" class="form-control-file" type="file" accept="image/*" name="gambar" onchange="insert_gambar(' + random_kode + ')">' +

                '</div>' +
                '<div class="col-2 col align-self-center">' +
                '<button id="hapus' + random_kode + '" onclick="delete_form_gambar(' + parseInt(random_kode) + ')" type="button" class="btn btn-danger remove_field"><i class="fas fa-trash"></button>' +
                '</div>' +
                '</div>' +
                '</form>'
            );
            $("#upload" + random_kode).focus();
            var kode = document.getElementById('list_kode').value;
            if (kode == '') {
                document.getElementById('list_kode').value = random_kode;
            } else {
                document.getElementById('list_kode').value = kode + ',' + random_kode;
            }

        });

        $(wrapper).on("click", ".remove_field", function(e) {

            total_gambar = parseInt(document.getElementById('total_gambar').value);
            if (total_gambar <= 1) {
                swal('Gagal hapus', 'Produk minimal memiliki 1 gambar', 'error');
            } else {
                // hapus tampilan div
                e.preventDefault();
                $(this).parent('div').parent('div').parent('form').remove();
                x--;
            }
        })

        setInterval(function() {
            var box = document.getElementById('jumlah_gambar');
            var directChildren = box.children.length;
            document.getElementById('total_gambar').value = directChildren;
        }, 500);
    });

    function update_gambar(id) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("upload" + id).files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("gambar" + id).src = oFREvent.target.result;
        };

        fetch('<?php echo base_url("admin/produk/update_gambar/") ?>' + id, {
            method: "POST",
            body: new FormData(document.getElementById("form_gambar" + id)),
        });
    };

    function insert_gambar(id) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("upload" + id).files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("gambar" + id).src = oFREvent.target.result;
        };

        var id_produk = document.getElementById('id_produk').value; //get id produk

        $.ajax({
            url: '<?php echo base_url("admin/produk/insert_gambar/") ?>' + id_produk,
            type: "POST",
            data: new FormData(document.getElementById("form_gambar" + id)),
            contentType: false,
            processData: false,
            cache: false,
            success: function(data) {
                console.log(data);
                var data2 = Object.entries(data)[0][1];
                var btn_hapus = document.getElementById("hapus" + id);
                btn_hapus.setAttribute('onblur', 'hapus_gambarLangsung(' + String(data2) + ')')
            },
        });
    };

    function hapus_gambar(id_gambar) {
        total_gambar = document.getElementById('total_gambar').value;
        if (total_gambar <= 1) {
            swal('Gagal hapus', 'Produk minimal memiliki 1 gambar', 'error');
        } else {
            $.ajax({
                url: "<?php echo base_url('admin/produk/hapus_gambar') ?>",
                type: "POST",
                dataType: "text",
                data: {
                    id_gambar_produk: id_gambar,
                },
                success: function(data) {
                    document.getElementById("row_gambar" + id_gambar).innerHTML = data;
                    document.getElementById("form_gambar" + id_gambar).remove();
                },
                error: function() {
                    alert("error");
                }
            });
        }
    }

    function hapus_gambarLangsung(id_gambar) {
        total_gambar = document.getElementById('total_gambar').value;
        if (total_gambar <= 1) {
            swal('Gagal hapus', 'Produk minimal memiliki 1 gambar', 'error');
        } else {
            $.ajax({
                url: "<?php echo base_url('admin/produk/hapus_gambar') ?>",
                type: "POST",
                dataType: "text",
                data: {
                    id_gambar_produk: id_gambar,
                },
                success: function(data) {

                },
                error: function() {
                    alert("error");
                }
            });
        }
    }

    function delete_form_gambar(id) {
        //console.log(id);
        total_gambar = parseInt(document.getElementById('total_gambar').value);
        if (total_gambar <= 1) {} else {

            let data = document.getElementById('list_kode').value;
            var kode_array = data.split(",");

            var myIndex = kode_array.indexOf('' + id + '');
            if (myIndex !== -1) {
                kode_array.splice(myIndex, 1);
            }
            document.getElementById('list_kode').value = kode_array;
        }
    }

    var total_gambar_awal = document.getElementById('jumlah_gambar').children.length;

    function simpanPerubahan() {
        var cekTambah_formGambar = document.getElementById('total_gambar').value;

        if (total_gambar_awal != cekTambah_formGambar) {
            let data = document.getElementById('list_kode').value;
            if (data != '') {
                const kode_array = data.split(",");
                max = kode_array.length;
                for (i = 0; i < max; i++) {
                    if (document.getElementById("upload" + kode_array[i]).files.length == 0) {
                        swal('Gagal Menyimpan', 'Form gambar tidak boleh kosong', 'error');
                        document.getElementById("upload" + kode_array[i]).focus();
                        return false;
                    }
                }
                return validasi_dataProduk();
            } else {
                return validasi_dataProduk();
            }
        } else {
            return validasi_dataProduk();
        }
    }

    function validasi_dataProduk() {
        var nama_produk = document.getElementById('nama_produk').value;
        var harga = document.getElementById('harga').value;
        var kategori = document.getElementById('kategori').value;
        var status = document.getElementById('status').value;
        var stok = document.getElementById('stok').value;
        var min_order = document.getElementById('min_order').value;
        var deskripsi = document.getElementById('deskripsi').value;
        if (nama_produk != '' && harga != '' && kategori != '' && status != '' && stok != '' && min_order != '' && deskripsi != '') {
            document.getElementById('form_edit_produk').submit();
        } else {
            swal({
                title: "Gagal Menyimpan",
                text: "Form input tidak boleh kosong!",
                icon: "error",
                buttons: {
                    cancel: false,
                    confirm: true
                }
            }).then((oke) => {
                if (oke) {
                    if (nama_produk == '') {
                        document.getElementById('nama_produk').focus();
                    } else if (harga == '') {
                        document.getElementById('harga').focus();
                    } else if (kategori == '') {
                        document.getElementById('kategori').focus();
                    } else if (status == '') {
                        document.getElementById('status').focus();
                    } else if (stok == '') {
                        document.getElementById('stok').focus();
                    } else if (min_order == '') {
                        document.getElementById('min_order').focus();
                    } else if (deskripsi == '') {
                        document.getElementById('deskripsi').focus();
                    }
                }
            });
        }
    }
</script>