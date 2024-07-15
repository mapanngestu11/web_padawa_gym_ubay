<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo"<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
echo"<tr>
<td align=center><i>Pada Menu Ini, Admin / Kontrol Transaksi Melakukan Pengecekan Terlebih Dahulu Terhadap DATA KONFIRMASI MEMBER yang telah di inputkan pada menu TAGIHAN MEMBER (Data Konfirmasi dapat dilihat di menu DATA KONFIRMASI MEMBER). Kontrol Transaksi / Admin melakukan pengecekan pembayaran valid atau tidak, baik dengan melakukan pengecekan bank yang ditransfer, ebanking, atau lainnya. Selanjutnya Menekan SETUJUI KONFIRMASI. Dengan demikian transaksi iyuran member telah selesai</i></td>
</tr>";
echo"</table>";
echo '
		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID TRANSAKSI</th>
                       <th>ID MEMBER</th>
					   <th>Kode Tarif</th>
						<th>Nama Member</th>
						<th>Jumlah Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th>Tanggal Berlaku</th>
						<th>Keterangan</th>
						<th>Persetujuan</th>
                    </tr>
                </thead>
                <tbody>';
                                      
					          $sql = mysqli_query($conn,"SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) and (tbl_trans_deposit.status_persetujuan = 'Y') and (tbl_trans_deposit.status_konfirmasitagihan = 'Y') and (tbl_trans_deposit.status_setujukonfirmasi = 'N') ORDER BY id_transaksi DESC");
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
							if ($r['status_setujukonfirmasi']=="N"){
							echo "<td><div style='color:red; font-weight:bold'>BELUM DISETUJUI</div></td>";
							}else{
							echo "<td><div style='color:blue; font-weight:bold'>DISETUJUI</div></td>";
							}
						  echo"<td><b><a onclick=\"return confirm('Anda Yakin Melakukan Persetujuan Konfirmasi Ini? PASTIKAN KONFIRMASI PEMBAYARAN MEMBER SUDAH DI CEK DENGAN BENAR')\" href='?modul=persetujuankonfirmasi&kode_tarif=".$r['kode_tarif']."&aksi=setuju&id_transaksi=".$r['id_transaksi']."&id_member=".$r['id_member']."&jumlah_deposit=".$r['jumlah_deposit']."'>SETUJUI KONFIRMASI</a></b></td>";
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
status_setujukonfirmasi = 'Y'
where id_transaksi ='$_GET[id_transaksi]'");
if($sql){

$cekberlaku = mysqli_fetch_array(mysqli_query($conn,"select tanggal_berlaku from tbl_deposit where id_member='$_GET[id_member]'"));
		date_default_timezone_set('Asia/Jakarta');
$tanggal1= mktime(date("m"),date("d"),date("Y"));
$tglsekarang1 = date("Y-m-d", $tanggal1);
$pecah2 = explode("-", $tglsekarang1);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
$sekarang2 = GregorianToJD($month1, $date1, $year1);
$valid2 = $cekberlaku['tanggal_berlaku'];
$pecah3 = explode("-", $valid2);
$date3= $pecah3[2];
$month3 = $pecah3[1];
$year3 = $pecah3[0];
$valid3 = GregorianToJD($month3, $date3, $year3);
$selisih2 = $valid3 - $sekarang2;
if($cekberlaku['tanggal_berlaku']=="0000-00-00"){
$quertarif = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_tarif where kode_tarif = '$_GET[kode_tarif]'"));
$iberlaku = $_GET['jumlah_deposit']/$quertarif['tarif'];
$berlaku = mysqli_fetch_array(mysqli_query($conn,"SELECT ADDDATE('$tglsekarang1', INTERVAL $iberlaku MONTH) AS berlaku"));
		mysqli_query($conn,"update tbl_deposit set
		id_member = '$_GET[id_member]',
		tanggal_deposit = '$tglsekarang1',
		tanggal_berlaku = '$berlaku[berlaku]'
		where id_member = '$_GET[id_member]'");
}
else
{
if($selisih2 < 0)
{
$quertarif = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_tarif"));
$iberlaku = $_GET['jumlah_deposit']/$quertarif['tarif'];
$berlaku = mysqli_fetch_array(mysqli_query($conn,"SELECT ADDDATE('$tglsekarang', INTERVAL $iberlaku MONTH) AS berlaku"));
		mysqli_query($conn,"update tbl_deposit set
		id_member = '$_GET[id_member]',
		tanggal_deposit = '$tglsekarang1',
		tanggal_berlaku = '$berlaku[berlaku]'
		where id_member = '$_GET[id_member]'");
}else{
$quertarif = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_tarif"));
$iberlaku = $_GET['jumlah_deposit']/$quertarif['tarif'];
$berlaku = mysqli_fetch_array(mysqli_query($conn,"SELECT ADDDATE('$cekberlaku[tanggal_berlaku]', INTERVAL $iberlaku MONTH) AS berlaku"));
		mysqli_query($conn,"update tbl_deposit set
		id_member = '$_GET[id_member]',
		tanggal_deposit = '$tglsekarang1',
		tanggal_berlaku = '$berlaku[berlaku]'
		where id_member = '$_GET[id_member]'");
}
}
echo '<script>alert(\'Persetujuan Berhasil\')
	setTimeout(\'location.href="?modul=persetujuankonfirmasi&aksi=tampil"\' ,0);</script>';
	}else{
	echo '<script>alert(\'Gagal Persetujuan !\')
setTimeout(\'location.href="?modul=persetujuankonfirmasi&aksi=tampil"\' ,0);</script>';
	}
break;

	}



?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>