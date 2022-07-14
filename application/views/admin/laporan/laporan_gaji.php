<?php echo $this->session->flashdata('gaji_karyawan'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Laporan Gaji
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group d-flex align-items-center">
                                <label class="mr-3 mb-0">Pilih Bulan :</label>
                                <input id="bulan" type="month" name="search_bulan" class="form-control mr-3" style="width:max-content" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $bulan ?>">
                                <button type="button" onclick="ambil_bulan()" class="btn btn-primary"><i class="fas fa-align-center mr-2"></i>Filter</button>
                                <a href="<?php echo base_url('admin/cetak_pdf/cetak_gaji_pdf/' . $bulan) ?>" target="_blank" class="btn btn-warning ml-3"><i class="fas fa-file mr-2"></i>Export pdf</a>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Karyawan</th>
                                        <th>Gaji</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_karyawan as $data_kr) : if($data_kr['status'] == 1): ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                <?= $data_kr['nama'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($gaji_karyawan == null) : ?>
                                                    Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                                                    <?php else :
                                                    foreach ($gaji_karyawan as $gaji_kr) :
                                                        $gj_kr[] = $gaji_kr['id_karyawan'] . $gaji_kr['bulan'];
                                                    endforeach;

                                                    if (in_array($data_kr['id_karyawan'] . $bulan, $gj_kr)) :

                                                        foreach ($gaji_karyawan as $gaji_kr) :
                                                            if ($gaji_kr['id_karyawan'] == $data_kr['id_karyawan'] && $gaji_kr['bulan'] == $bulan) : ?>
                                                                <?= 'Rp' . number_format($gaji_kr['uang_gaji'], 0, '', '.'); ?>
                                                        <?php endif;
                                                        endforeach; ?>

                                                    <?php else : ?>
                                                        Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($gaji_karyawan == null) {
                                                    echo "Belum Terbayar";
                                                } else {
                                                    foreach ($gaji_karyawan as $gaji_kr) :
                                                        $gj_kr[] = $gaji_kr['id_karyawan'] . $gaji_kr['bulan'];
                                                    endforeach;

                                                    if (in_array($data_kr['id_karyawan'] . $bulan, $gj_kr)) {
                                                        echo "Terbayar";
                                                    } else {
                                                        echo "Belum terbayar";
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                if ($gaji_karyawan == null) { ?>
                                                    <div id="Konfirmasi1<?= $data_kr['id_karyawan'] ?>">
                                                        <button onclick="window.location.href='<?php echo base_url('admin/laporan/gaji_lunas/' . $data_kr['id_karyawan'] . '_' . $bulan) ?>'" class="btn btn-success" type="button"><i class="fas fa-check mr-2"></i>Konfirmasi</button>
                                                    </div>

                                                    <?php } else {
                                                    foreach ($gaji_karyawan as $gaji_kr) :
                                                        $gj_kr[] = $gaji_kr['id_karyawan'] . $gaji_kr['bulan'];
                                                    endforeach;

                                                    if (in_array($data_kr['id_karyawan'] . $bulan, $gj_kr)) { ?>
                                                        <?php foreach ($gaji_karyawan as $gaji_kr) :
                                                            if ($gaji_kr['id_karyawan'] == $data_kr['id_karyawan'] && $gaji_kr['bulan'] == $bulan) : ?>
                                                                <button onclick="window.location.href='<?php echo base_url('admin/laporan/hapus_gaji/' . $gaji_kr['id_gaji']) ?>'" class="btn btn-danger col-6" type="button"><i class="fas fa-times mr-2"></i>Batal</button>
                                                        <?php endif;
                                                        endforeach; ?>
                                                    <?php } else { ?>
                                                        <div id="Konfirmasi2<?= $data_kr['id_karyawan'] ?>">
                                                            <button onclick="window.location.href='<?php echo base_url('admin/laporan/gaji_lunas/' . $data_kr['id_karyawan'] . '_' . $bulan) ?>'" class="btn btn-success" type="button"><i class="fas fa-check mr-2"></i>Konfirmasi</button>
                                                        </div>
                                                <?php }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php else: ?>
                                        <tr>
                                            <?php
                                                if ($gaji_karyawan == null) {
                                                    
                                                } else {
                                                    foreach ($gaji_karyawan as $gaji_kr) :
                                                        $gj_kr[] = $gaji_kr['id_karyawan'] . $gaji_kr['bulan'];
                                                    endforeach;

                                                    if (in_array($data_kr['id_karyawan'] . $bulan, $gj_kr)) {?>
                                                        <td class="text-center">
                                                            <?= $no++ ?>
                                                        </td>
                                                        <td>
                                                            <?= $data_kr['nama'] ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($gaji_karyawan == null) : ?>
                                                                Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                                                                <?php else :
                                                                foreach ($gaji_karyawan as $gaji_kr) :
                                                                    $gj_kr[] = $gaji_kr['id_karyawan'] . $gaji_kr['bulan'];
                                                                endforeach;
            
                                                                if (in_array($data_kr['id_karyawan'] . $bulan, $gj_kr)) :
            
                                                                    foreach ($gaji_karyawan as $gaji_kr) :
                                                                        if ($gaji_kr['id_karyawan'] == $data_kr['id_karyawan'] && $gaji_kr['bulan'] == $bulan) : ?>
                                                                            <?= 'Rp' . number_format($gaji_kr['uang_gaji'], 0, '', '.'); ?>
                                                                    <?php endif;
                                                                    endforeach; ?>
            
                                                                <?php else : ?>
                                                                    Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($gaji_karyawan == null) {
                                                                echo "Belum Terbayar";
                                                            } else {
                                                                foreach ($gaji_karyawan as $gaji_kr) :
                                                                    $gj_kr[] = $gaji_kr['id_karyawan'] . $gaji_kr['bulan'];
                                                                endforeach;
            
                                                                if (in_array($data_kr['id_karyawan'] . $bulan, $gj_kr)) {
                                                                    echo "Terbayar";
                                                                } else {
                                                                    echo "Belum terbayar";
                                                                }
                                                            }
                                                            ?>
                                                        </td>
                                                        <td align="center">
                                                            <?php
                                                            if ($gaji_karyawan == null) { ?>
                                                                <div id="Konfirmasi1<?= $data_kr['id_karyawan'] ?>">
                                                                    <button onclick="window.location.href='<?php echo base_url('admin/laporan/gaji_lunas/' . $data_kr['id_karyawan'] . '_' . $bulan) ?>'" class="btn btn-success" type="button"><i class="fas fa-check mr-2"></i>Konfirmasi</button>
                                                                </div>
            
                                                                <?php } else {
                                                                foreach ($gaji_karyawan as $gaji_kr) :
                                                                    $gj_kr[] = $gaji_kr['id_karyawan'] . $gaji_kr['bulan'];
                                                                endforeach;
            
                                                                if (in_array($data_kr['id_karyawan'] . $bulan, $gj_kr)) { ?>
                                                                    <?php foreach ($gaji_karyawan as $gaji_kr) :
                                                                        if ($gaji_kr['id_karyawan'] == $data_kr['id_karyawan'] && $gaji_kr['bulan'] == $bulan) : ?>
                                                                            <button onclick="window.location.href='<?php echo base_url('admin/laporan/hapus_gaji/' . $gaji_kr['id_gaji']) ?>'" class="btn btn-danger col-6" type="button"><i class="fas fa-times mr-2"></i>Batal</button>
                                                                    <?php endif;
                                                                    endforeach; ?>
                                                                <?php } else { ?>
                                                                    <div id="Konfirmasi2<?= $data_kr['id_karyawan'] ?>">
                                                                        <button onclick="window.location.href='<?php echo base_url('admin/laporan/gaji_lunas/' . $data_kr['id_karyawan'] . '_' . $bulan) ?>'" class="btn btn-success" type="button"><i class="fas fa-check mr-2"></i>Konfirmasi</button>
                                                                    </div>
                                                            <?php }
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php }
                                                }
                                            ?>
                                        </tr>
                                    <?php endif; endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    function ambil_bulan() {
        var bulan = document.getElementById('bulan').value;
        if (bulan != '') {
            window.location = "<?php echo base_url('admin/laporan/laporan_gaji/') ?>" + bulan;
        } else {
            swal('Informasi', 'Bulan dan tahun tidak ditemukan', 'info');
        }
    }
</script>