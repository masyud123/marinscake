<?php echo $this->session->flashdata('kota'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>
                            Daftar Daerah Pengiriman
                        </h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah_kota"><i class="fas fa-plus"></i> Tambah Daerah Pengiriman</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">NO</th>
                                        <th>Nama Kota/Kab</th>
                                        <th>Ongkir</th>
                                        <th class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kota as $kot) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $no++; ?>
                                            </td>
                                            <td>
                                                <?php echo $kot['nama_kota'] ?>
                                            </td>
                                            <td>
                                                Rp <?php echo number_format($kot['ongkir'], '0', ',', '.') ?>
                                            </td>

                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_edit_kota<?php echo $kot['id_daerah'] ?>"><i class="fas fa-pen"></i> Edit</button>
                                                <button type="button" onclick="hapus_kota(<?=$kot['id_daerah']?>)" class="btn btn-sm btn-danger ml-5" data-toggle="modal" data-target="#modal_hapus_kota<?php echo $kot['id_daerah'] ?>"><i class="fas fa-trash"></i> Hapus</button>
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

<!-- Modal Tambah kota-->
<div class="modal fade" id="modal_tambah_kota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-center bg-light">
                <h4 class="modal-title" id="exampleModalLabel"><strong>Tambah Daerah Pengiriman</strong></h4>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/Pengiriman/tambah_kota'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>
                            <h6>Nama Kota</h6>
                        </label>
                        <input type="text" name="nama_kota" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label>
                            <h6>Ongkir</h6>
                        </label>
                        <input type="text" name="ongkir" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="row justify-content-around">
                        <button type="button" class="btn btn-danger col-2" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary col-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit kota-->
<?php foreach ($kota as $kot) : ?>
    <div class="modal fade" id="modal_edit_kota<?php echo $kot['id_daerah'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header text-center bg-light">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Edit Daerah Pengiriman</strong></h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/Pengiriman/update_kota/') . $kot['id_daerah']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>
                                <h6>Nama Kota</h6>
                            </label>
                            <input type="text" name="nama_kota" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $kot['nama_kota'] ?>">
                        </div>
                        <div class="form-group">
                            <label>
                                <h6>Ongkir</h6>
                            </label>
                            <input type="number" name="ongkir" class="form-control" oninvalid="this.setCustomValidity('Form input tidak boleh kosong!')" oninput="setCustomValidity('')" required value="<?= $kot['ongkir'] ?>">
                        </div>
                        <div class="row justify-content-around">
                            <button type="button" class="btn btn-danger col-2" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary col-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal Hapus kota-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    function hapus_kota(param){
        swal({
            title: "Hapus Daerah",
            text: "Apakah anda yakin ingin menghapus daerah ini ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "<?php echo base_url('admin/Pengiriman/hapus_kota/') ?>" + param;
            } else {
                swal("Derah batal dihapus");
            }
        });
    }
</script>
<!--<?php foreach ($kota as $kot) : ?>-->
<!--    <div class="modal fade" id="modal_hapus_kota<?php echo $kot['id_daerah'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
<!--        <div class="modal-dialog modal-dialog-centered">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header text-center bg-light">-->
<!--                    <h4 class="modal-title" id="exampleModalLabel"><strong>Hapus Daerah Pengiriman</strong></h4>-->
<!--                </div>-->
<!--                <div class="modal-body">-->
<!--                    <form action="<?= base_url('admin/Pengiriman/hapus_kota/') . $kot['id_daerah']; ?>" method="post" enctype="multipart/form-data">-->
<!--                        <div class="form-group">-->
<!--                            <h6>Apakah anda yakin ingin menghapus pengiriman ke <?php echo $kot['nama_kota'] ?> ?</h6>-->
<!--                        </div>-->
<!--                        <div class="row justify-content-around">-->
<!--                            <button type="button" class="btn btn-danger col-2" data-dismiss="modal">Tidak</button>-->
<!--                            <button type="submit" class="btn btn-primary col-2">Iya</button>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--<?php endforeach; ?>-->