<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo"<table border='0' cellpadding='10px' style='border-collapse:collapse;width:500px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
echo"<tr>
<td align=center><i>Data Yang Sudah Disetujui Akan Muncul Pada Tagihan Member. Ketika Member Login, Maka Member Dapat Melakukan Konfirmasi Pembayaran Iyuran. Proses Ini dapat dilakukan oleh Admin, Kontrol Transaksi, dan Member Yang Bersakutan (dengan login)</i></td>
</tr>";
echo"</table>";
echo '
		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID TRANSAKSI</th>
                        <th>ID MEMBER</th>
						  <th>Kode Tarif (Paket)/th>
						<th>Nama Member</th>
						<th>Jumlah Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th>Tanggal Berlaku</th>
						<th>Keterangan</th>
						<th>Persetujuan</th>
                    </tr>
                </thead>
                <tbody>';
                                      
					          $sql = mysqli_query($conn,"SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) ORDER BY id_transaksi DESC");
					          $no = 1;
                    while ($r = mysqli_fetch_array($sql)) {
                      echo "<tr>
                            <td width=40>$no</td>
                            <td>$r[id_transaksi]</td>
                            <td>$r[id_member]</td>
							 <td>$r[kode_tarif]</td>
							<td>$r[nama]</td>
                            <td>Rp".number_format($r['jumlah_deposit'],2,',','.')."</td>";
							$pecah3 = explode("-", $r['tanggal_transaksi']);
$date3 = $pecah3[2];
$month3 = $pecah3[1];
$year3 = $pecah3[0];
if ($month3=="01"){
$bulan2 = "Januari";
}elseif($month3=="02"){
$bulan2 = "Februari";
}elseif($month3=="03"){
$bulan2 = "Maret";
}elseif($month3=="04"){
$bulan2 = "April";
}elseif($month3=="05"){
$bulan2 = "Mei";
}elseif($month3=="06"){
$bulan2 = "Juni";
}elseif($month3=="07"){
$bulan2 = "Juli";
}elseif($month3=="08"){
$bulan2 = "Agustus";
}elseif($month3=="09"){
$bulan2 = "September";
}elseif($month3=="10"){
$bulan2 = "Oktober";
}elseif($month3=="11"){
$bulan2 = "November";
}elseif($month3=="12"){
$bulan2 = "Desember";
}
							echo "<td>$date3 $bulan2 $year3</td>";
							$pecah2 = explode("-", $r['tanggal_berlaku']);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
if ($month2=="01"){
$bulan1 = "Januari";
}elseif($month2=="02"){
$bulan1 = "Februari";
}elseif($month2=="03"){
$bulan1 = "Maret";
}elseif($month2=="04"){
$bulan1 = "April";
}elseif($month2=="05"){
$bulan1 = "Mei";
}elseif($month2=="06"){
$bulan1 = "Juni";
}elseif($month2=="07"){
$bulan1 = "Juli";
}elseif($month2=="08"){
$bulan1 = "Agustus";
}elseif($month2=="09"){
$bulan1 = "September";
}elseif($month2=="10"){
$bulan1 = "Oktober";
}elseif($month2=="11"){
$bulan1 = "November";
}elseif($month2=="12"){
$bulan1 = "Desember";
}
							echo "<td>$date2 $bulan1 $year2</td>";
							if ($r['status_persetujuan']=="N"){
							echo "<td><div style='color:red; font-weight:bold'>BELUM DISETUJUI</div></td>";
							}else{
							echo "<td><div style='color:blue; font-weight:bold'>DISETUJUI</div></td>";
							}
						  echo"<td><b><a onclick=\"return confirm('Anda Yakin Melakukan Persetujuan Transaksi Ini?')\" href='?modul=persetujuan&aksi=setuju&id_transaksi=".$r['id_transaksi']."'>SETUJUI</a></b></td>";
							echo "
                            </tr>";
							
                      $no++;
                    }                    
                    echo "
                </tbody>
         </table>";
break;
case "setuju":
$sql = mysqli_query($conn,"UPDATE tbl_trans_deposit SET
status_persetujuan = 'Y'
where id_transaksi ='$_GET[id_transaksi]'");
if($sql){
echo '<script>alert(\'Persetujuan Berhasil\')
	setTimeout(\'location.href="?modul=persetujuan&aksi=tampil"\' ,0);</script>';
	}else{
	echo '<script>alert(\'Gagal Persetujuan !\')
setTimeout(\'location.href="?modul=persetujuan&aksi=tampil"\' ,0);</script>';
	}
break;

	}



?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>