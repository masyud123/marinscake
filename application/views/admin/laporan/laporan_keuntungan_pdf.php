<!DOCTYPE html>
<html><head>
	<title>Laporan Transaksi Langsung</title>
	<style>
        table {
            border-collapse: collapse;
        }
        table td {
            border: 1px solid black;
            background-color: #0000ff66;
        } 
        table tr {
            border: 0px solid black;
            background-color: #0000ff66;
        }

        table th {
            border: 1px solid black;
            background-color: #0000ff66;
        }
        .rowspan {
            border-left-width: 10px;
        }
    </style>
    <div style="padding:0 50px">
        <div align="center" style="margin-left: 80px; position: static;">
            <h2>TOKO MARINS CAKE
                <br>KEDIRI JAWA TIMUR
            </h2>
            <div style="margin-top: -15px; margin-bottom: 7px;">Jalan Dandang Gendis No. 335B  
                <br>Kelurahan Doko Kecamatan Ngasem Kediri
            </div>
        </div>
        
        <img src="assets/client/images/logo-light.png" style="width: 16%; height: auto; position: absolute; margin-top: 35px; margin-left: 60px;">
        <hr style="border: 1.5px solid black;margin-top:-10px;position:static">
    </div>
</head><body>
    <div style="padding:0 50px">
        <div align="center">
            LAPORAN KEUNTUNGAN
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
        <div class="container-fluid" align="center" style="margin-top: 20px;">
            <table>
                <tr>
                    <th width="30" height="20">No</th>
                    <th colspan="3" width="310" >Nama dan Jumlah</th>
                    <th width="105">Total</th>
                </tr>
                <tr>
                    <th height="20">1</th>
                    <th colspan="3" align="left"  style="padding-left:10px">Pendapatan</th>
                    <th rowspan="3"></th>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="2" width="" height="20">Transaksi Langsung</td>
                    <td style="padding-left:10px">
                        <?php foreach($data_transaksi as $dt_trans);?>
                            Rp. <?= number_format($dt_trans['langsung'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center" colspan="2" height="20">Transaksi Preorder</td>
                    <td style="padding-left:10px">
                        <?php foreach($data_preorder as $dt_pre);?>
                            Rp. <?= number_format($dt_pre['preorder'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <th height="20"></th>
                    <th colspan="3">Total Pendapatan</th>
                    <th>Rp. <?= number_format($dt_pre['preorder']+$dt_trans['langsung'], 0, '', '.') ?></th>
                </tr>
                <tr>
                    <th height="20">2</th>
                    <th colspan="3" align="left" style="padding-left:10px">Pengeluaran</th>
                    <th rowspan="3"></th>
                </tr>   
                <tr>
                    <td height="20"></td>
                    <td align="center" colspan="2" >Pengeluaran Lain-lain</td>
                    <td style="padding-left:10px">
                        <?php foreach($data_modal as $dt_modal);?>
                            Rp. <?= number_format($dt_modal['keluar_modal'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td height="20"></td>
                    <td align="center" colspan="2">Pengeluaran Gaji</td>
                    <td style="padding-left:10px">
                        <?php foreach($data_gaji as $dt_gaji);?>
                            Rp. <?= number_format($dt_gaji['keluar_gaji'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <th height="20"></th>
                    <th colspan="3">Total Pengeluaran</th>
                    <th class="text-center">Rp. <?= number_format($dt_modal['keluar_modal']+$dt_gaji['keluar_gaji'], 0, '', '.') ?></th>
                </tr>
                <tr>
                    <th height="20">3</th>
                    <th colspan="3">Total Pendapatan Bersih</th>
                    <th class="text-center">Rp. <?= number_format($dt_pre['preorder']+$dt_trans['langsung']-$dt_modal['keluar_modal']-$dt_gaji['keluar_gaji'], 0, '', '.') ?></td>
                </tr>
            </table>
        </div>
        <br><br>
        <div align="right">
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