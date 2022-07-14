<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-md-4">
                <div class="row justify-content-around">
                    <div class="col-12 col-sm-5 col-md-12">
                        <div class="card">
                            <div class="card-header" style="background-color: #f0f3ff;">
                                <h4>Transaksi Langsung <i class="fas fa-info-circle fa-1x" style="color: #6778f0;"></i></h4>
                            </div>
                            <div class="card-body">
                                <h7>Total Pendapatan:</h7>
                                <h4><strong>Rp.
                                        <?php $tt_tr_langsung = 0;
                                        foreach ($tr_langsung as $langsung) :
                                            $tt_tr_langsung += $langsung['total_belanja'];
                                        endforeach;
                                        echo number_format($tt_tr_langsung, 0, '', '.');
                                        ?>
                                    </strong></h4>
                                <h7>Total Transaksi:</h7>
                                <h4><strong><?= count($tr_langsung) ?></strong></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 col-md-12 ">
                        <div class="card">
                            <div class="card-header" style="background-color: #f0f3ff;">
                                <h4>Transaksi Preorder <i class="fas fa-info-circle fa-1x" style="color: #6778f0;"></i></h4>
                            </div>
                            <div class="card-body">
                                <h7>Total Pendapatan:</h7>
                                <h4><strong>Rp.
                                        <?php $tt_tr_preorder = 0;
                                        foreach ($tr_preorder as $preorder) :
                                            $tt_tr_preorder += $preorder['jumlah'];
                                        endforeach;
                                        echo number_format($tt_tr_preorder, 0, '', '.');
                                        ?>
                                    </strong></h4>
                                <h7>Total Transaksi:</h7>
                                <h4><strong><?= count($tr_preorder) ?></strong></h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header justify-content-between" style="background-color: #f0f3ff;">
                        <h4>Grafik Penjualan</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="linechart" width="100" height="50" class="mb-4"></canvas>
                        <div>
                        </div>
                    </div>
                </div>
    </section>
</div>

<script src="<?= base_url('assets/js/grafik.js') ?>"></script>
<script type="text/javascript">
    var ctx = document.getElementById("linechart").getContext("2d");
    var data = {
        labels: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
        datasets: [{
                label: "Transaksi Langsung",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#29B0D0",
                borderColor: "#29B0D0",
                pointHoverBackgroundColor: "#29B0D0",
                pointHoverBorderColor: "#29B0D0",
                data: [<?=
                        '"' . $grafik_ls[0][0] . '","' . $grafik_ls[1][1] . '","' . $grafik_ls[2][2] . '",
                    "' . $grafik_ls[3][3] . '","' . $grafik_ls[4][4] . '","' . $grafik_ls[5][5] . '",
                    "' . $grafik_ls[6][6] . '",';
                        ?>]
            },
            {
                label: "Transaksi Preorder",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "#FFD700",
                borderColor: "#FFD700",
                pointHoverBackgroundColor: "#FFD700",
                pointHoverBorderColor: "#FFD700",
                data: [<?=
                        '"' . $grafik_pr[0][0] . '","' . $grafik_pr[1][1] . '","' . $grafik_pr[2][2] . '",
                    "' . $grafik_pr[3][3] . '","' . $grafik_pr[4][4] . '","' . $grafik_pr[5][5] . '",
                    "' . $grafik_pr[6][6] . '",';
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