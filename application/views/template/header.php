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
    <div class="ps-search">
        <div class="ps-search__content">
            <a class="ps-search__close" href="#"><span></span></a>
            <form class="ps-form--search-2" action="<?= base_url() ?>produk/cari" method="post">
                <h3>Cari produk yang Anda inginkan</h3>
                <div class="form-group">
                    <input class="form-control" type="text" name="cari" placeholder="" />
                    <button class="ps-btn active ps-btn--fullwidth">Search</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Header-->
    <header class="header header--1">
        <nav class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-5 d-flex align-items-center pr-5">
                        <ul class="menu d-flex justify-content-between w-100">
                            <li class="menu-item-has-children current-menu-item">
                                <a href="">Home</a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>produk">Product</a>
                            </li>
                            <li><a href="<?= base_url() ?>keranjang">Keranjang</a></li>
                        </ul>
                    </div>
                    <div class="col-2 d-flex align-items-center">
                        <a class="ps-logo" href="<?= base_url() ?>"><img src="<?= base_url() ?>assets/client/images/logo-light2.svg" alt="" /></a>
                    </div>
                    <div class="col-5 d-flex align-items-center justify-content-between pl-5">
                        <ul class="menu d-flex justify-content-between w-75">
                            <li><a href="<?= base_url() ?>keranjang">Checkout</a></li>
                            <li><a href="<?= base_url() ?>#company-info">About</a></li>
                        </ul>
                        <div class="header__actions w-50 text-right">
                            <a class="ps-search-btn" href="#"><i class="ba-magnifying-glass"></i></a>
                            <div class="ps-cart"><a class="ps-cart__toggle" href="#"><i class="ba-shopping"></i></a>
                                <div class="ps-cart__listing">
                                    <div id="detail_cart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <nav class="navigation--mobile">
            <div class="ps-container">
                <a class="ps-logo" href="#"><img src="<?= base_url() ?>assets/client/images/logo-light3.svg" alt="" /></a>
                <ul class="menu menu--mobile">
                    <li class="current-menu-item menu-item-has-children">
                        <a href="">Home</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>produk">Product</a>
                    </li>
                    <li><a href="<?= base_url() ?>keranjang">Keranjang</a></li>
                    <li>
                        <a href="<?= base_url() ?>checkout">Checkout</a>
                    </li>
                    <li>
                        <a href="<?= base_url() ?>#company-info">About</a>
                    </li>
                </ul>
                <div class="menu-toggle"><span></span></div>
                <div class="header__actions">
                    <a class="ps-search-btn" href="#"><i class="ba-magnifying-glass"></i></a>
                    <div class="ps-cart">
                        <a class="ps-cart__toggle" href="#"><span><i></i></span><i class="ba-shopping"></i></a>
                        <div class="ps-cart__listing">
                            <div id="detail_cart2"></div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>