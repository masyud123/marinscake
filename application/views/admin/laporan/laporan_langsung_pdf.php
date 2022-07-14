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

        .wrapper-page {
            page-break-after: always;
        }
        .wrapper-page:last-child {
            page-break-after: avoid;
        }
    </style>
</head><body>
    <?php for($i = 0; $i < count($data_transaksi); $i++):?>
    <div class="wrapper-page" style="padding:0 50px;">
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
        <br>
        <div align="center" style="margin-top: 20px;">
            <table width="100%">
                <tr>
                    <th align="center" style="padding: 7px 0;">NO</th>
                    <th align="center" width="150px">Tanggal Transaksi</th>
                    <th align="center" width="110px">Total Belanja</th>
                    <th align="center" >Metode</th>
                    <th align="center" width="100px">Pembayaran</th>
                    <th align="center" >Status</th>
                </tr>

                <?php
                $no = 1;
                foreach ($data_transaksi[$i] as $dt_trans): ?>
                <tr>
                     <td align="center" height="22" style="padding: 5px 0;">
                        <?= $no++ ?>
                    </td>
                    <td align="left" style="margin-left: 5px; padding-left:10px"><?= $dt_trans['tanggal']?>
                    </td>
                    <td align="center">
                        Rp <?php echo number_format($dt_trans['total_belanja'], 0, '', '.') ?>
                    </td>
                    <td align="center">
                        <?= $dt_trans['metode']?>
                    </td>
                    <td align="center">
                        <?= $dt_trans['pembayaran']?>
                    </td>
                    <td align="center">
                        <?= $dt_trans['status']?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <br>
        <?php if((count($data_transaksi) - 1) == $i){
                $tampil = "";
            }else{
                $tampil = "style='display: none;'";
            }
        ?>
        <div align="right" <?= $tampil?>>
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
    <?php endfor; ?>
</body></html>