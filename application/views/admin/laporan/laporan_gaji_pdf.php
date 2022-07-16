<!DOCTYPE html>
<html><head>
	<title>Laporan Gaji Karyawan</title>
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
        <div align="center" >
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
        
        <div align="center">
            LAPORAN GAJI KARYAWAN
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
        <div class="container-fluid" align="center" style="margin-top: 20px;">
            <table>
                <tr>
                    <th align="center" colspan="3" width="40" style="padding: 7px 0;">NO</th>
                    <th align="center" colspan="5" width="200">Nama Karyawan</th>
                    <th align="center" colspan="5" width="100">Gaji</th>
                    <th align="center" colspan="5" width="100">Status</th>
                </tr>

                <?php
                $no = 1;
                foreach ($data_karyawan as $data_kr): 
                if($data_kr['status'] == 1): ?>
                <tr>
                     <td colspan="3" align="center" height="15" style="padding: 5px 0;">
                        <?= $no++ ?>
                    </td>
                    <td colspan="5" align="left" style="margin-left: 5px; padding-left:10px">
                        <?= $data_kr['nama'] ?>
                    </td>
                    <td colspan="5" align="center">
                        <?php 
                            if ($gaji_karyawan == null):?>
                                Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                            <?php else:
                                foreach ($gaji_karyawan as $gaji_kr):
                                    $gj_kr[] = $gaji_kr['id_karyawan'].$gaji_kr['bulan'];
                                endforeach;

                                if (in_array($data_kr['id_karyawan'].$bulan_tahun, $gj_kr)):

                                    foreach ($gaji_karyawan as $gaji_kr):
                                        if ($gaji_kr['id_karyawan'] == $data_kr['id_karyawan'] && $gaji_kr['bulan'] == $bulan_tahun): ?>
                                            <?= 'Rp'.number_format($gaji_kr['uang_gaji'], 0, '', '.'); ?>
                                        <?php endif;
                                    endforeach; ?>
                                    
                                <?php else:?>
                                Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td colspan="5" align="center">
                        <?php 
                            if ($gaji_karyawan == null) {
                                echo "Belum terbayar";
                            }else{
                                foreach ($gaji_karyawan as $gaji_kr):
                                    $gj_kr[] = $gaji_kr['id_karyawan'].$gaji_kr['bulan'];
                                endforeach;

                                if (in_array($data_kr['id_karyawan'].$bulan_tahun, $gj_kr))
                                    {echo "Terbayar";}
                                else{echo "Belum terbayar";}
                            }
                        ?>
                    </td>
                </tr>
                <?php else: ?>
                    <?php 
                        if ($gaji_karyawan == null):?>
                        <?php else:
                            foreach ($gaji_karyawan as $gaji_kr):
                                $gj_kr[] = $gaji_kr['id_karyawan'].$gaji_kr['bulan'];
                            endforeach;

                            if (in_array($data_kr['id_karyawan'].$bulan_tahun, $gj_kr)):?>
                                <tr>
                                    <td colspan="3" align="center" height="15" style="padding: 5px 0;">
                                        <?= $no++ ?>
                                    </td>
                                    <td colspan="5" align="left" style="margin-left: 5px; padding-left:10px">
                                        <?= $data_kr['nama'] ?>
                                    </td>
                                    <td colspan="5" align="center">
                                        <?php 
                                            if ($gaji_karyawan == null):?>
                                                Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                                            <?php else:
                                                foreach ($gaji_karyawan as $gaji_kr):
                                                    $gj_kr[] = $gaji_kr['id_karyawan'].$gaji_kr['bulan'];
                                                endforeach;

                                                if (in_array($data_kr['id_karyawan'].$bulan_tahun, $gj_kr)):

                                                    foreach ($gaji_karyawan as $gaji_kr):
                                                        if ($gaji_kr['id_karyawan'] == $data_kr['id_karyawan'] && $gaji_kr['bulan'] == $bulan_tahun): ?>
                                                            <?= 'Rp'.number_format($gaji_kr['uang_gaji'], 0, '', '.'); ?>
                                                        <?php endif;
                                                    endforeach; ?>
                                                    
                                                <?php else:?>
                                                Rp <?php echo number_format($data_kr['gaji'], 0, '', '.') ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td colspan="5" align="center">
                                        <?php 
                                            if ($gaji_karyawan == null) {
                                                echo "Belum terbayar";
                                            }else{
                                                foreach ($gaji_karyawan as $gaji_kr):
                                                    $gj_kr[] = $gaji_kr['id_karyawan'].$gaji_kr['bulan'];
                                                endforeach;

                                                if (in_array($data_kr['id_karyawan'].$bulan_tahun, $gj_kr))
                                                    {echo "Terbayar";}
                                                else{echo "Belum terbayar";}
                                            }
                                        ?>
                                    </td>
                                </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; endforeach; ?>
            </table>
        </div>
        <br>
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