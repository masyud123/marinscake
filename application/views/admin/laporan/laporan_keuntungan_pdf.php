<!DOCTYPE html>
<html><head>
	<title>Laporan Transaksi Langsung</title>
	<style>
        table {
            border-collapse: collapse;
        }
        table td {
            border: 1px solid black;
            background-color: #ffffff;
        } 
        table tr {
            border: 0px solid black;
            background-color: #ffffff;
        }

        table th {
            border: 1px solid black;
            background-color: #ffffff;
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
        
        <?php
            $path = base_url('assets/client/images/logo-light.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <img src="<?=$base64?>" style="width: 15%; height: auto; position: absolute; margin-top: -110px; margin-left: 0px;">
        <hr style="border: 1.5px solid black;margin-top: 0px;position:static">
        
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
            <table style="width: 100%;">
                <tr>
                    <th width="30" height="20">No</th>
                    <th colspan="3" width="310" >Keterangan</th>
                </tr>
                <tr>
                    <th rowspan="5" width="30">1</th>
                    <th height="20" colspan="3" align="left"  style="padding-left:10px">Pendapatan</th>
                </tr>
                <tr>
                    <td align="center" colspan="2" width="" height="20">Transaksi Langsung</td>
                    <td style="padding-left:10px">
                        <?php foreach($data_transaksi as $dt_trans);?>
                            Rp. <?= number_format($dt_trans['langsung'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2" height="20">Transaksi Preorder</td>
                    <td style="padding-left:10px">
                        <?php foreach($data_preorder as $dt_pre);?>
                            Rp. <?= number_format($dt_pre['preorder'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2" height="20">Transaksi Booking</td>
                    <td style="padding-left:10px">
                        <?php foreach($data_booking as $dt_book);?>
                            Rp. <?= number_format($dt_book['preorder'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" height="20">Total Pendapatan</th>
                    <th>Rp. <?= number_format($dt_book['preorder']+$dt_pre['preorder']+$dt_trans['langsung'], 0, '', '.') ?></th>
                </tr>
                <tr>
                    <th rowspan="6">2</th>
                    <th  height="20" colspan="3" align="left" style="padding-left:10px">Pengeluaran</th>
                </tr>   
                <tr>
                    <td align="center" height="20" colspan="2" >Bahan Baku</td>
                    <td style="padding-left:10px">
                        Rp. <?= number_format($data_modal[0][0]['bahan_baku'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" height="20" colspan="2" >Akomodasi</td>
                    <td style="padding-left:10px">
                        Rp. <?= number_format($data_modal[1][0]['akomodasi'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" height="20" colspan="2" >Lain-lain</td>
                    <td style="padding-left:10px">
                        Rp. <?= number_format($data_modal[2][0]['lain_lain'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <td align="center" height="20" colspan="2">Gaji</td>
                    <td style="padding-left:10px">
                        <?php foreach($data_gaji as $dt_gaji);?>
                            Rp. <?= number_format($dt_gaji['keluar_gaji'], 0, '', '.') ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" height="20">Total Pengeluaran</th>
                    <th class="text-center">Rp. 
                        <?= number_format(
                            $data_modal[0][0]['bahan_baku']+
                            $data_modal[1][0]['akomodasi']+
                            $data_modal[2][0]['lain_lain']+
                            $dt_gaji['keluar_gaji'], 
                        0, '', '.') ?>
                    </th>
                </tr>
                <tr>
                    <th height="20">3</th>
                    <th colspan="2">Total Pendapatan Bersih</th>
                    <th class="text-center">Rp. 
                        <?= number_format(
                            (
                                $dt_book['preorder']+$dt_pre['preorder']+$dt_trans['langsung']
                            )-(
                                $data_modal[0][0]['bahan_baku']+
                                $data_modal[1][0]['akomodasi']+
                                $data_modal[2][0]['lain_lain']+
                                $dt_gaji['keluar_gaji']
                            ), 
                        0, '', '.') ?>
                    </th>
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