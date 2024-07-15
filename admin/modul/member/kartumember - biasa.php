<?php
include "../../koneksi/koneksi.php";
$data=mysqli_fetch_array(mysqli_query($conn,"select * from tbl_member where id_member = '$_GET[text]'"));
	echo "<html>
	<head>
		<title>Barcode</title>
		
<style>
#tabel
{
font-size:12px;
border-collapse:collapse;
font-family:Calibri;

}
#tabel  td
{
padding-left:3px;
border: 1px solid black;

}
#headkartu
{
font-family:arial; 
font-size:14pt;
font-weight:bold;
}
#bgg {
background-image: url('bg.jpg');
background-repeat: no-repeat;
background-size: 100% 100%;
}
#bgback {
background-image: url('bgback.jpg');
background-repeat: no-repeat;
background-size: 100% 100%;
}
</style>
	</head>
	<body>
	<table id='tabel' style='width:740px; height:230px;'>
	<tr><td id='bgg' width='370px' height='100px' style='vertical-align:top; padding-top:0px; padding-left:0px;'>
	
	
	<div style='padding-left:150px; padding-top:20px; color:white; font-weight:bold'>ID : $data[id_member]</br>
	Name : $data[nama]</br>
	Join Date : $data[tanggal_daftar]</br></div>
	";
	/*echo  "<div style='padding-left:80px; padding-right:30px; padding-top:80px; float:right; color:white; font-weight:bold'>";
	if (file_exists("../../images/member/$_GET[text].jpg")) {
echo "
	<img src='../../images/member/".$_GET['text'].".jpg' width='50px'/>";
}else{
echo "
	<img src='../../images/member/def.png' width='50px'/>";
}

	echo "</div>";*/
	
	echo "<div style='margin-top:70px;  margin-bottom:5px; width:300px padding-left:20px'><center>
	<image src='barcode.php?codetype=Code128&size=70&text=$_GET[text]'/></center></div></td>
	<td style='vertical-align:top' width='370px' id='bgback'>
	<div style='padding-left:20px; padding:10px 10px 10px 10px; background-color:black; color:white; font-weight:bold'>
	MOHON KARTU DIPERLIHATKAN KEPADA KASIR SEBELUM FITNESS</br>
	1. Kartu ini adalah kartu anggota dan tidak dapat digunakan sebagai alat pembayaran</br>
	2. Kartu ini tidak dapat dipindahtangankan</br>
	3. Hanya berlaku di tampat penerbit kartu anggota
	4. Kartu diperpanjang otomatis setelah membayar administrasi paket</div>
	
	</td></tr>
	</table>
	
	</body>
	</html>";
?>