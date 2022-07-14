<div class="ps-hero bg--cover" data-background="<?= base_url() ?>assets/client/images/hero/product.jpg">
    <div class="ps-hero__content ">
        <h1> Pencarian Produk</h1>
        <div class="text-center">
            Home > Pencarian "<?= $cari ?>"
        </div>
    </div>
</div>
<main class="ps-shop">

    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-last">

                <div id="product_item" class="row">

                </div>
                <div class="row">
                    <div id="pagination" class="col-lg-12 mb-lg-5">

                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-lg-first mt-5 mt-lg-0">
                <form action="<?= base_url() ?>Produk/filter" method="post">
                    <div class="ps-sidebar">
                        <div class="widget widget_sidebar widget_category">
                            <div>
                                <h3 class="widget-title">Kategori</h3>
                            </div>
                            <ul class="ps-list--checked">
                                <?php foreach ($kategori as $ktg) : ?>
                                    <li>
                                        <a class="add_ktg" data-jenis="<?= $ktg['id_jenis'] ?>"><?= $ktg['nama_jenis'] ?></a>
                                        <input id="ktg_<?= $ktg['id_jenis'] ?>" style="display: none;" type="checkbox" name="kategori_box[]" value="<?= $ktg['id_jenis'] ?>">
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div class="widget widget_filter widget_sidebar">
                            <h3 class="widget-title">Filter Price</h3>
                            <div class="ps-slider" data-default-min="0" data-default-max="<?= $max->harga ?>" data-max="<?= $max->harga ?>" data-step="100" data-unit="Rp"></div>
                            <p class="ps-slider__meta">Price:<span id="span1" class="ps-slider__value ps-slider__min"></span>-<span id="span2" class="ps-slider__value ps-slider__max"></span></p>
                            <input type="hidden" name="min_price" id="min_price">
                            <input type="hidden" name="max_price" id="max_price">
                            <button class="ac-slider__filter ps-btn ps-btn--sm" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function() {

        $('.add_ktg').click(function() {
            var jenis = $(this).data("jenis");
            var element = document.getElementById('ktg_' + jenis);
            if (element.checked == true) {
                element.classList.remove("active");
                element.checked = false;
            } else {
                element.classList.add("active");
                element.checked = true;
            }
        });

        setInterval(function() {
            var min = document.getElementById('span1').innerText;
            var min2 = min.replace(/\D/g, '');
            var max = document.getElementById('span2').innerText;
            var max2 = max.replace(/\D/g, '');
            document.getElementById('min_price').value = min2;
            document.getElementById('max_price').value = max2;
        }, 250);

        // Detect pagination click
        $('#pagination').on('click', 'a', function(e) {
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            loadPagination(pageno);
        });

        loadPagination(0);

        // Load pagination
        function loadPagination(pagno) {
            var cari = '<?= $cari ?>';

            $.ajax({
                url: '<?= base_url() ?>Produk/pencarian/' + pagno,
                type: 'post',
                data: {
                    cari: cari
                },
                dataType: 'json',
                success: function(response) {
                    $('#pagination').html(response.pagination);
                    createTable(response.result, response.row);
                    console.log(response.xxx);
                },
                error: function(request, status, error) {
                    alert(request.responseText);
                }
            });
        }

        // Create table list
        function createTable(result, sno) {
            sno = Number(sno);
            $('#product_item').empty();
            for (index in result) {
                var id = result[index].id_produk;
                var nama = result[index].nama_produk;
                var price = result[index].harga;
                var harga = formatRupiah(price, 'Rp ');
                var stok = result[index].stok;
                var min = result[index].min_order;
                var gambar = result[index].gambar;
                sno += 1;

                var x = '<div class="col-lg-4">';
                x += '<div class="ps-product">';
                x += '<div class="ps-product__thumbnail">';
                x += '<img src="<?= base_url() ?>uploads/gambar_produk/' + gambar + '" alt="">';
                x += '<a class="ps-product__overlay" href="<?= base_url() ?>produk/detail/' + id + '"></a>';
                x += '<ul class="ps-product__actions">';
                x += '<li><a href="<?= base_url() ?>produk/detail/' + id + '" data-tooltip="Quick View"><i class="ba-magnifying-glass"></i></a></li>';
                x += '<li><a class="tambah_cart" data-tooltip="Add to Cart" data-produkid="' + id + '" data-produknama="' + nama + '" data-produkharga="' + price + '" data-produkgambar="' + gambar + '" data-produkstok="' + stok + '" data-minorder="' + min + '"><i class="ba-shopping"></i></a></li>'
                x += '</ul>';
                x += '</div>';
                x += '<div class="ps-product__content"><a class="ps-product__title" href="<?= base_url() ?>produk/detail/' + id + '">' + nama + '</a>'
                x += '<p>Min Order : ' + min + ' pcs</p>';
                x += '<p class="ps-product__price">' + harga + '</p>';
                x += '</div>';
                x += '</div>';
                x += '</div>';
                $('#product_item').append(x);
            }
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }
    });
</script>