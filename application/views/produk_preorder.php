<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/client/images/hero/product.jpg">
    <div class="ps-hero__content ">
        <h1> Produk Preorder</h1>
        <div class="text-center">
            Home > Preorder
        </div>
    </div>
</div>
<main class="ps-shop">

    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last">
                <div class="row">
                    <?php foreach ($produk as $prd) : ?>
                        <div class="col-lg-4">
                            <div class="ps-product">
                                <div class="ps-product__thumbnail"><img src="<?= base_url() ?>uploads/gambar_produk/<?= $prd['gambar'] ?>" alt=""><a class="ps-product__overlay" href="<?= base_url() ?>preorder/detail/<?= $prd['id_produk'] ?>"></a>
                                    <ul class="ps-product__actions">
                                        <li><a href="<?= base_url() ?>Preorder/detail/<?= $prd['id_produk'] ?>" data-tooltip="Quick View"><i class="ba-magnifying-glass"></i></a></li>
                                        <li><a class="tambah_cart" data-tooltip="Add to Cart" data-produkid="<?= $prd['id_produk'] ?>" data-produknama="<?= $prd['nama_produk'] ?>" data-produkharga="<?= $prd['harga'] ?>" data-produkgambar="<?= $prd['gambar'] ?>" data-produkstok="<?= $prd['stok'] ?>"><i class="ba-shopping"></i></a></li>
                                    </ul>
                                    <script></script>
                                </div>
                                <div class="ps-product__content"><a class="ps-product__title" href="<?= base_url() ?>preorder/detail/<?= $prd['id_produk'] ?>"><?= $prd['nama_produk'] ?></a>
                                    <!-- <p><a href="">Stok Produk : <?= $prd['stok'] ?></a></p> -->
                                    <p class="ps-product__price">Rp <?= number_format($prd['harga'], 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="col-lg-12 mb-lg-5">
                        <div class="ps-pagination mb-lg-5 ">
                            <ul class="pagination">
                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-lg-first mt-5 mt-lg-0">
                <div class="ps-sidebar">
                    <div class="widget widget_sidebar widget_category">
                        <h3 class="widget-title">Kategori</h3>
                        <ul class="ps-list--checked">
                            <?php foreach ($kategori as $ktg) : ?>
                                <li><a href=""><?= $ktg['nama_jenis'] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <div class="widget widget_filter widget_sidebar">
                        <h3 class="widget-title">Filter Price</h3>
                        <div class="ps-slider" data-default-min="0" data-default-max="500" data-max="1000" data-step="100" data-unit="$"></div>
                        <p class="ps-slider__meta">Price:<span class="ps-slider__value ps-slider__min"></span>-<span class="ps-slider__value ps-slider__max"></span></p><a class="ac-slider__filter ps-btn ps-btn--sm" href="#">Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>