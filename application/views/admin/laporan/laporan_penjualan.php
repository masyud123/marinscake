<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Penjualan:</h4>
                        <button class="btn btn-danger ml-1" onclick="semua()">Semua Transaksi</button>
                        <button class="btn btn-warning ml-3" onclick="langsung()">Transaksi Langsung</button>
                        <button class="btn btn-success ml-3" onclick="preorder()">Transaksi Preorder</button>
                        <button class="btn btn-primary ml-3" onclick="booking()">Transaksi Booking</button>
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3 mb-0">Pilih Bulan :</label>
                            <input class="form-control mr-3" style="width:max-content" type="month" name="bulan" id="bulan" value="<?= $bulan ?>">
                            <button class="btn btn-info" onclick="filter()">
                                <i class="fas fa-align-center mr-2"></i>Filter
                            </button>
                            <a style="display: ;" id="pdf_semua" href="<?php echo base_url('admin/cetak_pdf/cetak_semua_pdf/' . $bulan) ?>" target="_blank" class="btn btn-primary ml-3"><i class="fas fa-file mr-2"></i>Export pdf</a>
                            <a style="display: none;" id="pdf_langsung" href="<?php echo base_url('admin/cetak_pdf/cetak_langsung_pdf/' . $bulan) ?>" target="_blank" class="btn btn-primary ml-3"><i class="fas fa-file mr-2"></i>Export pdf</a>
                            <a style="display: none;" id="pdf_preorder" href="<?php echo base_url('admin/cetak_pdf/cetak_preorder_pdf/' . $bulan) ?>" target="_blank" class="btn btn-primary ml-3"><i class="fas fa-file mr-2"></i>Export pdf</a>
                            <a style="display: none;" id="pdf_booking" href="<?php echo base_url('admin/cetak_pdf/cetak_booking_pdf/' . $bulan) ?>" target="_blank" class="btn btn-primary ml-3"><i class="fas fa-file mr-2"></i>Export pdf</a>
                        </div>
                        <div class="table-responsive" id="semua">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th>Total Belanja</th>
                                        <th>Metode</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_transaksi as $dt_trans) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $dt_trans['tanggal'] ?></td>
                                            <td>Rp <?php echo number_format($dt_trans['total_belanja'], 0, '', '.') ?></td>
                                            <td><?= $dt_trans['metode'] ?></td>
                                            <td>
                                                <?php if ($dt_trans['metode'] == 'Offline') { ?>
                                                    Tunai
                                                <?php } else { ?>
                                                    Transfer
                                                <?php } ?>
                                            </td>
                                            <td><?= $dt_trans['status'] ?></td>
                                            <td>
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_detail_transaksi<?= $dt_trans['id_transaksi'] ?>"><i class="fas fa-search mr-1"></i>Detail</button>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                    foreach ($data_preorder as $dt_pre) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $dt_pre['tanggal_pesan'] ?></td>
                                            <td>Rp <?php echo number_format($dt_pre['jumlah'], 0, '', '.') ?></td>
                                            <td><?= $dt_pre['metode'] ?></td>
                                            <td>
                                                <?php if ($dt_pre['metode'] == 'Offline') { ?>
                                                    Tunai
                                                <?php } else { ?>
                                                    Transfer
                                                <?php } ?>
                                            </td>
                                            <td><?= $dt_pre['status'] ?></td>
                                            <td>
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_detail_preorder<?= $dt_pre['id_preorder'] ?>"><i class="fas fa-search mr-1"></i>Detail</button>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                    foreach ($data_booking as $dt_pre) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $dt_pre['tanggal_pesan'] ?></td>
                                            <td>Rp <?php echo number_format($dt_pre['jumlah'], 0, '', '.') ?></td>
                                            <td><?= $dt_pre['metode'] ?></td>
                                            <td>
                                                <?php if ($dt_pre['metode'] == 'Offline') { ?>
                                                    Tunai
                                                <?php } else { ?>
                                                    Transfer
                                                <?php } ?>
                                            </td>
                                            <td><?= $dt_pre['status'] ?></td>
                                            <td>
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_detail_preorder<?= $dt_pre['id_preorder'] ?>"><i class="fas fa-search mr-1"></i>Detail</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive" id="langsung" style="display: none;">
                            <table class="table table-striped" id="table-99">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th>Total Belanja</th>
                                        <th>Metode</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_transaksi as $dt_trans) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $dt_trans['tanggal'] ?></td>
                                            <td>Rp <?php echo number_format($dt_trans['total_belanja'], 0, '', '.') ?></td>
                                            <td><?= $dt_trans['metode'] ?></td>
                                            <td>
                                                <?php if ($dt_trans['metode'] == 'Offline') { ?>
                                                    Tunai
                                                <?php } else { ?>
                                                    Transfer
                                                <?php } ?>
                                            </td>
                                            <td><?= $dt_trans['status'] ?></td>
                                            <td>
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_detail_transaksi<?= $dt_trans['id_transaksi'] ?>"><i class="fas fa-search mr-1"></i>Detail</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive" id="preorder" style="display: none;">
                            <table class="table table-striped" id="table-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th>Total Belanja</th>
                                        <th>Metode</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_preorder as $dt_pre) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $dt_pre['tanggal_pesan'] ?></td>
                                            <td>Rp <?php echo number_format($dt_pre['jumlah'], 0, '', '.') ?></td>
                                            <td><?= $dt_pre['metode'] ?></td>
                                            <td>
                                                <?php if ($dt_pre['metode'] == 'Offline') { ?>
                                                    Tunai
                                                <?php } else { ?>
                                                    Transfer
                                                <?php } ?>
                                            </td>
                                            <td><?= $dt_pre['status'] ?></td>
                                            <td>
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_detail_preorder<?= $dt_pre['id_preorder'] ?>"><i class="fas fa-search mr-1"></i>Detail</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive" id="booking" style="display: none;">
                            <table class="table table-striped" id="table-66">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Tanggal Transaksi</th>
                                        <th>Total Belanja</th>
                                        <th>Metode</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_booking as $dt_pre) : ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="text-center"><?= $dt_pre['tanggal_pesan'] ?></td>
                                            <td>Rp <?php echo number_format($dt_pre['jumlah'], 0, '', '.') ?></td>
                                            <td><?= $dt_pre['metode'] ?></td>
                                            <td>
                                                <?php if ($dt_pre['metode'] == 'Offline') { ?>
                                                    Tunai
                                                <?php } else { ?>
                                                    Transfer
                                                <?php } ?>
                                            </td>
                                            <td><?= $dt_pre['status'] ?></td>
                                            <td>
                                                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal_detail_preorder<?= $dt_pre['id_preorder'] ?>"><i class="fas fa-search mr-1"></i>Detail</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- modal detail Transaksi -->
<?php foreach ($data_transaksi as $dt_trans) : ?>
    <div class="modal fade bd-example-modal-lg" id="modal_detail_transaksi<?= $dt_trans['id_transaksi'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Transaksi Langsung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($detail_transaksi as $dtl_trans) :
                                    if ($dt_trans['id_transaksi'] == $dtl_trans['id_transaksi']) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                <?= $dtl_trans['nama_produk'] ?>
                                            </td>
                                            <td>
                                                <?= $dtl_trans['jumlah'] ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($dtl_trans['harga'], 0, '', '.') ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($dtl_trans['total'], 0, '', '.') ?>
                                            </td>
                                        </tr>
                                <?php endif;
                                endforeach; ?>
                            </tbody>
                            <tfooter>
                                <td class="text-center" colspan="4"><strong>Total Belanja</strong></td>
                                <td><strong>Rp <?= number_format($dt_trans['total_belanja'], 0, '', '.') ?></strong></td>
                            </tfooter>
                        </table>
                    </div>
                    <div align="right">
                        <button class="btn btn-info" type="button" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- modal detail Preorder -->
<?php foreach ($data_preorder as $dt_pre) : ?>
    <div class="modal fade bd-example-modal-lg" id="modal_detail_preorder<?= $dt_pre['id_preorder'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Transaksi Preorder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($detail_preorder as $dtl_pre) :
                                    if ($dt_pre['id_preorder'] == $dtl_pre['id_preorder']) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                <?= $dtl_pre['nama_produk'] ?>
                                            </td>
                                            <td>
                                                <?= $dtl_pre['jumlah'] ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($dtl_pre['harga'], 0, '', '.') ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($dtl_pre['total'], 0, '', '.') ?>
                                            </td>
                                        </tr>
                                <?php endif;
                                endforeach; ?>
                                <tr>
                                    <td align="center" colspan="2"><b>Daerah Kirim</b></td>
                                    <td align="center" colspan="2"><?=$dt_pre['nama_kota']?></td>
                                    <td align="left" colspan="0">Rp <?= number_format($dt_pre['ongkir'], 0, '', '.') ?></td>
                                </tr>
                            </tbody>
                            <tfooter>
                                <td class="text-center" colspan="4"><strong>Total Belanja</strong></td>
                                <td><strong>Rp <?= number_format($dt_pre['jumlah'], 0, '', '.') ?></strong></td>
                            </tfooter>
                        </table>
                    </div>
                    <div align="right">
                        <button class="btn btn-info" type="button" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- modal detail Preorder -->
<?php foreach ($data_booking as $dt_pre) : ?>
    <div class="modal fade bd-example-modal-lg" id="modal_detail_preorder<?= $dt_pre['id_preorder'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Transaksi Preorder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($detail_preorder as $dtl_pre) :
                                    if ($dt_pre['id_preorder'] == $dtl_pre['id_preorder']) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                <?= $dtl_pre['nama_produk'] ?>
                                            </td>
                                            <td>
                                                <?= $dtl_pre['jumlah'] ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($dtl_pre['harga'], 0, '', '.') ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($dtl_pre['total'], 0, '', '.') ?>
                                            </td>
                                        </tr>
                                <?php endif;
                                endforeach; ?>
                            </tbody>
                            <tfooter>
                                <td class="text-center" colspan="4"><strong>Total Belanja</strong></td>
                                <td><strong>Rp <?= number_format($dt_pre['jumlah'], 0, '', '.') ?></strong></td>
                            </tfooter>
                        </table>
                    </div>
                    <div align="right">
                        <button class="btn btn-info" type="button" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    function semua() {
        $('#semua').show();
        $('#langsung').hide();
        $('#preorder').hide();
        $('#booking').hide();
        $('#pdf_semua').show();
        $('#pdf_langsung').hide();
        $('#pdf_preorder').hide();
        $('#pdf_booking').hide();
    }

    function langsung() {
        $('#langsung').show();
        $('#preorder').hide();
        $('#semua').hide();
        $('#booking').hide();
        $('#pdf_semua').hide();
        $('#pdf_langsung').show();
        $('#pdf_preorder').hide();
        $('#pdf_booking').hide();
    }

    function preorder() {
        $('#langsung').hide();
        $('#preorder').show();
        $('#semua').hide();
        $('#booking').hide();
        $('#pdf_langsung').hide();
        $('#pdf_preorder').show();
        $('#pdf_semua').hide();
        $('#pdf_booking').hide();
    }

    function booking() {
        $('#langsung').hide();
        $('#preorder').hide();
        $('#semua').hide();
        $('#booking').show();
        $('#pdf_langsung').hide();
        $('#pdf_preorder').hide();
        $('#pdf_semua').hide();
        $('#pdf_booking').show();
    }

    function filter() {
        var bulan = document.getElementById('bulan').value;
        if (bulan != '') {
            window.location = "<?php echo base_url('admin/laporan/laporan_penjualan/') ?>" + bulan;
        } else {
            swal('Informasi', 'Bulan dan tahun tidak ditemukan', 'info');
        }
    }
</script>