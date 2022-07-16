<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/client/images/hero/about.jpg">
    <div class="ps-hero__content ">
        <h1> Checkout Preorder</h1>
        <div class="text-center">
            Keranjang > Checkout
        </div>
    </div>
</div>
<main class="ps-main">
    <div class="ps-checkout">
        <div class="container">
            <form class="ps-form--checkout" action="<?= base_url() ?>Checkout/save_order" method="post">
                <div class="row">
                    <div class="col-lg-7 col-md-8 col-sm-12 col-xs-12 ">
                        <div class="ps-checkout__billing px-0">
                            <h3>Data Pembeli</h3>
                            <div class="form-group form-group--inline d-flex align-items-center">
                                <label class="m-0">Nama<span>*</span>
                                </label>
                                <div class="form-group__content">
                                    <input class="form-control" name="nama" placeholder="nama Anda" type="text" required>
                                </div>
                            </div>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">Email<span>*</span>
                                </label>
                                <div class="form-group__content">
                                    <input class="form-control" type="email" placeholder="email Anda" name="email" required>
                                </div>
                            </div>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">No Hp<span>*</span>
                                </label>
                                <div class="form-group__content">
                                    <input class="form-control" type="number" placeholder="no HP Anda" name="no_hp" required>
                                </div>
                            </div>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">Kota<span>*</span>
                                </label>
                                <div class="form-group__content">
                                    <select class="form-control selectric" name="kota" id="kota" onchange="cek_ongkir(this)" required>
                                        <option value="" hidden>pilih daerah pengiriman</option>
                                        <?php foreach ($kota as $kot) : ?>
                                            <option value="<?= $kot['id_daerah'] ?>" data-ongkir="<?= $kot['ongkir'] ?>"><?= $kot['nama_kota'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">Alamat<span>*</span>
                                </label>
                                <div class="form-group__content">
                                    <textarea class="form-control" rows="5" placeholder="alamat lengkap Anda" name="alamat" required></textarea>
                                </div>
                            </div>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">Tanggal Pengiriman<span>*</span>
                                </label>
                                <div class="form-group__content">
                                    <?php $today = date('Y-m-d');
                                    $tgl = date('Y-m-d', strtotime('+3 days', strtotime($today)));
                                    ?>
                                    <input class="form-control" type="text" placeholder="minimal tanggal kirim" onfocus="(this.type='date')" name="tanggal_kirim" min="<?= $tgl ?>" required>
                                </div>
                            </div>
                            <div class="form-group form-group--inline  d-flex align-items-center">
                                <label class="m-0">Catatan Pesanan</label>
                                <div class="form-group__content">
                                    <textarea class="form-control" rows="5" placeholder="catatan pesanan Anda" name="catatan"></textarea>
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
                                <?php foreach ($keranjang as $cart) : ?>
                                    <div class="row my-3">
                                        <div class="col-3">
                                            <?= $cart['name'] ?>
                                        </div>
                                        <div class="col-2">
                                            <?= $cart['qty'] ?>
                                        </div>
                                        <div class="col-3">
                                            Rp <?= number_format($cart['price'], '0', ',', '.') ?>
                                        </div>
                                        <div class="col-4">
                                            Rp <?= number_format($cart['subtotal'], '0', ',', '.') ?>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                                <div class="row my-3">
                                    <div id="nama_ongkir" class="col-8">

                                    </div>
                                    <div class="col-4">
                                        <div id="ongkir"></div>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid white">
                                <div class="row mt-3 text-uppercase">
                                    <div class="col-8 font-weight-bold">
                                        Total Harga
                                    </div>
                                    <div class="col-4 font-weight-bold" id="total">
                                        Rp <?= number_format($this->cart->total(), '0', ',', '.') ?>
                                    </div>
                                    <input type="hidden" name="total_belanja" id="total_belanja">
                                    <input type="hidden" name="ongkir" id="ongkos">
                                </div>
                            </div>
                            <footer class="p-0">
                                <div class="form-group paypal">
                                    <?php if ($this->cart->total() == 0) : ?>
                                        <button disabled class="ps-btn ps-btn--fullwidth ps-btn--yellow font-weight-bold">Keranjang Kosong</button>
                                    <?php else : ?>
                                        <button type="submit" id="next" class="lanjutkan ps-btn ps-btn--fullwidth ps-btn--yellow font-weight-bold">Lanjutkan</button>
                                    <?php endif ?>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </form>
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
<script>
    function cek_ongkir(sel) {
        var opt = sel.options[sel.selectedIndex];
        var price = opt.dataset.ongkir;
        var total_awal = '<?= $this->cart->total() ?>';
        var total = parseInt(total_awal) + parseInt(price);
        var total_akhir = total.toString();
        document.getElementById("total_belanja").value = total_akhir;
        document.getElementById("ongkos").value = price;
        var price2 = formatRupiah(price, "Rp ");
        var total_akhir2 = formatRupiah(total_akhir, "Rp ");
        document.getElementById("nama_ongkir").innerHTML = "Ongkir";
        document.getElementById("ongkir").innerHTML = price2;
        document.getElementById("total").innerHTML = total_akhir2;

    }

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
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }
</script>