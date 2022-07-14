<div class="container">
    <div class="pb-80" id="slider">
        <div class="ps-carousel--animate ps-carousel--1st">
            <?php foreach ($slider as $slide) : ?>
                <div class="item">
                    <div class="ps-product--banner">
                        <img src="<?= base_url() ?>uploads/slider/<?= $slide['gambar'] ?>" alt="" />
                        <div class="ps-product__footer">
                            <a class="ps-btn py-2 px-4 py-lg-3 px-lg-5" href="<?= base_url() ?>produk">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<!-- award-->
<div class="ps-awards">
    <div class="container">
        <div class="ps-section__header">
            <h3 class="ps-section__title">Tentang Kita</h3>
            <p>SELAMAT DATANG DI MARINS CAKE</p>
            <span><img src="<?= base_url() ?>assets/client/images/icons/floral.png" alt="" /></span>
        </div>
        <div class="ps-section__content">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="ps-block--award">
                        <img src="<?= base_url() ?>assets/client/images/icons/award-1.png" alt="" />
                        <h4>BAHAN PREMIUM DAN BERKUALITAS</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="ps-block--award">
                        <img src="<?= base_url() ?>assets/client/images/icons/award-2.png" alt="" />
                        <h4>ROTI FRESH TIAP HARI</h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="ps-block--award">
                        <img src="<?= base_url() ?>assets/client/images/icons/award-2.png" alt="" />
                        <h4>BAKERY OF THE YEAR</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Home 1 products-->
<div class="ps-home-product bg--cover" data-background="<?= base_url() ?>assets/client/images/bg/home-product.jpg">
    <div class="container">
        <div class="ps-section__header">
            <h3 class="ps-section__title">Produk Terbaru</h3>
            <p>Produk terbaru dari kami</p>
            <span><img src="<?= base_url() ?>assets/client/images/icons/floral.png" alt="" /></span>
        </div>
        <div class="ps-section__content">
            <div class="row">
                <?php foreach ($produk as $prd) : ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="ps-product ps-product--horizontal d-flex align-items-center">
                            <div class="ps-product__thumbnail">
                                <?php foreach ($gambar as $gbr) :
                                    if ($gbr['id_produk'] == $prd['id_produk']) : ?>
                                        <img src="<?= base_url() ?>uploads/gambar_produk/<?= $gbr['gambar'] ?>" alt="" />
                                <?php endif;
                                endforeach ?>
                                <a class="ps-product__overlay" href="<?= base_url() ?>produk/detail/<?= $prd['id_produk'] ?>"></a>
                                <ul class="ps-product__actions">
                                    <li>
                                        <a href="<?= base_url() ?>Produk/detail/<?= $prd['id_produk'] ?>" data-tooltip="Quick View"><i class="ba-magnifying-glass"></i></a>
                                    </li>
                                    <li>
                                        <?php foreach ($gambar as $gbr) :
                                            if ($gbr['id_produk'] == $prd['id_produk']) : ?>
                                                <a class="tambah_cart" data-produkid="<?= $prd['id_produk'] ?>" data-produknama="<?= $prd['nama_produk'] ?>" data-produkharga="<?= $prd['harga'] ?>" data-produkgambar="<?= $gbr['gambar'] ?>" data-minorder="<?= $prd['min_order'] ?>" data-tooltip="Add To Cart"><i class="ba-shopping"></i></a>
                                        <?php endif;
                                        endforeach ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="ps-product__content">
                                <a class="ps-product__title" href="<?= base_url() ?>Produk/detail/<?= $prd['id_produk'] ?>"><?= $prd['nama_produk'] ?></a>
                                <p>
                                    min order <?= $prd['min_order'] ?> pcs
                                </p>
                                <p class="ps-product__price">Rp <?= number_format($prd['harga'], '0', ',', '.') ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="text-center ps-product__footer">
                <a class="ps-btn mb-5 py-3 px-5" href="<?= base_url() ?>Produk">Produk Lainnya</a>
            </div>
        </div>
    </div>
</div>
<div class="ps-delivery-form bg--parallax" data-background="<?= base_url() ?>assets/client/images/bg/delivery-form.jpg" id="company-info">
    <div class="ps-block--delivery">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="ps-block__content">
                    <div class="ps-block--contact">
                        <h4>KONTAK</h4>
                        <h5>Whatsapp : 0858-1260-1646</h5>
                        <a class="btn btn-light" target="_blank" href="https://wa.me/6285812601646?text=Halo%20Admin%20Marins%20Cake,%20Saya%20mau%20order..">
                            <h4 class="text-dark">Chat Admin</h4>
                        </a>
                    </div>
                    <div class="ps-block--contact">
                        <h4>ALAMAT TOKO</h4>
                        <h5>
                            Jalan Dandang Gendis No. 335B Kelurahan Doko Kecamatan Ngasem
                            Kediri Jawa Timur 64182 Indonesia
                        </h5>
                    </div>
                    <div class="ps-block--contact">
                        <h4>JAM BUKA</h4>
                        <h5>
                            Senin - Jumat : 07.00 - 20.00 <br />
                            Sabtu - Minggu : 09.00 - 20.00
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="ps-block--contact">
                    <h4>MAP</h4>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.739596274058!2d112.03954931435698!3d-7.817364679794704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7857638a8d3c03%3A0xab61df830e15f8a!2sMaRins%20Cake!5e0!3m2!1sid!2sid!4v1644653292572!5m2!1sid!2sid" width="600" height="275" style="margin: 0px" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>