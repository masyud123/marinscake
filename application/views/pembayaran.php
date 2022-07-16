<?php
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
} ?>

<form id="payment-form" method="post" action="<?= site_url() ?>midtrans/Snap/finish">
    <input type="hidden" name="result_type" id="result-type" value="">
    <input type="hidden" name="result_data" id="result-data" value="">
</form>
<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/client/images/hero/about.jpg">
    <div class="ps-hero__content ">
        <h1> Checkout</h1>
        <div class="text-center">
            Checkout > Pembayaran
        </div>
    </div>
</div>
<main class="ps-main">
    <div class="ps-checkout">
        <div class="container">
            <form class="ps-form--checkout">
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing px-0">
                            <h3>Data Pembeli</h3>
                            <div class="form-group form-group--inline d-flex align-items-center">
                                <label class="m-0">Nama<span></span>
                                </label>
                                <div class="form-group__content">
                                    <input class="form-control" type="text" value="<?= $pengiriman->nama ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">Email<span></span>
                                </label>
                                <div class="form-group__content">
                                    <input class="form-control" type="email" value="<?= $pengiriman->email ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">No Hp<span></span>
                                </label>
                                <div class="form-group__content">
                                    <input class="form-control" type="number" value="<?= $pengiriman->no_hp ?>" disabled>
                                </div>
                            </div>
                            <?php if ($preorder->booking == 0) : ?>
                                <div class="form-group form-group--inline  d-flex align-items-center">
                                    <label class="m-0">Kota<span></span>
                                    </label>
                                    <div class="form-group__content">
                                        <input class="form-control" type="text" value="<?= $pengiriman->nama_kota ?>" disabled>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">Alamat<span></span>
                                </label>
                                <div class="form-group__content">
                                    <textarea class="form-control" rows="5" placeholder="<?= $pengiriman->alamat ?>" disabled></textarea>
                                </div>
                            </div>
                            <?php if ($preorder->booking == 0) : ?>
                                <div class="form-group form-group--inline  d-flex align-items-center">
                                    <label class="m-0">Tanggal Pengiriman<span></span>
                                    </label>
                                    <div class="form-group__content">
                                        <input class="form-control" type="text" value="<?= tgl_indo($preorder->tanggal_dikirim) ?>" disabled>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="form-group form-group--inline  d-flex align-items-center">
                                    <label class="m-0">Waktu Pengambilan<span></span>
                                    </label>
                                    <div class="form-group__content">
                                        <input class="form-control" type="text" value="<?= tgl_indo(date('Y-m-d', strtotime($preorder->tanggal_dikirim))) . ' ' . date('H:i', strtotime($preorder->tanggal_dikirim)) . ' WIB' ?>" disabled>
                                    </div>
                                </div>
                            <?php endif ?>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">Catatan Pesanan</label>
                                <div class="form-group__content">
                                    <textarea class="form-control" rows="5" placeholder="<?= ($pengiriman->catatan == "") ? "Tidak ada catatan" : $pengiriman->catatan ?>" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-4 col-sm-12 col-xs-12">
                        <div class="ps-checkout__order">
                            <header>
                                <h3 class="font-weight-bold">Pesanan Anda</h3>
                            </header>
                            <div class="container text-light px-4">
                                <div class="row mt-4 mb-3  text-uppercase">
                                    <div class="col-3 font-weight-bold">
                                        Produk
                                    </div>
                                    <div class="col-2 font-weight-bold">
                                        Qty
                                    </div>
                                    <div class="col-3 font-weight-bold">
                                        Harga
                                    </div>
                                    <div class="col-4 font-weight-bold">
                                        Subtotal
                                    </div>
                                </div>
                                <?php foreach ($detail as $det) : ?>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <?= $det['nama_produk'] ?>
                                        </div>
                                        <div class="col-2">
                                            <?= $det['jumlah'] ?>
                                        </div>
                                        <div class="col-3">
                                            Rp <?= number_format(($det['total'] / $det['jumlah']), '0', ',', '.') ?>
                                        </div>
                                        <div class="col-4">
                                            Rp <?= number_format($det['total'], '0', ',', '.') ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <?php if ($preorder->booking == 0) : ?>
                                    <div class="row my-3">
                                        <div class="col-8">
                                            Ongkir
                                        </div>
                                        <div class="col-4">
                                            Rp <?= number_format($pengiriman->ongkir, '0', ',', '.') ?>
                                        </div>
                                    </div>
                                <?php endif ?>
                                <hr style="border-top: 1px solid white">
                                <div class="row mt-3 text-uppercase">
                                    <div class="col-8 font-weight-bold">
                                        Total Harga
                                    </div>
                                    <div class="col-4 font-weight-bold">
                                        Rp <?= number_format($preorder->jumlah, '0', ',', '.') ?>
                                    </div>
                                </div>
                            </div>
                            <footer class="p-0">
                                <div class="form-group paypal">
                                    <?php if ($midtrans == null) : ?>
                                        <button type="button" id="bayar" class="bayar ps-btn ps-btn--fullwidth ps-btn--yellow font-weight-bold">Bayar Sekarang</button>
                                    <?php endif; ?>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </form>
            <?php if ($midtrans != null) : ?>
                <div class="mt-3">
                    <h3>Informasi Pembayaran</h3>
                    <table class="table table-bordered table-striped">
                        <tr class="text-center">
                            <th>ID Order</th>
                            <th>Total Pembayaran</th>
                            <th>Metode Pembayaran</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <?php if ($midtrans->url != null) : ?>
                                <th>Panduan</th>
                            <?php endif ?>
                        </tr>
                        <tr class="text-center">
                            <td><?= $midtrans->id_preorder ?></td>
                            <td>Rp. <?= number_format($midtrans->total_bayar, '0', ',', '.') ?></td>
                            <td>
                                <?php if ($midtrans->metode == "bank_transfer") :
                                    echo "Bank Transfer";
                                elseif ($midtrans->metode == "gopay") :
                                    echo "Gopay";
                                endif ?>
                            </td>
                            <td><?php echo date('j F Y H:i:s', strtotime($midtrans->waktu)) ?> WIB</td>
                            <?php $waktu_bayar = $midtrans->waktu;
                            $today = date('Y-m-d H:i:s');
                            $batas = date('Y-m-d H:i:s', strtotime('+1 days', strtotime($waktu_bayar)));
                            $batas_bayar = date('j F Y H:i:s', strtotime('+1 days', strtotime($waktu_bayar))); ?>
                            <td>
                                <?php if ($midtrans->status == 201) : ?>
                                    <?php if (strtotime($today) > strtotime($batas)) : ?>
                                        <span class="btn btn-danger text-light">Gagal</span>
                                    <?php else : ?>
                                        <span class="btn btn-warning text-light">Menunggu</span>
                                    <?php endif ?>
                                <?php elseif ($midtrans->status == 200) : ?>
                                    <span class="btn btn-success text-light">Sukses</span>
                                <?php endif ?>
                            </td>
                            <?php if ($midtrans->url != null) : ?>
                                <td><a class="btn btn-info" href="<?= $midtrans->url ?>" target="_blank">Panduan</a></td>
                            <?php endif ?>
                        </tr>
                    </table>
                    <?php if ($midtrans->status == 201) : ?>
                        <?php if (strtotime($today) > strtotime($batas)) : ?>
                            <div>
                                <h5 class="text-danger">*Transaksi Anda gagal! batas pembayaran sudah terlewat</h5>
                            </div>
                        <?php else : ?>
                            <div>
                                <h5 class="text-danger">*Lakukan pembayaran sebelum <?= $batas_bayar ?> WIB</h5>
                            </div>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</main>

<div class="ps-site-features">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                <div class="ps-block--iconbox"><i class="ba-delivery-truck-2"></i>
                    <h4>Free Shipping <span> On Order Over$199</h4>
                    <p>Want to track a package? Find tracking information and order details from Your Orders.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                <div class="ps-block--iconbox"><i class="ba-biscuit-1"></i>
                    <h4>Master Chef<span> WITH PASSION</h4>
                    <p>Shop zillions of finds, with new arrivals added daily.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                <div class="ps-block--iconbox"><i class="ba-flour"></i>
                    <h4>Natural Materials<span> protect your family</h4>
                    <p>We always ensure the safety of all products of store</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                <div class="ps-block--iconbox"><i class="ba-cake-3"></i>
                    <h4>Attractive Flavor <span>ALWAYS LISTEN</span></h4>
                    <p>We offer a 24/7 customer hotline so you’re never alone if you have a question.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-14QG6nBcTXWB8xZj"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script type="text/javascript">
    $('#bayar').click(function(event) {
        event.preventDefault();


        $.ajax({
            url: '<?= site_url() ?>midtrans/snap/token',
            cache: false,
            method: "POST",
            data: {
                id_preorder: '<?= $this->uri->segment(3) ?>',
                total_bayar: '<?= $preorder->jumlah ?>'
            },
            success: function(data) {
                console.log(data);
                console.log('token = ' + data);

                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                console.log(resultType + resultData);

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                }

                snap.pay(data, {

                    onSuccess: function(result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
</script>