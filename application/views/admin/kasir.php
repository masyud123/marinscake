<?php echo $this->session->flashdata('berhasil_beli') ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-7">
                <div class="card" style="overflow: hidden;">
                    <div class="card-header">
                        <h4>
                            Daftar Produk
                        </h4>
                    </div>
                    <div class="card-body " style="max-height: 82vh; overflow-y:scroll">
                        <form action="" method="post">
                            <?php foreach ($jenis_produk as $js_produk) : ?>
                                <h6 class="text-dark"><?= $js_produk['namaJenis'] ?></h6>
                                <div class="row">
                                    <?php foreach ($daftar_produk as $dt_produk) : ?>
                                        <?php if ($dt_produk['id_jenis'] == $js_produk['id_jenis']) : ?>
                                            <?php if ($dt_produk['stok'] > '0') : ?>
                                                <div class="col-lg-3">
                                                    <div class="form-group text-center">
                                                        <a href="#" data-id="<?= $dt_produk['id_produk'] ?>" data-name="<?php echo str_replace(" ", "_", $dt_produk['nama_produk']); ?>" data-price="<?= $dt_produk['harga'] ?>" class="add-to-cart">
                                                            <?php foreach ($gambar as $gbr) :
                                                                if ($gbr['id_produk'] == $dt_produk['id_produk']) : ?>
                                                                    <img src="<?php echo base_url() . '/uploads/gambar_produk/' . $gbr["gambar"]; ?>" alt="" style="border-radius:5px;" class="img-fluid">
                                                            <?php endif;
                                                            endforeach ?>
                                                        </a>
                                                        <h6 class="font-weight-normal mt-2 mb-0 font-14 text-dark"><?= $dt_produk['nama_produk'] ?></h6>
                                                        <h6 class="text-dark font-15">Rp. <?= number_format($dt_produk['harga'], 0, '', '.') ?></h6>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <form id="formTerjual" action="<?php echo base_url('admin/kasir/terjual_atau_preorder/') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="card h-100" style="overflow: hidden;">
                                <div class="card-header">
                                    <h4>
                                        Transaksi
                                    </h4>

                                </div>
                                <div class="card-body" style="height: 25vh;overflow-y:scroll">
                                    <div class="container">
                                        <div class="row py-1 border-bottom border-top text-dark font-weight-bold">
                                            <div class="col-4 my-auto  font-16">
                                                Nama
                                            </div>
                                            <div class="col-3 my-auto  font-16 text-center">
                                                Jumlah
                                            </div>
                                            <div class="col-3 my-auto  font-16">
                                                Total
                                            </div>
                                            <hr>
                                        </div>

                                        <div class="show-cart table">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4>
                                        Pembayaran
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <label for="">Total Belanja</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="text" class="form-control " id="total-cart" name="total_belanja" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Uang</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="number" class="form-control" name="nama" id="uang">
                                        </div>
                                    </div>

                                    <!-- Input tanggal digunakan saat preorder -->
                                    <input id="tglDikirim" type="text" name="tglDikirim" class="form-control" hidden>

                                    <div class="d-flex justify-content-around">
                                        <div class="btn btn-info mr-3" type="button" onclick="preorder()" type="button">
                                            Preorder
                                        </div>
                                        <div class="btn btn-primary" onclick="lanjut_bayar()" type="button">
                                            Lanjut ke Pembayaran
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Modal Preorder-->
                <div class="modal fade" id="modal_preorder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Preorder</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>
                                        Total Belanja
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input id="total_belanja2" type="text" name="nama" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Tanggal Pengiriman
                                    </label>
                                    <div class="input-group">
                                        <input id="tanggalDikirim" type="date" <?php date_default_timezone_set('Asia/Jakarta'); ?> min="<?= date('Y-m-d') ?>" name="tanggalDikirim" class="form-control">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
                                        <i class="fas fa-check mr-1"></i>
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="simpan_Preorder()">
                                        <i class="fas fa-save mr-1"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tutup modal -->

                <!-- Modal Pembayaran-->
                <div class="modal fade" id="modal_kembalian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-center">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Pembayaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>
                                        Total Belanja
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input id="total_belanja1" type="text" name="nama" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Kembalian
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input id="kembalian" type="text" name="nama" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-around">
                                    <button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
                                        <i class="fas fa-check mr-1"></i>
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick="submit_terjual()">
                                        <i class="fas fa-save mr-1"></i>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tutup modal -->
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/cart.js"></script>
    <script type="text/javascript">
        function lanjut_bayar() {
            az = 1;
            var cek = document.getElementById('uang').value;
            var uang = parseInt(document.getElementById('uang').value);
            var total = document.getElementById('total-cart').value;
            var kembalian = uang - total;

            if (total == '0') {
                swal("Informasi", "Belum ada roti/kue yang dipilih", "info");
            } else {
                if (document.getElementById('uang').value == '') {
                    swal("Informasi", "Nominal uang pembayaran masih kosong", "info");
                } else {
                    if (uang < total) {
                        swal("Informasi", "Nominal uang pembayaran kurang", "info");
                    } else {
                        document.getElementById('total_belanja1').value = total;
                        document.getElementById('kembalian').value = kembalian;

                        $('#modal_kembalian').appendTo("body").modal('show');
                    }
                }
            }
        }

        function submit_terjual() {
            document.getElementById('formTerjual').submit();
            sessionStorage.removeItem("shoppingCart", JSON.stringify(cart));
        }

        function preorder() {
            var total = document.getElementById('total-cart').value;
            if (total == '0') {
                swal("Informasi", "Belum ada roti/kue yang dipilih", "info");
            } else {
                var total = document.getElementById('total-cart').value;
                document.getElementById('total_belanja2').value = total;

                $('#modal_preorder').appendTo("body").modal('show');
            }
        }

        function simpan_Preorder() {
            var tgl = document.getElementById('tanggalDikirim').value;
            document.getElementById('tglDikirim').value = tgl;

            if (tgl == '') {
                swal("Informasi", "Tanggal pengiriman masih kosong", "info");
            } else {
                $('#modal_preorder').appendTo("body").modal('hide');

                document.getElementById('formTerjual').submit();
                sessionStorage.removeItem("shoppingCart", JSON.stringify(cart));
            }
        }
    </script>
</div>