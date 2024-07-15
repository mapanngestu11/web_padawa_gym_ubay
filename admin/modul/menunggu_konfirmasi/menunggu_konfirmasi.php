<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo '
		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID TRANSAKSI</th>
                        <th>ID MEMBER</th>
						<th>Nama Member</th>
						<th>Jumlah Transaksi</th>
						<th>Tanggal Pesan</th>
						
						<th>Keterangan</th>
						<th>Konfirmasi</th>
						<th>Hapus</th>
                    </tr>
                </thead>
                <tbody>';
                                      /* if ($_SESSION['levelmembership']=="member") {
									   $sql = mysqli_query($conn,"SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) and (tbl_trans_deposit.status_setujukonfirmasi = 'Y') and (tbl_member.user = '$_SESSION[usermembership]') ORDER BY id_transaksi DESC");
									   }else{ */
					          $sql = mysqli_query($conn,"SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) and (tbl_trans_deposit.status_setujukonfirmasi = 'N') ORDER BY id_transaksi DESC");
							 // }
					          $no = 1;
                    while ($r = mysqli_fetch_array($sql)) {
                      echo "<tr>
                            <td width=40>$no</td>
                            <td>$r[id_transaksi]</td>
                            <td>$r[id_member]</td>
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
							echo"
                            <td>$r[ket]</td>
						    ";
						 
echo "<td><a onclick=\"return confirm('Anda Yakin Mengkonfirmasi Transaksi Ini?')\" href='?modul=menunggu_konfirmasi&aksi=konfirmasi&id_transaksi=".$r['id_transaksi']."'>Konfirmasi</td>";
echo "<td><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=menunggu_konfirmasi&aksi=hapus&id_transaksi=".$r['id_transaksi']."'>Hapus</td>";
							echo "
                            </tr>";
							
                      $no++;
                    }                    
                    echo "
                </tbody>
         </table>";
break;

case "hapus";
mysqli_query($conn,"DELETE FROM tbl_trans_deposit WHERE id_transaksi ='$_GET[id_transaksi]'");
	echo '<script>setTimeout(\'location.href="?modul=menunggu_konfirmasi&aksi=tampil"\' ,0);</script>';
break;

case "konfirmasi";
/*mysqli_query($conn,"DELETE FROM tbl_trans_deposit WHERE id_transaksi ='$_GET[id_transaksi]'");
echo '<script>setTimeout(\'location.href="?modul=transaksi&aksi=tampil"\' ,0);</script>';*/
$datatransaksi = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_trans_deposit where id_transaksi = '$_GET[id_transaksi]'"));

date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);

$tampiltarif = mysqli_fetch_array(mysqli_query($conn,"select tarif,jml_bulan from tbl_tarif where kode_tarif = '$datatransaksi[kode_tarif]'"));
//$deposit = $tampiltarif['tarif']*$_POST['bulan'];
$deposit = $tampiltarif['tarif'];
$cekdep = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_deposit where id_member = '$datatransaksi[id_member]' and kode_tarif='$datatransaksi[kode_tarif]'"));
if(empty($cekdep['kode_tarif'])){
$cekdep2 = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_deposit where id_member = '$datatransaksi[id_member]' and kode_tarif='$datatransaksi[kode_tarif]'"));
if(!empty($cekdep2['kode_tarif'])){
	echo '<script>alert(\'Gagal.. Member dengan paket ini sudah ada. Tinggal Diaktivasi saja\')
			setTimeout(\'location.href="?modul=menunggu_konfirmasi&aksi=tampil"\' ,0);</script>';
}else{
$quertarif0 = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_tarif where kode_tarif='$datatransaksi[kode_tarif]'"));
$berlaku0 = mysqli_fetch_array(mysqli_query($conn,"SELECT ADDDATE('$tglsekarang', INTERVAL $tampiltarif[jml_bulan] MONTH) AS berlaku"));
	mysqli_query($conn,"insert into tbl_deposit values ('$datatransaksi[id_member]','$datatransaksi[kode_tarif]','$tglsekarang',
						'$berlaku0[berlaku]',$quertarif0[jml_latih_max])");
		$sql = mysqli_query($conn,"UPDATE tbl_trans_deposit set
		id_member = '$datatransaksi[id_member]',
		kode_tarif = '$datatransaksi[kode_tarif]',
		jumlah_deposit = $deposit,
		tanggal_transaksi = '$tglsekarang',
		tanggal_berlaku = '$berlaku0[berlaku]',
		status_persetujuan =  'Y',
		status_konfirmasitagihan = 'Y',
		status_setujukonfirmasi = 'Y',
		ket = '-'
		where id_transaksi = '$_GET[id_transaksi]'"); 
}						
}else{
	$cekberlaku0 = mysqli_fetch_array(mysqli_query($conn,"select tanggal_berlaku,kuota_latihan from tbl_deposit where id_member='$datatransaksi[id_member]' and kode_tarif='$datatransaksi[kode_tarif]'"));
		date_default_timezone_set('Asia/Jakarta');
$tanggal10 = mktime(date("m"),date("d"),date("Y"));
$tglsekarang10 = date("Y-m-d", $tanggal10); $pecah20 = explode("-", $tglsekarang10); $date20 = $pecah20[2]; $month20 = $pecah20[1]; $year20 = $pecah20[0];
$sekarang20 = GregorianToJD($month20, $date20, $year20);
$valid20 = $cekberlaku0['tanggal_berlaku']; $pecah30 = explode("-", $valid20); $date30= $pecah30[2]; $month30 = $pecah30[1]; $year30 = $pecah30[0];
$valid30 = GregorianToJD($month30, $date30, $year30);
$selisih20 = $valid30 - $sekarang20;
if($cekberlaku0['tanggal_berlaku']=="0000-00-00"){
$quertarif0 = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_tarif where kode_tarif='$datatransaksi[kode_tarif]'"));
//$iberlaku0 = $deposit/$quertarif0['tarif'];
$iberlaku0 = $tampiltarif['jml_bulan'];
$berlaku0 = mysqli_fetch_array(mysqli_query($conn,"SELECT ADDDATE('$tglsekarang', INTERVAL $iberlaku0 MONTH) AS berlaku"));
}
else
{
if($selisih20 < 0)
{
$quertarif0 = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_tarif where kode_tarif='$datatransaksi[kode_tarif]'"));
$iberlaku0 = $tampiltarif['jml_bulan'];
$berlaku0 = mysqli_fetch_array(mysqli_query($conn,"SELECT ADDDATE('$tglsekarang', INTERVAL $iberlaku0 MONTH) AS berlaku"));
$kuotalatih = $quertarif0['jml_latih_max'];
}elseif($cekberlaku0['kuota_latihan']==0){
$quertarif0 = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_tarif where kode_tarif='$datatransaksi[kode_tarif]'"));
$iberlaku0 = $tampiltarif['jml_bulan'];
$berlaku0 = mysqli_fetch_array(mysqli_query($conn,"SELECT ADDDATE('$tglsekarang', INTERVAL $iberlaku0 MONTH) AS berlaku"));
$kuotalatih = $quertarif0['jml_latih_max'];	
}
else{
$quertarif0 = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_tarif where kode_tarif='$datatransaksi[kode_tarif]'"));
//$iberlaku0 = $deposit/$quertarif0['tarif'];
$iberlaku0 = $tampiltarif['jml_bulan'];
$berlaku0 = mysqli_fetch_array(mysqli_query($conn,"SELECT ADDDATE('$cekberlaku0[tanggal_berlaku]', INTERVAL $iberlaku0 MONTH) AS berlaku"));
$kuotalatih = $cekberlaku0['kuota_latihan']+$quertarif0['jml_latih_max'];
}
}

		$sql = mysqli_query($conn,"UPDATE tbl_trans_deposit SET
		id_member = '$datatransaksi[id_member]',
		kode_tarif = '$datatransaksi[kode_tarif]',
		jumlah_deposit = $deposit,
		tanggal_transaksi = '$tglsekarang',
		tanggal_berlaku = '$berlaku0[berlaku]',
		status_persetujuan =  'Y',
		status_konfirmasitagihan = 'Y',
		status_setujukonfirmasi = 'Y',
		ket = '-'
		where id_transaksi = '$_GET[id_transaksi]'"); 
						
		
						
		mysqli_query($conn,"update tbl_deposit set
		id_member = '$datatransaksi[id_member]',
		tanggal_deposit = '$tglsekarang',
		tanggal_berlaku = '$berlaku0[berlaku]',
		kuota_latihan = $kuotalatih
		where id_member = '$datatransaksi[id_member]' and kode_tarif = '$datatransaksi[kode_tarif]'");
}						
		if (!$sql)
		{
		echo mysqli_error();
		echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
		
		}else
		{

		
		echo '<script>alert(\'Aktivasi/Perpanjang Paket Berhasil dan Bukti Pembayaran dapat dilihat pada menu FAKTUR PEMBAYARAN\')
			setTimeout(\'location.href="?modul=detailmember&aksi=tampil&id='.$datatransaksi['id_member'].'"\' ,0);</script>';
			
		}	 
	
break;

	}



?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>