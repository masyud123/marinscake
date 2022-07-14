<?= $this->session->flashdata('preorder') ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Daftar Transaksi Preorder Belum Dibayar
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            ID
                                        </th>
                                        <th>Jumlah Transaksi</th>
                                        <th>Metode</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Tanggal Dikirim</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($riwayat_preorder as $rw_pr) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($rw_pr['jumlah'], 0, '', '.') ?>
                                            </td>
                                            <td>
                                                <?= $rw_pr['metode'] ?>
                                            </td>
                                            <td>
                                                <?= $rw_pr['tanggal_pesan'] ?>
                                            </td>
                                            <td>
                                                <?= $rw_pr['tanggal_dikirim'] ?>
                                            </td>
                                            <td>
                                                <?= $rw_pr['status'] ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal_detail_preorder<?= $rw_pr['id_preorder'] ?>">
                                                        <i class="fas fa-search"></i> Detail</button>
                                                    <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal_edit_preorder<?php echo $rw_pr['id_preorder'] ?>">
                                                        <i class="fas fa-pen"></i> Edit</button>
                                                </div>
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
<?php foreach ($riwayat_preorder as $rw_pr) : ?>
    <div class="modal fade bd-example-modal-lg" id="modal_detail_preorder<?= $rw_pr['id_preorder'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail preorder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-8">
                            <div class="form-group">
                                <label>
                                    Nama Penerima
                                </label>
                                <input type="text" name="metode" class="form-control" readonly value="<?= $rw_pr['nama'] ?>">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>
                                    No Hp
                                </label>
                                <div class="input-group">
                                    <input type="text" name="metode" class="form-control" readonly value="<?= $rw_pr['no_hp'] ?>">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <?php if(substr($rw_pr['no_hp'],0,1) == "0") : ?>
                                            <a target="_blank" href="https://wa.me/62<?= substr($rw_pr['no_hp'],1) ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i></a>
                                            <?php elseif (substr($rw_pr['no_hp'],0,1) == "+") : ?>
                                            <a target="_blank" href="https://wa.me/<?= substr($rw_pr['no_hp'],1) ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i></a>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>
                                    Alamat Pengiriman
                                </label>
                                <textarea class="form-control" readonly><?= $rw_pr['alamat'] ?>, <?= $rw_pr['nama_kota'] ?></textarea>
                            </div>
                        </div>
                    </div>
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
                                foreach ($detail_preorder as $dt_tr) :
                                    if ($rw_pr['id_preorder'] == $dt_tr['id_preorder']) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                <?= $dt_tr['nama_produk'] ?>
                                            </td>
                                            <td>
                                                <?= $dt_tr['jumlah'] ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($dt_tr['harga'], 0, '', '.') ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($dt_tr['total'], 0, '', '.') ?>
                                            </td>
                                        </tr>
                                <?php endif;
                                endforeach; ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        Ongkir
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        Rp <?= number_format($rw_pr['ongkir'], 0, '', '.') ?>
                                    </td>
                                </tr>
                            </tbody>
                            <tfooter>
                                <td class="text-center" colspan="4"><strong>Total Belanja</strong></td>
                                <td><strong>Rp <?= number_format($rw_pr['jumlah'], 0, '', '.') ?></strong></td>
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
<!-- Modal edit preorder-->
<?php foreach ($riwayat_preorder as $rw_pr) : ?>
    <div class="modal fade" id="modal_edit_preorder<?php echo $rw_pr['id_preorder'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Preorder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/Transaksi/update_preorder/') . $rw_pr['id_preorder']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>
                                Jumlah Transaksi
                            </label>
                            <input type="date" class="form-control mr-3" value="" name="filter_tanggal" hidden>
                            <input disabled type="text" name="jumlah" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $rw_pr['jumlah'] ?>">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>
                                        Metode
                                    </label>
                                    <input type="text" name="metode" class="form-control" disabled value="<?= $rw_pr['metode'] ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>
                                        Pembayaran
                                    </label>
                                    <input type="text" name="pembayaran" class="form-control" disabled value="<?php echo ($rw_pr['metode'] == 'Online') ? 'Transfer' : 'Tunai' ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>
                                        Status
                                    </label>
                                    <select class="form-control selectric" name="status" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                                        <option <?php if ($rw_pr['status'] == 'Selesai') : echo "selected";
                                                endif; ?>>
                                            Selesai
                                        </option>
                                        <option <?php if ($rw_pr['status'] == 'Menunggu Pengiriman') : echo "selected";
                                                endif; ?>>
                                            Menunggu Pengiriman
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>
                                        Tanggal Pengiriman
                                    </label>
                                    <input type="date" name="tanggalDikirim" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $rw_pr['tanggal_dikirim'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around">
                            <button type="button" class="btn btn-danger mr-3" data-dismiss="modal">
                                <i class="fas fa-check mr-1"></i>
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Pop up hapus transaksi-->
<script type="text/javascript">
    function hapus_riwayat_preorder($idPreorder) {
        swal({
            title: "Hapus Transaksi Preorder",
            text: "Apakah anda yakin ingin menghapus transaksi preorder ini ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "<?php echo base_url('admin/transaksi/hapus_preorder/') ?>" + $idPreorder;
            } else {
                swal("Data preorder batal dihapus");
            }
        });
    }
</script>