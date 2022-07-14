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
<?php echo $this->session->flashdata('berhasil_preorder') ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-7">
                <div class="card" style="overflow: hidden;">
                    <div class="card-header">
                        <h4>
                            Preorder
                        </h4>
                    </div>
                    <div class="card-body" style="height: 70vh; overflow-y:scroll">
                        <form action="" method="post">
                            <?php foreach ($jenis_produk as $js_produk) : ?>
                                <h6 class="text-dark"><?= $js_produk['nama_jenis'] ?></h6>
                                <div class="row">
                                    <?php foreach ($daftar_produk as $dt_produk) : ?>
                                        <?php if ($dt_produk['id_jenis'] == $js_produk['id_jenis']) : ?>
                                            <?php if ($dt_produk['status_produk'] == 1) : ?>
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
                                                    <h6 class="font-weight-normal mt-2 mb-0 font-14 text-dark">Min order <?= $dt_produk['min_order'] ?> pcs</h6>
                                                    <input hidden type="text" id="min_order<?= $dt_produk['id_produk'] ?>" value="<?= $dt_produk['min_order'] ?>">
                                                </div>
                                            </div>
                                            <?php endif;?>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <form id="formTransaksiPreorder" action="<?php echo base_url('kasir/Kasir_page/terjual_atau_preorder/') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="overflow: hidden;">
                                <div class="card-header">
                                    <h4> Transaksi</h4>
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
                                    <div class="d-flex justify-content-around mt-3">
                                        <!-- <==> WARNING <==> -->
                                        <!-- form input tanggal karo total belanja ojo dihapus. neng controller enek fungsi if seng butuh elemen iki -->
                                        <input hidden type="text" id="nama2" name="nama">
                                        <input hidden type="text" id="no_hp2" name="no_hp">
                                        <input hidden type="text" id="pilih_daerah2" name="id_daerah">
                                        <input hidden type="text" id="alamat2" name="alamat">
                                        <input hidden type="text" id="catatan" name="catatan">
                                        <input hidden id="tglkirim" type="date" name="tglDikirim">
                                        <input hidden type="text" id="total-cart" name="total_belanja">
                                        <!-- batas warning -->
                                        <button class="btn btn-info" type="button" id="open-modal">
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
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content shadow-none" style="background-color: transparent;">
            <div class="modal-body">
                <div class="row justify-content-around">
                    <div class="card col-md-7">
                        <div class="card-header">
                            <h5>Data User Pemesan</h5>
                        </div>
                        <div class="card-body"">
                            <div class=" row">
                            <div class="form-group col-md-6">
                                <label>Nama</label>
                                <input id="nama" type="text" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>No. HP/WA</label>
                                <input id="no_hp" type="number" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Daerah Kirim</label>
                                <select class="form-control selectric" id="pilih-daerah">
                                    <option selected disabled>Pilih Daerah</option>
                                    <?php foreach ($daerah as $d_kirim) : ?>
                                        <option value="<?= $d_kirim['id_daerah'] ?>"><?= $d_kirim['nama_kota'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tanggal Pengiriman</label>
                                <div class="input-group">
                                    <?php date_default_timezone_set('Asia/Jakarta');
                                    $today = date('Y-m-d');
                                    $tgl = date('Y-m-d', strtotime('+3 days', strtotime($today)));
                                    ?>
                                    <input id="tglDikirim" type="date" class="form-control" min="<?= $tgl ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Alamat Pengiriman</label>
                                <textarea id="alamat" type="text" class="form-control"></textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Catatan</label>
                                <textarea type="text" class="form-control" placeholder="*Jika tidak perlu silahkan dikosongi"></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-end p-3">
                            <button type="button" class="btn btn-secondary mr-3 " data-dismiss="modal">Close</button>
                            <button type="button" onclick="simpan_preorder()" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4">
                    <div class="card-header">
                        <h5>Keuangan</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Total Belanja</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input hidden readonly type="text" class="form-control " id="total-cart" name="total_belanja">
                                <input type="text" class="form-control " id="total-belanja" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga Ongkir</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input id="ongkir" type="text" class="form-control" value="0" name="ongkir" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Uang Pembayaran</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="uang" placeholder="Masukkan uang pembayaran">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Kembalian</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input disabled type="text" class="form-control" id="kembalian">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/cart_preorder.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#open-modal").click(function() {
            let total_belanja = document.getElementById('total-belanja').value;
            if (total_belanja == 0) {
                swal("Gagal", "Belum ada roti/kue yang dipilih", "error");
                return false;
            }
            $('#lanjut').modal('show').appendTo('body');
        });

        $("#nama").on("keyup", function() {
            $("#nama2").val($(this).val());
        });

        $("#no_hp").on("keyup", function() {
            $("#no_hp2").val($(this).val());
        });

        $("#alamat").on("keyup", function() {
            $("#alamat2").val($(this).val());
        });

        $("#catatan").on("keyup", function() {
            $("#catatan2").val($(this).val());
        });

        $("#pilih-daerah").on("change", function() {
            var id_daerah = $(this).val();
            $("#pilih_daerah2").val(id_daerah);
            $.ajax({
                url: '<?php echo base_url("kasir/Kasir_page/get_ongkir/") ?>' + id_daerah,
                success: function(data) {
                    const format3 = data.toString().split('').reverse().join('');
                    const convert3 = format3.match(/\d{1,3}/g);
                    const rupiah3 = convert3.join('.').split('').reverse().join('');
                    $("#ongkir").val(rupiah3);

                },
            });
        });

        // total belanja dan tanggal kirim
        setInterval(function() {
            var total_cart = document.getElementById('total-cart').value;
            const format = total_cart.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            const rupiah = convert.join('.').split('').reverse().join('');
            document.getElementById('total-belanja').value = rupiah;

            var tanggal = document.getElementById('tglDikirim').value;
            document.getElementById('tglkirim').value = tanggal;
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

            // get biaya ongkir
            let ongkir = document.getElementById('ongkir').value;
            var bo = ongkir.replace(/[^,\d]/g, '').toString();

            // get uang pelanggan
            let uang_pelanggan = document.getElementById('uang').value;
            let up = uang_pelanggan.replace(/[^,\d]/g, '').toString();

            // fungsi hitung
            var tt_semua = parseInt(ttb) + parseInt(bo);
            let hitung = parseInt(up) - tt_semua;
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

    function simpan_preorder() {
        // validasi data pemesan
        var nama = document.getElementById("nama").value;
        var no_hp = document.getElementById("no_hp").value;
        var daerah = document.getElementById("ongkir").value;
        var alamat = document.getElementById("alamat").value;

        if (nama != '' && no_hp != '' && daerah != 0 && alamat != '') {
            // eksekusi selanjutnya
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
                    if (nama == '') {
                        document.getElementById('nama').focus();
                    } else if (no_hp == '') {
                        document.getElementById('no_hp').focus();
                    } else if (daerah == 0) {
                        document.getElementById('pilih-daerah').focus();
                    } else if (alamat == '') {
                        document.getElementById('alamat').focus();
                    }
                }
            });
            return false;
        }

        //cek tanggal pengiriman
        var tgl = document.getElementById('tglDikirim').value;
        if (tgl == '') {
            //swal("Informasi", "Tanggal pengiriman masih kosong", "info");
            swal({
                title: "Gagal Menyimpan",
                text: "Tanggal pengiriman masih kosong",
                icon: "error",
                buttons: {
                    cancel: false,
                    confirm: true
                }
            }).then((oke) => {
                if (oke) {
                    document.getElementById('tglDikirim').focus();
                }
            });
            return false;
        } else {
            //set tgl dikirim min + 3 hari kedepan
            const date = new Date();
            date.setDate(date.getDate() + 2);

            // parse tanggal
            var tgl_min = Date.parse(date);
            var tgl2 = Date.parse(tgl);

            // cek tgl kirim
            if (tgl2 < tgl_min) {
                swal("Gagal Menyimpan", "Tanggal pengiriman minimal 3 hari kedepan", "error");
                return false;
            }
        }

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
                document.getElementById('formTransaksiPreorder').submit();
                sessionStorage.removeItem("shoppingCart", JSON.stringify(cart));
            }
        });
    }
</script>