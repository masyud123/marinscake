<?php echo $this->session->flashdata('transaksi'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Daftar Transaksi Langsung
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="form-group d-flex align-items-center mr-3 mb-0">
                                <h6 class="w-100 mr-3 my-0" style="color:black">Pilih Tanggal : </h6>
                                <div class="input-group">
                                    <input type="month" class="form-control mr-3" value="<?= $tanggal; ?>" id="filter_tanggal">
                                </div>
                                <button class="btn btn-primary d-flex h-100 " type="button" onclick="filter()"><i class="fas fa-filter my-auto mr-2"></i>Filter</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No
                                        </th>
                                        <th>Jumlah Transaksi</th>
                                        <th>Metode</th>
                                        <th>Pembayaran</th>
                                        <th>Waktu Transaksi</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($riwayat_transaksi as $rw_tr) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?= $no++ ?>
                                            </td>
                                            <td>
                                                Rp <?= number_format($rw_tr['total_belanja'], 0, '', '.') ?>
                                            </td>
                                            <td>
                                                <?= $rw_tr['metode'] ?>
                                            </td>
                                            <td>
                                                <?= $rw_tr['pembayaran'] ?>
                                            </td>
                                            <td>
                                                <?= $rw_tr['tanggal'] ?>
                                            </td>
                                            <td>
                                                <?= $rw_tr['status'] ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal_detail_transaksi<?= $rw_tr['id_transaksi'] ?>">
                                                        <i class="fas fa-search"></i> Detail</button>
                                                    <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#modal_edit_transaksi<?php echo $rw_tr['id_transaksi'] ?>">
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
<?php foreach ($riwayat_transaksi as $rw_tr) : ?>
    <div class="modal fade bd-example-modal-lg" id="modal_detail_transaksi<?= $rw_tr['id_transaksi'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detail Transaksi</h5>
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
                                foreach ($detail_transaksi as $dt_tr) :
                                    if ($rw_tr['id_transaksi'] == $dt_tr['id_transaksi']) : ?>
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
                            </tbody>
                            <tfooter>
                                <td class="text-center" colspan="4"><strong>Total Belanja</strong></td>
                                <td><strong>Rp <?= number_format($rw_tr['total_belanja'], 0, '', '.') ?></strong></td>
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

<!-- Modal edit transaksi-->
<?php foreach ($riwayat_transaksi as $rw_tr) : ?>
    <div class="modal fade" id="modal_edit_transaksi<?php echo $rw_tr['id_transaksi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/Transaksi/update_transaksi/') . $rw_tr['id_transaksi']; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>
                                        Jumlah Transaksi
                                    </label>
                                    <input type="date" class="form-control mr-3" value="<?= $tanggal; ?>" name="filter_tanggal" hidden>
                                    
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                Rp
                                            </div>
                                        </div>
                                        <input readonly value="<?= $rw_tr['total_belanja'] ?>" class="form-control" type="number" name="total_belanja">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>
                                        Pembayaran
                                    </label>
                                    <input type="text" name="pembayaran" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $rw_tr['pembayaran'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>
                                        Metode
                                    </label>
                                    <select class="form-control selectric" name="metode" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                                        <option <?php if ($rw_tr['metode'] == 'Online') : echo "selected";
                                                endif; ?>>
                                            Online
                                        </option>
                                        <option <?php if ($rw_tr['metode'] == 'Offline') : echo "selected";
                                                endif; ?>>
                                            Offline
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>
                                        Status
                                    </label>
                                    <select class="form-control selectric" name="status" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                                        <option <?php if ($rw_tr['status'] == 'Selesai') : echo "selected";
                                                endif; ?>>
                                            Selesai
                                        </option>
                                        <option <?php if ($rw_tr['status'] == 'Menunggu pengiriman') : echo "selected";
                                                endif; ?>>
                                            Menunggu pengiriman
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
    function hapus_riwayat_transaksi($idTransaksi) {
        swal({
            title: "Hapus Riwayat Transaksi",
            text: "Apakah anda yakin ingin menghapus riwayat transaksi ini ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "<?php echo base_url('admin/Transaksi/hapus_transaksi/') ?>" + $idTransaksi;
            } else {
                swal("Data transaksi batal dihapus");
            }
        });
    }

    function filter() {
        var tanggal = document.getElementById('filter_tanggal').value;
        window.location = "<?php echo base_url('admin/transaksi/langsung/') ?>" + tanggal;
    }
</script>