<html><head>
	<title>Laporan Transaksi Langsung</title>
	<style>
        table {
            border-collapse: collapse;
        }
        table td {
            border: 1px solid;
            background-color: #ffffff;
        } 
        table tr {
            border: 1px solid;
            background-color: #ffffff;
        }

        table th {
            border: 1px solid;
            background-color: #ffffff;
        }
        .rowspan {
            border-left-width: 10px;
        }

        .wrapper-page {
            page-break-after: always;
        }
        .wrapper-page:last-child {
            page-break-after: avoid;
        }
    </style>
</head>
<?php $n=1 ?>
<body>
    <div class="wrapper-page" style="padding:0 50px;">
        <div align="center">
            <h2>TOKO MARINS CAKE
                <br>KEDIRI JAWA TIMUR
            </h2>
            <div style="margin-top: -15px; margin-bottom: 7px;">Jalan Dandang Gendis No. 335B  
                <br>Kelurahan Doko Kecamatan Ngasem Kediri
            </div>
        </div>
        
        <?php
            $path = base_url('assets/client/images/logo-light.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <img src="<?=$base64?>" style="width: 10%; height: auto; position: absolute; margin-top: -110px; margin-left: 0px;">
        <hr style="border: 1.5px solid black;margin-top: 0px;position:static">
        
        <div align="center">
            LAPORAN TRANSAKSI LANGSUNG
            <?php 
                date_default_timezone_set('Asia/Jakarta');
                $tahun  = strstr($bulan_tahun, '-', true);
                $bln    = substr($bulan_tahun, strpos($bulan_tahun, "-") + 1); 
                if     ($bln == '01') {$bulan = 'Januari';}
                elseif ($bln == '02') {$bulan = 'Februari';}
                elseif ($bln == '03') {$bulan = 'Maret';}
                elseif ($bln == '04') {$bulan = 'April';}
                elseif ($bln == '05') {$bulan = 'Mei';}
                elseif ($bln == '06') {$bulan = 'Juni';}
                elseif ($bln == '07') {$bulan = 'Juli';}
                elseif ($bln == '08') {$bulan = 'Agustus';}
                elseif ($bln == '09') {$bulan = 'September';}
                elseif ($bln == '10') {$bulan = 'Oktober';}
                elseif ($bln == '11') {$bulan = 'November';}
                elseif ($bln == '12') {$bulan = 'Desember';}
            ?>
            <br>Bulan <?= $bulan ?> Tahun <?= $tahun ?>
        </div>
        <div align="center" style="margin-top: 20px;">
            <table width="100%">
                <tr>
                    <td align="center" width="25" style="padding: 7px 0;"><b>No</b></td>
                    <td align="center" width="105"><b>Tanggal Transaksi</b></td>
                    <td align="center" width="157"><b>Nama Produk</b></td>
                    <td align="center" width="45"><b>Jumlah</b></td>
                    <td align="center" width="105"><b>Harga Satuan</b></td>
                    <td align="center" width="105"><b>Sub Total</b></td>
                </tr>
                <?php $sum=0; $no=1;
                    for($i = 0; $i < count($data_transaksi1); $i++):
                        foreach($data_transaksi1[$i]['detail'] as $key => $val):
                            if($key == 0): ?>
                                <tr>
                                    <td style="padding: 7px;" align="center" rowspan="<?=count($data_transaksi1[$i]['detail'])?>"><?=$no++?></td>
                                    <td style="padding: 7px;" align="center" rowspan="<?=count($data_transaksi1[$i]['detail'])?>"><?=$data_transaksi1[$i]['tanggal']?></td>
                                    <td style="padding: 7px;"><?=$val['nama_produk']?></td>
                                    <td align="center"><?=$val['jumlah']?></td>
                                    <td align="center">Rp. <?= number_format($val['harga'], 0, '', '.') ?></td>
                                    <td align="center">Rp. <?= number_format($val['total'], 0, '', '.') ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td style="padding: 7px;"><?=$val['nama_produk']?></td>
                                    <td align="center"><?=$val['jumlah']?></td>
                                    <td align="center">Rp. <?= number_format($val['harga'], 0, '', '.') ?></td>
                                    <td align="center">Rp. <?= number_format($val['total'], 0, '', '.') ?></td>
                                </tr>
                            <?php endif; 
                        endforeach; 
                        $sum += $data_transaksi1[$i]['total_belanja'];
                    endfor;
                    for($i = 0; $i < count($data_transaksi2); $i++):
                        foreach($data_transaksi2[$i]['detail'] as $key => $val):
                            if($key == 0): ?>
                                <tr>
                                    <td style="padding: 7px;" align="center" rowspan="<?=count($data_transaksi2[$i]['detail'])?>"><?=$no++?></td>
                                    <td style="padding: 7px;" align="center" rowspan="<?=count($data_transaksi2[$i]['detail'])?>"><?=$data_transaksi2[$i]['tanggal']?></td>
                                    <td style="padding: 7px;"><?=$val['nama_produk']?></td>
                                    <td align="center"><?=$val['jumlah']?></td>
                                    <td align="center">Rp. <?= number_format($val['harga'], 0, '', '.') ?></td>
                                    <td align="center">Rp. <?= number_format($val['total'], 0, '', '.') ?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td style="padding: 7px;"><?=$val['nama_produk']?></td>
                                    <td align="center"><?=$val['jumlah']?></td>
                                    <td align="center">Rp. <?= number_format($val['harga'], 0, '', '.') ?></td>
                                    <td align="center">Rp. <?= number_format($val['total'], 0, '', '.') ?></td>
                                </tr>
                            <?php endif; 
                        endforeach; 
                        $sum += $data_transaksi2[$i]['total_belanja'];
                    endfor;
                ?>
                <tr>
                    <td colspan="5" align="center"><b>Total Belanja</b></td>
                    <td style="padding: 7px;" align="center">Rp. <?= number_format($sum, 0, '', '.') ?></td>
                </tr>
            </table>
        </div>
        <br>
        <div align="right" >
            <?php $bln2 = date('m'); 
                if     ($bln2 == '01') {$bulan2 = 'Januari';}
                elseif ($bln2 == '02') {$bulan2 = 'Februari';}
                elseif ($bln2 == '03') {$bulan2 = 'Maret';}
                elseif ($bln2 == '04') {$bulan2 = 'April';}
                elseif ($bln2 == '05') {$bulan2 = 'Mei';}
                elseif ($bln2 == '06') {$bulan2 = 'Juni';}
                elseif ($bln2 == '07') {$bulan2 = 'Juli';}
                elseif ($bln2 == '08') {$bulan2 = 'Agustus';}
                elseif ($bln2 == '09') {$bulan2 = 'September';}
                elseif ($bln2 == '10') {$bulan2 = 'Oktober';}
                elseif ($bln2 == '11') {$bulan2 = 'November';}
                elseif ($bln2 == '12') {$bulan2 = 'Desember';}
            ?>
            Kediri, <?= date('d').' '.$bulan2.' '.date('Y') ?>
            <br>Pimpinan Toko Marins Cake
            <br><br><br><br>
            <h4>Ego Duta</h4>    
        </div>
    </div>
</body></html>