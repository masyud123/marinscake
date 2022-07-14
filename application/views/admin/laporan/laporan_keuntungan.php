<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Laporan Keuntungan
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3 mb-0">Pilih Bulan :</label>
                            <input id="bulan" type="month" class="form-control mr-3" style="width:max-content" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $bulan ?>">
                            <button type="button" onclick="filter()" class="btn btn-primary"><i class="fas fa-align-center mr-2"></i>Filter</button>
                            <a href="<?php echo base_url('admin/cetak_pdf/cetak_keuntungan_pdf/' . $bulan) ?>" target="_blank" class="btn btn-warning ml-3"><i class="fas fa-file mr-2"></i>Export pdf</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">1</th>
                                        <th colspan="3"><span class="ml-5">Pendapatan</span></th>
                                        <th rowspan="3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td class="text-center" colspan="2" width="400">Transaksi Langsung</td>
                                        <td>
                                            <?php foreach ($data_transaksi as $dt_trans); ?>
                                            Rp. <?= number_format($dt_trans['langsung'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-center" colspan="2">Transaksi Preorder</td>
                                        <td>
                                            <?php foreach ($data_preorder as $dt_pre); ?>
                                            Rp. <?= number_format($dt_pre['preorder'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="text-center" colspan="3">Total Pendapatan</th>
                                        <th class="text-center">Rp. <?= number_format($dt_pre['preorder'] + $dt_trans['langsung'], 0, '', '.') ?></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">2</th>
                                        <th colspan="3"><span class="ml-5">Pengeluaran</span></th>
                                        <th rowspan="3"></th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-center" colspan="2" width="400">Pengeluaran Lain-lain</td>
                                        <td>
                                            <?php foreach ($data_modal as $dt_modal); ?>
                                            Rp. <?= number_format($dt_modal['keluar_modal'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-center" colspan="2">Pengeluaran Gaji</td>
                                        <td>
                                            <?php foreach ($data_gaji as $dt_gaji); ?>
                                            Rp. <?= number_format($dt_gaji['keluar_gaji'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="text-center" colspan="3">Total Pengeluaran</th>
                                        <th class="text-center">Rp. <?= number_format($dt_modal['keluar_modal'] + $dt_gaji['keluar_gaji'], 0, '', '.') ?></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">3</th>
                                        <th class="text-center" colspan="3">Total Pendapatan Bersih</th>
                                        <th class="text-center">Rp. <?= number_format($dt_pre['preorder'] + $dt_trans['langsung'] - $dt_modal['keluar_modal'] - $dt_gaji['keluar_gaji'], 0, '', '.') ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function filter() {
        var bulan = document.getElementById('bulan').value;
        if (bulan != '') {
            window.location = "<?php echo base_url('admin/laporan/laporan_keuntungan/') ?>" + bulan;
        } else {
            swal('Informasi', 'Bulan dan tahun tidak ditemukan', 'info');
        }
    }
</script>