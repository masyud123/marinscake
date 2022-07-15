<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/client/images/hero/about.jpg">
    <div class="ps-hero__content ">
        <h1> Detail Produk</h1>
        <div class="text-center">
            Home > Detail Produk
        </div>
    </div>
</div>
<main class="ps-main">
    <div class="container">
        <div class="ps-product--detail py-0 my-0">
            <div class="row">
                <?php foreach ($produk as $prd) : ?>
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="ps-product__thumbnail">
                            <div class="ps-product__image">
                                <?php foreach ($gambar as $gbr) : ?>
                                    <div class="item"><a href="<?= base_url() ?>uploads/gambar_produk/<?= $gbr['gambar'] ?>"><img src="<?= base_url() ?>uploads/gambar_produk/<?= $gbr['gambar'] ?>" alt=""></a></div>
                                <?php endforeach ?>
                            </div>
                            <div class="ps-product__preview">
                                <div class="ps-product__variants">
                                    <?php foreach ($gambar as $gbr) : ?>
                                        <div class="item"><img src="<?= base_url() ?>uploads/gambar_produk/<?= $gbr['gambar'] ?>" alt=""></div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12 ">
                        <div class="ps-product__info">
                            <h1 class="text-uppercase"><?= $prd['nama_produk'] ?></h1>
                            <div class="ps-product__rating">
                            </div>
                            <h3 class="ps-product__price"><span>Rp <?= number_format($prd['harga'], '0', ',', '.') ?></span></h3>
                            <div class="ps-product__desc">
                                <h5>DESKRIPSI</h5>
                                <p><?= $prd['deskripsi'] ?></p>
                            </div>
                            <div class="ps-product__status">
                                <h5>Min order : <span> <?= $prd['min_order'] ?></span></h5>
                            </div>
                            <div class="ps-product__shopping">
                                <form class="ps-form--shopping" id="cart" action="" method="post">
                                    <div class="form-group--number">
                                        <button class="minus"><span>-</span></button>
                                        <input id="<?= $prd['id_produk'] ?>" class="form-control" type="text" value="<?= $prd['min_order'] ?>">
                                        <button class="plus"><span>+</span></button>
                                    </div>
                                </form>
                            </div>
                            <div class="ps-product__shopping">
                                <?php $i = 0;
                                foreach ($gambar as $gbr) :
                                    if ($i == 0) : ?>
                                        <button class="add_cart ps-btn ps-btn--yellow" data-produkid="<?= $prd['id_produk'] ?>" data-produknama="<?= $prd['nama_produk'] ?>" data-produkharga="<?= $prd['harga'] ?>" data-produkgambar="<?= $gbr['gambar'] ?>" data-produkstok="<?= $prd['stok'] ?>" data-minorder="<?= $prd['min_order'] ?>">Masukkan Keranjang</button>
                                <?php endif;
                                    $i++;
                                endforeach; ?>
                            </div>
                            <!-- <div class="ps-product__sharing">
                                <p class="text-right">Bagikan<a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a></p>
                            </div> -->
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</main>
<div class="ps-related-product ">
    <div class="container">
        <div class="ps-section__header text-center">
            <h3 class="ps-section__title">Related Products</h3>
            <p>Maybe you like</p><span><img src="<?= base_url() ?>assets/client/images/icons/floral.png" alt=""></span>
        </div>
        <div id="produk_rekom" class="ps-section__content">
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function() {
        $(document).on('click', '#btn_load', function(e) {
            var no = $(this).data("no");
            loadRekom(no);
        });
        loadRekom(0);
        function loadRekom(no) {
            var id_produk = '<?= $this->uri->segment("3") ?>';
            $.ajax({
                url: '<?= base_url() ?>produk/load_rekom/' + no,
                type: 'post',
                data: {
                    id_produk: id_produk
                },
                success: function(response) {
                    $('#produk_rekom').html(response);
                }
            });
        }
    });
</script>