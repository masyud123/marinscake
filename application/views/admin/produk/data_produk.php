<?php echo $this->session->flashdata('produk'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>
                            Daftar Produk
                        </h4>
                        <a class="btn btn-primary d-flex" href="<?php echo base_url("admin/produk/tambah_produk") ?>">
                            <div class="fas fa-plus my-auto mr-2"></div>
                            Tambah Produk
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            No
                                        </th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($produk as $data_produk) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $no++ ?>
                                            </td>
                                            <td>
                                                <?php echo $data_produk['nama_produk'] ?>
                                            </td>
                                            <td>
                                                <?php echo $data_produk['nama_jenis'] ?>
                                            </td>
                                            <td>
                                                Rp <?php echo number_format($data_produk['harga'], 0, '', '.') ?>
                                            </td>
                                            <td>
                                                <?php echo ($data_produk['status_produk'] == 1) ? "Aktif" : "Tidak Aktif" ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $data_produk['stok'] ?>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around">
                                                    <button class="btn btn-info" onclick="$('#detail_produk<?= $data_produk['id_produk'] ?>').appendTo('body').modal('show');">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                    <button class="btn btn-warning" onclick="window.location.href='<?php echo base_url('admin/produk/edit_produk/' . $data_produk['id_produk']) ?>'">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
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

<!-- modal detail produk -->
<?php foreach ($produk as $data_produk) : ?>
    <div class="modal fade bd-example-modal-xl" id="detail_produk<?= $data_produk['id_produk'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title">Detail Produk <?php echo $data_produk['nama_produk'] ?></h5>
                    <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal" style="margin-top: -9px;"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body pb-2 pt-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card" style="overflow-y: hidden;">
                                <div class="card-body " style="height: 70vh; overflow-y: scroll;">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Produk</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-quote-left"></i>
                                                        </div>
                                                    </div>
                                                    <input readonly disabled type="text" class="form-control" name="nama_produk" value="<?php echo $data_produk['nama_produk'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            Rp
                                                        </div>
                                                    </div>
                                                    <input readonly disabled type="text" class="form-control" name="harga" value="<?php echo $data_produk['harga'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Kategori</label>
                                                <?php foreach ($kategori as $ktg) :
                                                    if ($data_produk['id_jenis'] == $ktg['id_jenis']) : ?>
                                                        <input readonly disabled type="text" class="form-control" value="<?= $ktg['nama_jenis'] ?>">
                                                <?php endif;
                                                endforeach; ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input readonly disabled type="text" class="form-control" value="<?= ($data_produk['status_produk'] == 1) ? 'Aktif' : 'Tidak Aktif' ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Stok</label>
                                                <input readonly disabled type="number" class="form-control" name="stok" value="<?php echo $data_produk['stok'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Minimal Order</label>
                                                <input readonly disabled type="text" class="form-control" value="<?= $data_produk['min_order'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group ">
                                                <label>Deskripsi Produk</label>
                                                <textarea style="resize: none;" cols="56" rows="5" class="form-control" disabled readonly><?= $data_produk['deskripsi'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" >
                            <div class="card" style="height: 70vh; overflow-y: hidden;">
                                <div class="card-body" style="overflow-y: scroll;">
                                    <div class="form-group">
                                        <div class="row justify-content-around">
                                            <?php foreach ($gambar as $gb_produk) :
                                                if ($gb_produk['id_produk'] == $data_produk['id_produk']) : ?>
                                                    <img src="<?php echo base_url() . '/uploads/gambar_produk/' . $gb_produk["gambar"]; ?>" alt="" style="width: 40%; height: auto;" class="img-thumbnail shadow p-3 bg-white rounded mb-5" alt="Responsive image">
                                            <?php endif;
                                            endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<script type="text/javascript">
    function hapus_produk($id_produk) {
        swal({
            title: "Hapus produk",
            text: "Apakah anda yakin ingin menghapus produk ini ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "<?php echo base_url('admin/produk/hapus_produk/') ?>" + $id_produk;
            } else {
                swal("Produk gagal dihapus");
            }
        });
    }
</script>