<?php echo $this->session->flashdata('slider'); ?>
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>
                            Daftar Slider
                        </h4>
                        <a class="btn btn-primary" href="<?php echo base_url("admin/Slider/tambah_slider") ?>">
                            <div class="fas fa-plus my-auto mr-2"></div>
                            Tambah Slider
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
                                        <th>Slider</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($slider as $slide) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $no++ ?>
                                            </td>
                                            <td class="w-25 text-center">
                                                <div>
                                                    <img src="<?php echo base_url() . '/uploads/slider/' . $slide["gambar"]; ?>" alt="" style="border-radius:5px;max-height: 120px;" class="img-fluid my-2">
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($slide['status'] == 0) : ?>
                                                    <span class="badge bg-warning text-light">Disembunyikan</span>
                                                <?php else : ?>
                                                    <span class="badge bg-success text-light">Ditampilkan</span>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-success mr-2" onclick="window.location.href='<?php echo base_url('admin/slider/edit_slider/' . $slide['id_slider']) ?>'">
                                                        Edit
                                                    </button>
                                                    <button class="btn btn-danger" onclick="hapus_slider(<?= $slide['id_slider']; ?>)">Hapus</button>
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

<script type="text/javascript">
    function hapus_slider($id_slider) {
        swal({
            title: "Hapus Slider",
            text: "Apakah anda yakin ingin menghapus slider ini ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                window.location = "<?php echo base_url('admin/Slider/hapus_slider/') ?>" + $id_slider;
            } else {
                swal("Slider gagal dihapus");
            }
        });
    }
</script>