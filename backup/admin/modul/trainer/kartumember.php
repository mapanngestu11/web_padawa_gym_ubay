<?php
include "../../koneksi/koneksi.php";
$data=mysqli_fetch_array(mysqli_query($conn,"select * from tbl_member where id_member = '$_GET[text]'"));
	echo "<html>
	<head>
		<title>Barcode</title>
		
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
font-family:arial;
background-image: url('bg2.jpg');
background-repeat: no-repeat;
background-size: 100% 100%;
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
background-image: url('bgcard.jpg');
background-repeat: no-repeat;
background-size: 100% 100%;
}
</style>
	</head>
	<body>
	<table id='tabel' style='width:370px; height:230px;'>
	<tr><td id='bgg' height='100px' style='vertical-align:top; padding-top:10px; padding-left:20px;'>
	</br><div style='padding-left:100px; color:white; font-weight:bold'>ID : $data[id_member]</br>
	Name : $data[nama]</br>
	Join Date : $data[tanggal_daftar]</br></div>
	";
	echo  "<div style='padding-left:80px; padding-right:30px; padding-top:80px; float:right; color:white; font-weight:bold'>";
	if (file_exists("../../images/member/$_GET[text].jpg")) {
echo "
	<img src='../../images/member/".$_GET['text'].".jpg' width='50px'/>";
}else{
echo "
	<img src='../../images/member/def.png' width='50px'/>";
}

	echo "</div>
	
	<div style='margin-top:70px; margin-bottom:5px;'>
	<image src='barcode.php?codetype=Code128&size=70&text=$_GET[text]'/></div></td></tr>
	</table>
	
	</body>
	</html>";
?>