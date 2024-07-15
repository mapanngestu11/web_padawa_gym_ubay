<html>
<head>
<title>Laporan Rekap Member </title>
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
<body>
<?php
include "../../koneksi/koneksi.php";

$pecah4 = explode("-", $_POST['dari']);
$date4 = $pecah4[2];
$month4 = $pecah4[1];
$year4 = $pecah4[0];
if ($month4=="01"){
$bulan2 = "Januari";
}elseif($month4=="02"){
$bulan2 = "Februari";
}elseif($month4=="03"){
$bulan2 = "Maret";
}elseif($month4=="04"){
$bulan2 = "April";
}elseif($month4=="05"){
$bulan2 = "Mei";
}elseif($month4=="06"){
$bulan2 = "Juni";
}elseif($month4=="07"){
$bulan2 = "Juli";
}elseif($month4=="08"){
$bulan2 = "Agustus";
}elseif($month4=="09"){
$bulan2 = "September";
}elseif($month4=="10"){
$bulan2 = "Oktober";
}elseif($month4=="11"){
$bulan2 = "November";
}elseif($month4=="12"){
$bulan2 = "Desember";
}

$pecah5 = explode("-", $_POST['sampai']);
$date5 = $pecah5[2];
$month5 = $pecah5[1];
$year5 = $pecah5[0];
if ($month5=="01"){
$bulan5 = "Januari";
}elseif($month5=="02"){
$bulan5 = "Februari";
}elseif($month5=="03"){
$bulan5 = "Maret";
}elseif($month5=="04"){
$bulan5 = "April";
}elseif($month5=="05"){
$bulan5 = "Mei";
}elseif($month5=="06"){
$bulan5 = "Juni";
}elseif($month5=="07"){
$bulan5 = "Juli";
}elseif($month5=="08"){
$bulan5 = "Agustus";
}elseif($month5=="09"){
$bulan5 = "September";
}elseif($month5=="10"){
$bulan5 = "Oktober";
}elseif($month5=="11"){
$bulan5 = "November";
}elseif($month5=="12"){
$bulan5 = "Desember";
}

$dari = "$date4 $bulan2 $year4";
$sampai = "$date5 $bulan5 $year5";

$sql_limit = "select * from tbl_member where tanggal_daftar between '$_POST[dari]' and '$_POST[sampai]' order by id_member DESC";
$query=mysqli_query($conn,$sql_limit);
$query2=mysqli_query($conn,$sql_limit);
$cek = mysqli_fetch_array($query2);
if (empty($cek['id_member'])){
echo '<script>alert(\'Data Tidak Ada\')
	window.close()</script>';
}
$sub = substr($_POST['dari'],1,1);
//echo "$sub";
echo"<center>
<h3>Laporan REKAP MEMBER Berdasarkan Tanggal Daftar</h3>
Dari Tanggal \"$date4 $bulan2 $year4\" Sampai \"$date5 $bulan5 $year5\"
<table id='tabel' style='width:900px' border='1'>
<tr align='center'>
<td width='5%'>No</td>
<td width='10%'>ID Member</td>
<td width='10%'>No ID Card</td>
<td width='10%'>No Kartu</td>
<td width='10%'>Nama Member</td>
<td width='20%'>Alamat</td>
<td width='10%'>Jenis Kelamin</td>
<td width='15%'>Tanggal Daftar</td>
<td width='10%'>No HP/TELEPON</td>
";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$no</td>";
echo"<td>$tampil[id_member]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[pekerjaan]</td>";
echo"<td>$tampil[username]</td>";
echo"<td>$tampil[alamat]</td>";
echo"<td>$tampil[jenis_kelamin]</td>";
$pecah2 = explode("-", $tampil['tanggal_daftar']);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
if ($month2=="01"){
$bulan = "Januari";
}elseif($month2=="02"){
$bulan = "Februari";
}elseif($month2=="03"){
$bulan = "Maret";
}elseif($month2=="04"){
$bulan = "April";
}elseif($month2=="05"){
$bulan = "Mei";
}elseif($month2=="06"){
$bulan = "Juni";
}elseif($month2=="07"){
$bulan = "Juli";
}elseif($month2=="08"){
$bulan = "Agustus";
}elseif($month2=="09"){
$bulan = "September";
}elseif($month2=="10"){
$bulan = "Oktober";
}elseif($month2=="11"){
$bulan = "November";
}elseif($month2=="12"){
$bulan = "Desember";
}
echo"<td>$date2 $bulan $year2</td>";
echo"<td>$tampil[tel]</td>";

$no++;
}
echo"</tr>";
echo"</table></center></br></body>";

?>

</html>