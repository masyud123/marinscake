<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<?php echo $this->session->flashdata('edit_modal'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Edit Pengeluaran
                            <?php if($jns_png == 1): ?>
                                Bahan Baku
                            <?php elseif($jns_png == 2): ?>
                                Akomodasi
                            <?php elseif($jns_png == 3): ?>
                                Lain-Lain
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-3 text-center">
                                <div class="form-group my-1">
                                    <label>
                                        Nama Pengeluaran
                                    </label>
                                </div>
                            </div>
                            <div class="col-2 text-center">
                                <div class="form-group my-1">
                                    <label>
                                        Jumlah
                                    </label>
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <div class="form-group my-1">
                                    <label>
                                        Harga Satuan
                                    </label>
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <div class="form-group my-1">
                                    <label>
                                        Total Harga
                                    </label>
                                </div>
                            </div>
                            <div class="col-1">
                            </div>
                        </div>
                        <form id="form_editBahan" action="<?php echo base_url('admin/Modal/update_bahan') ?>" method="post" enctype="multipart/form-data">
                            <input id="total_row_bahan" type="text" value="" hidden>
                            <div id="box" class="input_fields_wrap">
                                <?php
                                $a = 0;
                                $b = 0;
                                $c = 0;
                                $d = 0;
                                $e = 0;
                                $f = 0;
                                $g = 0;
                                $h = 0;
                                $i = 0;
                                foreach ($detail_modal as $dtl_modal) : ?>
                                    <div id="tampil_bahan<?= $dtl_modal['id_detail_modal'] ?>">
                                        <div class="row">
                                            <div class="col-3">
                                                <input value="<?= $dtl_modal['id_detail_modal'] ?>" required hidden class="form-control" type="text" name="id_detailModal">
                                                <input value="<?= $dtl_modal['id_modal'] ?>" required hidden class="form-control" type="text" name="idModal">
                                                <input value="<?= $dtl_modal['nama_bahan'] ?>" required class="form-control" type="text" name="namaBahan[<?= $a++ ?>]">
                                            </div>
                                            <div class="col-2 ">
                                                <input value="<?= $dtl_modal['jumlah'] ?>" required class="form-control" type="number" id="jumlah<?= $b++ ?>" onkeyup="jumlah(<?= $c++ ?>)" name="jumlah[<?= $d++ ?>]">
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Rp
                                                            </div>
                                                        </div>
                                                        <input value="<?= $dtl_modal['harga_satuan'] ?>" required class="form-control" type="number" id="hargaSatuan<?= $e++ ?>" onkeyup="hargaSatuan(<?= $f++ ?>)" name="hargaSatuan[<?= $g++ ?>]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Rp
                                                            </div>
                                                        </div>
                                                        <input value="<?= $dtl_modal['total_harga'] ?>" readonly class="form-control" type="text" id="totalHarga<?= $h++ ?>" name="totalHarga[<?= $i++ ?>]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <button type="button" onclick="hapus_bahan(<?= $dtl_modal['id_detail_modal'] ?>)" class="btn btn-danger mt-1"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <input id="idModal" value="<?= $dtl_modal['id_modal'] ?>" required hidden class="form-control" type="text" name="idModal">
                            <div class="text-center">
                                <button class="btn btn-info add_field_button" type="button"><i class="fas fa-plus mr-2"></i>Tambah Form</button>
                            </div>
                            <div class="d-flex justify-content-around mt-3">
                                <?php if($jenis == 0): ?>
                                    <button type="button" class="btn btn-danger col-2" onclick="window.location.href='<?= base_url('admin/modal/pengeluaran_modal/' . $bulan) ?>'">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </button>
                                <?php elseif($jenis == 1): ?>
                                    <button type="button" class="btn btn-danger col-2" onclick="window.location.href='<?= base_url('admin/modal/bahan_baku/' . $bulan) ?>'">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </button>
                                <?php elseif($jenis == 2): ?>
                                    <button type="button" class="btn btn-danger col-2" onclick="window.location.href='<?= base_url('admin/modal/akomodasi/' . $bulan) ?>'">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </button>
                                <?php elseif($jenis == 3): ?>
                                    <button type="button" class="btn btn-danger col-2" onclick="window.location.href='<?= base_url('admin/modal/lain_lain/' . $bulan) ?>'">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </button>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary col-2">
                                    <i class="fas fa-save mr-1"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    setInterval(function() {
        var box = document.getElementById('box');
        var directChildren = box.children.length;
        document.getElementById('total_row_bahan').value = directChildren;
    }, 500);
    function jumlah($a) {
        return hitung($a);
    }
    function hargaSatuan($b) {
        return hitung($b);
    }
    function hitung($c) {
        var jumlah = document.getElementById("jumlah" + $c).value;
        var hargaSatuan = document.getElementById('hargaSatuan' + $c).value;
        total = jumlah * hargaSatuan;
        document.getElementById("totalHarga" + $c).value = total;
    }
    function hapus_bahan($idDetailModal) {
        var total_row_bahan = document.getElementById("total_row_bahan").value;
        if (total_row_bahan <= 1) {
            swal('Gagal hapus', 'Detail pengeluaran tidak boleh kosong', 'error');
        } else {
            document.getElementById("tampil_bahan" + $idDetailModal).remove();
        }
    }
    $(document).ready(function() {
        var max_fields = 20; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            //max input box allowed
            x++; //text box increment
            var random_kode = Math.floor((Math.random() * 1000000) + 1); //random kode
            $(wrapper).append('' +
                '<div class="row">' +
                '<div class="col-3">' +
                '<input required class="form-control" type="text" name="namaBahan[' + random_kode + ']">' +
                '</div>' +
                '<div class="col-2 ">' +
                '<input style="" required class="form-control" type="number" id="jumlah' + random_kode + '" onkeyup="jumlah(' + random_kode + ')" name="jumlah[' + random_kode + ']">' +
                '</div>' +
                '<div class="col-3">' +
                '<div class="form-group">' +
                '<div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<div class="input-group-text">Rp</div>' +
                '</div>' +
                '<input required class="form-control" type="number" id="hargaSatuan' + random_kode + '" onkeyup="hargaSatuan(' + random_kode + ')" name="hargaSatuan[' + random_kode + ']">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-3">' +
                '<div class="form-group">' +
                '<div class="input-group">' +
                '<div class="input-group-prepend">' +
                '<div class="input-group-text">Rp</div>' +
                '</div>' +
                '<input readonly class="form-control" type="text" id="totalHarga' + random_kode + '" name="totalHarga[' + random_kode + ']">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col-1">' +
                '<button href="#" class="btn btn-danger remove_field mt-1"><i class="fas fa-trash fa-1x"></button>' +
                '</div>' +
                '</div>'
            ); // add input boxes.
        });
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            var total_row_bahan = document.getElementById("total_row_bahan").value;
            if (total_row_bahan <= 1) {
                swal('Gagal hapus', 'Detail pengeluaran tidak boleh kosong', 'error');
            } else {
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
                x--;
            }
        })
    });
</script>