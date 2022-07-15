<!DOCTYPE html>
<html><?php foreach($data_modal as $dt_modal): ?><head>
	<title>Laporan Pengeluaran</title>
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
</head><body>
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
        <img src="<?=$base64?>" style="width: 16%; height: auto; position: absolute; margin-top: -120px; margin-left: 30px;">
        <hr style="border: 1.5px solid black;margin-top: 0px;position:static">
        
            <div align="left" style="margin-top: 15px;">
                <?=$jenis?>tanggal: 
                <?php 
                    $tahun  = strstr($dt_modal['tanggal'], '-', true);
                    $bln    = strstr(substr($dt_modal['tanggal'], strpos($dt_modal['tanggal'], "-") + 1), '-', true); 
                    $tgl    = substr($dt_modal['tanggal'], -2);
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
                <?= $tgl." ".$bulan." ".$tahun ?>
            </div>
            <br>
            <div class="container-fluid" align="center" style="margin-top: 20px;">
                <table>
                    <tr>
                        <th align="center" width="30" style="padding: 7px 0;">NO</th>
                        <th align="center" width="157">Nama Bahan</th>
                        <th align="center" width="45">Jumlah</th>
                        <th align="center" width="105">Harga Satuan</th>
                        <th align="center" width="105">Total Harga</th>
                    </tr>
                    <?php $no = 1;
                    foreach ($detail_modal as $dtl_modal):
                    if ($dt_modal['id_modal'] == $dtl_modal['id_modal']):?>
                        <tr>
                             <td align="center" height="15" style="padding: 5px 0;">
                                <?= $no++ ?>
                            </td>
                            <td align="left" style="margin-left: 5px; padding-left:10px">
                                 <?= $dtl_modal['nama_bahan'] ?>
                            </td>
                            <td align="center">
                                 <?= $dtl_modal['jumlah'] ?>
                            </td>
                            <td align="left" style="padding-left:35px">
                                Rp <?= number_format($dtl_modal['harga_satuan'], 0, '', '.') ?>
                            </td>
                            <td align="left" style="padding-left:35px">
                                Rp <?= number_format($dtl_modal['total_harga'], 0, '', '.') ?>
                            </td>
                        </tr>
                    <?php 
                    endif; endforeach; ?>
                    <tr>
                        <td colspan="4" align="center"style="padding: 7px 0;">
                            <strong>Total Pengeluaran</strong>
                        </td>
                        <td align="center" style="padding: 7px 0;">
                            <strong>Rp. <?php echo number_format($dt_modal['total_modal'], 0, '', '.') ?></strong>
                        </td>
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
</body><?php endforeach; ?></html>