<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4">
                <div class="card p-3 py-4">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="m-0 text-dark">Total Produk Dijual</h5>
                            <h5 class="mb-0 mt-3 text-dark"><?= count($produk);?></h5>
                        </div>
                        <div class="col-5 text-center d-flex align-content-center flex-wrap">
                            <img src="<?= base_url('assets/img/cake.gif')?>" width="90" height="auto" style="margin-top: -10px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-3 py-4 ">
                    <div class="row">
                        <div class="col-7">
                            <h5 class="m-0 text-dark">Total Transaksi Langsung</h5>
                            <h5 class="mb-0 mt-3 text-dark"><?= count($transaksi_langsung);?></h5>
                        </div>
                        <div class="col-5 text-center d-flex align-content-center flex-wrap">
                            <img src="<?= base_url('assets/img/tr_langsung.gif')?>" width="100" height="auto" style="margin-top: -10px;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card p-3 py-4"> 
                    <div class="row">
                        <div class="col-7">
                            <h5 class="m-0 text-dark">Total Transaksi Preorder</h5>
                            <h5 class="mb-0 mt-3 text-dark"><?= count($transaksi_preorder);?></h5>
                            </div>
                        <div class="col-5 text-center d-flex align-content-center flex-wrap">
                            <img src="<?= base_url('assets/img/tr_preorder.gif')?>" width="100" height="auto" style="margin-top: -10px;">
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <!-- chart -->
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card ">
                    <div class="card-header bg-light">
                        <h4>Grafik Pemasukan & Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <canvas id="linechart" width="100" height="40" class="mb-4"></canvas>
                            <div class="row mb-0">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="list-inline text-center">
                                        <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle" class="col-red"></i>
                                            <h5 class="mb-0 m-b-0">Rp. 
                                                <?php 
                                                if($pengeluaran_modal != null){
                                                    foreach($pengeluaran_modal as $p_ml){
                                                        $tt_modal[] = ($p_ml['total_modal']);
                                                    };
                                                    echo number_format(array_sum($tt_modal), 0, '', '.');
                                                } else{
                                                    echo "0";
                                                } ?>
                                            </h5>
                                            <p class="text-muted font-14 m-b-0">Total Pengeluaran</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="list-inline text-center">
                                        <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle" class="col-green"></i>
                                        <h5 class="m-b-0">Rp. 
                                            <?php 
                                            if($transaksi_preorder != null){
                                                    foreach($transaksi_preorder as $trp){
                                                        $tr_pr[] = ($trp['jumlah']);
                                                    };
                                                    echo number_format(array_sum($tr_pr), 0, '', '.');
                                            } else{
                                                echo "0";
                                            } ?>
                                            </h5>
                                            <p class="text-muted font-14 m-b-0">Pemasukan Transaksi Preorder</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="list-inline text-center">
                                        <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle" class="col-blue"></i>
                                            <h5 class="m-b-0">Rp. 
                                            <?php 
                                            if($transaksi_langsung != null){
                                                foreach($transaksi_langsung as $trs){
                                                    $tr_ls[] = ($trs['total_belanja']);
                                                };
                                                echo number_format(array_sum($tr_ls), 0, '', '.');
                                            } else{
                                                echo "0";
                                            } ?>
                                            </h5>
                                            <p class="text-muted font-14 m-b-0">Pemasukan Transaksi Langsung</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="<?= base_url('assets/js/grafik.js')?>"></script>
<script  type="text/javascript">
    var ctx = document.getElementById("linechart").getContext("2d");
    var data = {
        labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
        datasets: [
            {
                label: "Transaksi Langsung",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#29B0D0",
                borderColor: "#29B0D0",
                pointHoverBackgroundColor: "#29B0D0",
                pointHoverBorderColor: "#29B0D0",
                data: [<?= 
                    '"' . $tr_langsung[0][0] . '","' . $tr_langsung[1][1] . '","' . $tr_langsung[2][2] . '",
                    "' . $tr_langsung[3][3] . '","' . $tr_langsung[4][4] . '","' . $tr_langsung[5][5] . '",
                    "' . $tr_langsung[6][6] . '","' . $tr_langsung[7][7] . '","' . $tr_langsung[8][8] . '",
                    "' . $tr_langsung[9][9] . '","' . $tr_langsung[10][10] . '","' . $tr_langsung[11][11] . '",';
                ?>]
            },
            {
                label: "Transaksi Preorder",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#00FF00",
                borderColor: "#00FF00",
                pointHoverBackgroundColor: "#00FF00",
                pointHoverBorderColor: "#00FF00",
                data: [<?= 
                    '"' . $tr_preorder[0][0] . '","' . $tr_preorder[1][1] . '","' . $tr_preorder[2][2] . '",
                    "' . $tr_preorder[3][3] . '","' . $tr_preorder[4][4] . '","' . $tr_preorder[5][5] . '",
                    "' . $tr_preorder[6][6] . '","' . $tr_preorder[7][7] . '","' . $tr_preorder[8][8] . '",
                    "' . $tr_preorder[9][9] . '","' . $tr_preorder[10][10] . '","' . $tr_preorder[11][11] . '",';
                ?>]
            },
            {
                label: "Pengeluaran Modal",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#FF0000",
                borderColor: "#FF0000",
                pointHoverBackgroundColor: "#FF0000",
                pointHoverBorderColor: "#FF0000",
                data: [<?= 
                    '"' . $pengeluaran[0][0] . '","' . $pengeluaran[1][1] . '","' . $pengeluaran[2][2] . '",
                    "' . $pengeluaran[3][3] . '","' . $pengeluaran[4][4] . '","' . $pengeluaran[5][5] . '",
                    "' . $pengeluaran[6][6] . '","' . $pengeluaran[7][7] . '","' . $pengeluaran[8][8] . '",
                    "' . $pengeluaran[9][9] . '","' . $pengeluaran[10][10] . '","' . $pengeluaran[11][11] . '",';
                ?>]
            },
        ],
    };

    var myBarChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            legend: {
            display: true
            },
            barValueSpacing: 20,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: "rgba(0, 0, 0, 0)",
                    }
                }]
            }
        }
    });
</script>