<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Tambah Produk
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Nama Transaksi</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-quote-left"></i>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Budget</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    Rp
                                                </div>
                                            </div>
                                            <input type="text" class="form-control currency" name="jumlah">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Jenis Transaksi</label>
                                        <select class="form-control selectric" name="jenis">
                                            <option>Pengeluaran</option>
                                            <option>Pemasukan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Tipe Transaksi</label>
                                        <select class="form-control selectric" name="tipe">
                                            <option value="Pengeluaran">Pengeluaran</option>
                                            <option value="Pemasukan">Pemasukan</option>
                                        </select>
                                    </div>



                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Simpan</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>