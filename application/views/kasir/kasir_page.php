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
</style><?php echo $this->session->flashdata('berhasil_beli') ?>
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
                    <div class="card-body" style=" height: 70vh; overflow-y:scroll">
                        <form action="" method="post">
                            <?php foreach ($jenis_produk as $js_produk) : ?>
                                <h6 class="text-dark"><?= $js_produk['nama_jenis'] ?></h6>
                                <div class="row">
                                    <?php foreach ($daftar_produk as $dt_produk) : ?>
                                        <?php if ($dt_produk['id_jenis'] == $js_produk['id_jenis']) : ?>
                                            <?php if ($dt_produk['stok'] > '0' && $dt_produk['status'] == 1) : ?>
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
                                                        <h6 class="font-weight-normal mt-2 mb-0 font-14 text-dark">Stok <?= $dt_produk['stok'] ?> pcs</h6>
                                                        <input hidden type="text" id="stok<?= $dt_produk['id_produk'] ?>" value="<?= $dt_produk['stok'] ?>">
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
                <form id="formTransaksiLangsung" action="<?php echo base_url('kasir/Kasir_page/terjual_atau_preorder/') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style=" overflow-y:hidden">
                                <div class="card-header">
                                    <h4>Transaksi</h4>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between" style="height: 70vh;overflow-y:scroll">
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
                                    <!-- <==> WARNING <==> -->
                                    <!-- form input tanggal karo total belanja ojo dihapus. neng controller enek fungsi if seng butuh elemen iki -->
                                    <input id="tglDikirim" type="text" name="tglDikirim" class="form-control" hidden>
                                    <input hidden type="text" class="form-control " id="total-cart" name="total_belanja">
                                    <!-- batas warning -->
                                    <div class="d-flex justify-content-around mt-3">
                                        <button class="btn btn-info" type="button" onclick="lanjut()">
                                            Lanjutkan Pembayaran
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="lanjut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="">
                    <div class="form-group mb-2">
                        <label for="">Total Belanja</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control " id="total-belanja" disabled>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Uang Pembayaran</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control" id="uang" placeholder="Masukkan uang pembayaran disini!">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="">Kembalian</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input readonly disabled type="text" class="form-control" id="kembalian">
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                    <button type="button" onclick="simpan_transaksi()" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/cart.js"></script>
<script type="text/javascript">
    function lanjut() {
        let total_belanja = document.getElementById('total-belanja').value;
        if (total_belanja == 0) {
            swal("Gagal", "Belum ada roti/kue yang dipilih", "error");
            return false;
        }
        $('#lanjut').modal('show').appendTo('body');
    }
    $(document).ready(function() {

        // total belanja
        setInterval(function() {
            var total_cart = document.getElementById('total-cart').value;
            const format = total_cart.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            const rupiah = convert.join('.').split('').reverse().join('');
            document.getElementById('total-belanja').value = rupiah;
        }, 500);

        // uang pelanggan
        var uang = document.getElementById('uang');
        uang.addEventListener('keyup', function(e) {
            uang.value = formatRupiah(this.value);
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        // hitung kembalian
        setInterval(function() {
            // get total belanja
            let total_belanja = document.getElementById('total-cart').value;
            let ttb = total_belanja.replace(/[^,\d]/g, '').toString();

            // get uang pelanggan
            let uang_pelanggan = document.getElementById('uang').value;
            let up = uang_pelanggan.replace(/[^,\d]/g, '').toString();

            // fungsi hitung
            let hitung = parseInt(up) - parseInt(ttb);
            if (uang_pelanggan != '') {
                const format2 = hitung.toString().split('').reverse().join('');
                const convert2 = format2.match(/\d{1,3}/g);
                const hitung2 = convert2.join('.').split('').reverse().join('');
                if (hitung < 0) {
                    document.getElementById('kembalian').value = '-' + hitung2;
                } else {
                    document.getElementById('kembalian').value = hitung2;
                }
            } else {
                document.getElementById('kembalian').value = '0';
            }

        }, 500);
    });

    function simpan_transaksi() {

        //cek uang pembayaran
        var uang_pb = document.getElementById('uang').value;
        if (uang_pb == '') {
            swal({
                title: "Gagal Menyimpan",
                text: "Uang pembayaran belum dimasukkan",
                icon: "error",
                buttons: {
                    cancel: false,
                    confirm: true
                }
            }).then((oke) => {
                if (oke) {
                    document.getElementById('uang').focus();
                }
            });
            return false;
        }

        // cek uang kembalian
        var kembalian = document.getElementById('kembalian').value;
        var uang_kl = kembalian.replace(/[.]/i, '').toString();
        if (uang_kl < 0) {
            swal("Gagal Menyimpan", "Uang pembayaran kurang", "error");
            return false;
        }

        // simpan data
        Swal.fire({
            title: "Simpan Data",
            text: "Apakah anda yakin ingin menyimpan data ini ?",
            icon: "question",
            showCancelButton: true,
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tdak',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Simpan'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formTransaksiLangsung').submit();
                sessionStorage.removeItem("shoppingCart", JSON.stringify(cart));
            }
        });
    }
</script>