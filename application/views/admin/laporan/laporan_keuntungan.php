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
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="text-center bg-secondary">1</th>
                                        <th class="bg-secondary" colspan="3"><span class="ml-5">Pendapatan</span></th>
                                    </tr>
                                    <tr>
                                        <td rowspan="4"></td>
                                        <td class="text-center" colspan="2" width="400">Transaksi Langsung</td>
                                        <td>
                                            <?php foreach ($data_transaksi as $dt_trans); ?>
                                            Rp. <?= number_format($dt_trans['langsung'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">Transaksi Preorder</td>
                                        <td>
                                            <?php foreach ($data_preorder as $dt_pre); ?>
                                            Rp. <?= number_format($dt_pre['preorder'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">Transaksi Booking</td>
                                        <td>
                                            <?php foreach ($data_booking as $dt_book); ?>
                                            Rp. <?= number_format($dt_book['preorder'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center" colspan="2">Total Pendapatan</th>
                                        <th>Rp. <?= number_format($dt_pre['preorder'] + $dt_trans['langsung'] + $dt_book['preorder'], 0, '', '.') ?></th>
                                    </tr>
                                    <tr>
                                        <th class="text-center bg-secondary">2</th>
                                        <th colspan="3" class="bg-secondary"><span class="ml-5">Pengeluaran</span></th>
                                    </tr>
                                    <tr>
                                        <td rowspan="4"></td>
                                        <td class="text-center" colspan="2" width="400">Bahan Baku</td>
                                        <td>
                                            Rp. <?= number_format($data_modal[0][0]['bahan_baku'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2" width="400">Akomodasi</td>
                                        <td>
                                            Rp. <?= number_format($data_modal[1][0]['akomodasi'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2" width="400">Lain-lain</td>
                                        <td>
                                            Rp. <?= number_format($data_modal[2][0]['lain_lain'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">Gaji</td>
                                        <td>
                                            <?php foreach ($data_gaji as $dt_gaji); ?>
                                            Rp. <?= number_format($dt_gaji['keluar_gaji'], 0, '', '.') ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="text-center" colspan="2">Total Pengeluaran</th>
                                        <th>Rp. 
                                            <?= number_format(
                                                $data_modal[0][0]['bahan_baku']+
                                                $data_modal[1][0]['akomodasi']+
                                                $data_modal[2][0]['lain_lain']+
                                                $dt_gaji['keluar_gaji'], 
                                            0, '', '.') ?>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-center bg-secondary">3</th>
                                        <th class="text-center bg-secondary" colspan="2">Total Pendapatan Bersih</th>
                                        <th class="bg-secondary">Rp. 
                                            <?= number_format(
                                                (
                                                    $dt_pre['preorder']+$dt_trans['langsung']+$dt_book['preorder']
                                                )-(
                                                    $data_modal[0][0]['bahan_baku']+
                                                    $data_modal[1][0]['akomodasi']+
                                                    $data_modal[2][0]['lain_lain']+
                                                    $dt_gaji['keluar_gaji']
                                                ), 
                                            0, '', '.') ?>    
                                        </th>
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