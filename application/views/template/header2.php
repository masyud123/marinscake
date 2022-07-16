<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link href="apple-touch-icon.png" rel="apple-touch-icon" />
    <link href="favicon.png" rel="icon" />
    <meta name="author" content="" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <title>Marins Cake</title>
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script%7CLora:400,700" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/plugins/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />

    <link rel="stylesheet" href="<?= base_url() ?>assets/client/plugins/bakery-icon/style.css" />

    <link rel="stylesheet" href="<?= base_url() ?>assets/client/plugins/owl-carousel/assets/owl.carousel.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/plugins/jquery-ui/jquery-ui.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/plugins/slick/slick/slick.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/plugins/lightGallery-master/dist/css/lightgallery.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/client/css/style.css" />

    <link rel='shortcut icon' type='image/x-icon' href='<?= base_url() ?>assets/img/marinscake-logo.png' />

    <!-- swal -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <!-- header-->
    <header class="header header--3" data-sticky="false">
        <nav class="navigation">
            <div class="container"><a class="ps-logo" href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/client/images/logo-light3.svg" alt=""></a>
                <div class="menu-toggle"><span></span></div>
                <div class="header__actions">
                    <a class="ps-search-btn" href="#"><i class="ba-magnifying-glass"></i></a>
                    <div class="ps-cart">
                        <a class=" ps-cart__toggle" href="#"><i class="ba-shopping"></i></a>
                        <div class="ps-cart__listing">
                            <div id="detail_cart"></div>
                        </div>
                    </div>
                </div>
                <ul class="menu">
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li class="<?= ($this->uri->segment(1) == 'produk') ? 'current-menu-item' : '' ?>">
                        <a href="<?= base_url() ?>produk">Product</a>
                    </li>
                    <li class="<?= ($this->uri->segment(1) == 'keranjang') ? 'current-menu-item' : '' ?>">
                        <a href="<?= base_url() ?>keranjang">Keranjang</a>
                    </li>
                    <li class="<?= ($this->uri->segment(1) == 'checkout') ? 'current-menu-item' : '' ?>">
                        <a href="<?= base_url() ?>keranjang">Checkout</a>
                    </li>
                    <li><a href="<?= base_url() ?>#company-info">About</a></li>
                </ul>
            </div>
        </nav>
    </header>