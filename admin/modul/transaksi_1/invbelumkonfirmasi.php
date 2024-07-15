<html>
<head>
<title>Invoice Pembayaran</title>
<style>

#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'">
<?php
//onload="javascript:window.print()"
include "../../koneksi/koneksi.php";
//***********************//


$sql_limit = "select * from tbl_trans_deposit,tbl_tarif where tbl_trans_deposit.kode_tarif = tbl_tarif.kode_tarif and id_transaksi = '$_GET[id_transaksi]'";
$query=mysqli_query($conn,$sql_limit);
//$tampil=mysqli_fetch_array($query);


//************************************//
$row = mysqli_fetch_array(mysqli_query($conn,"select tanggal_transaksi from tbl_trans_deposit where id_transaksi = '$_GET[id_transaksi]'"));
$pecah = explode("-",$row['tanggal_transaksi']);
$bln= $pecah[1];
$thn= $pecah[0];
$tgl= $pecah[2];
switch($bln){
case '01':
$bulan = 'Januari';
break;
case '02':
$bulan = 'Februari';
break;
case '03':
$bulan = 'Maret';
break;
case '04':
$bulan = 'April';
break;
case '05':
$bulan = 'Mei';
break;
case '06':
$bulan = 'Juni';
break;
case '07':
$bulan = 'Juli';
break;
case '08':
$bulan = 'Agustus';
break;
case '09':
$bulan = 'September';
break;
case '10':
$bulan = 'Oktober';
break;
case '11':
$bulan = 'November';
break;
case '12':
$bulan = 'Desember';
break;
}
$identitas = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_identitas where id_identitas=1"));
$idmember = mysqli_fetch_array(mysqli_query($conn,"select id_member from tbl_trans_deposit where id_transaksi = '$_GET[id_transaksi]'"));
$nama = mysqli_fetch_array(mysqli_query($conn,"select nama from tbl_member where id_member = '$idmember[id_member]'"));
echo"<center><table cellspacing='0' style='width:550; font-size:11pt; font-family:tahoma' border = '0'><td align='center'>
<span style='font-size:14pt'><b>$identitas[nama]</b></span></br><b>$identitas[alamat], No Telp : $identitas[no_telp]</b>
</td></table>
<table cellspacing='0' style='width:550; font-size:11pt; font-family:tahoma' border = '0'>

<tr><td align='left'>No Invoice: $_GET[id_transaksi] | $tgl $bulan $thn</td><td align='right'>Kepada Yth, $nama[nama]</td>
</table>
<table cellspacing='0' style='width:550; font-size:11pt; font-family:tahoma; border-collapse: collapse;' border='1'>
<!--<tr><td colspan=6>......................................................................................................................................................</td></tr>-->
<tr align='center'>
<td width='10%'>No</td>
<td width='20%'>Kode Tarif</td>
<td width='20%'>Jenis (Paket)</td>
<td width='13%'>Jumlah Deposit</td>
<!--<tr><td colspan=6>......................................................................................................................................................</td>-->";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
echo "<tr>"; 

echo"<td>$no</td>";
echo"<td>$tampil[kode_tarif]</td>";
echo"<td>$tampil[jenis_tarif]</td>";
$pecah2 = explode("-", $tampil['tanggal_berlaku']);
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

echo"<td>Rp".number_format($tampil['jumlah_deposit'],2,',','.')."</td>";
$no++;
error_reporting(0);
$tampilkanjumlah+=$tampil['jumlah_deposit'];
}
echo"</tr>";
error_reporting(0);

echo "<tr><td colspan = '5'><div style='text-align:right'>Terbilang :".ucwords(Terbilang($tampilkanjumlah))." Rupiah</div></td></tr>";
echo"<table style='width:550; font-size:10pt;' cellspacing='2'>";
$kuery2=mysqli_query($conn,"select kasir from cash where no_faktur = '$_GET[no_faktur]'");
$tampilkan2=mysqli_fetch_array($kuery2);
echo"<tr><td align='center'>Diterima Oleh,</br></br><u>(............)</u></td>
<td align='center'>TTD, $nama[nama]</br></br><u>(...........)</u></td></tr>";
echo"</table>";
echo "<br><br>
<div style='width:550px; font-size:14pt; background-color:#d0ceff; padding:20px; border:1px solid black; text-align:center'>
Silahkan Transfer Sesuai Jumlah Yang Tertera Pada Invoice. <br>
Dan Lakukan Konfirmasi Pembayaran Ke Admin Kami<br>
Petugas Akan Segera Memproses Keanggotaan Member Anda.
</div> 


</center></body>";
function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
?>

</html>