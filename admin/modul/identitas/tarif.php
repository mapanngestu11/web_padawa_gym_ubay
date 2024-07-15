<?php

switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
$query=mysqli_query($conn,"select * from tbl_identitas");
echo"<center><h1>Identitas Tempat</h1></center>";
echo"<center><table id='tabel' style='width:700px; font-size:11pt;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td>Nama Tempat</td>
<td>Alamat</td>
<td>No Telepon</td>";
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
if($baris%2==0)
{
echo "<tr bgcolor=\"#D9E2DA\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo"<td align='center'><span style='font-size:11pt;'>$tampil[nama_tempat]</span></td>";
echo"<td align='center'><span style='font-size:11pt;'>$tampil[alamat]</span></td>";
echo"<td align='center'><span style='font-size:11pt;'>$tampil[no_telp]</span></td>";
echo"<td align='center'><a href=?modul=identitas&aksi=editidentitas&id=$tampil[id_identitas]>Ubah</td>";
$baris++;}
echo"</tr>";
echo"</table></center>";
break;

//INTERFACE EDIT
case "edittarif":
echo"<center><h1>Ubah Tarif Membership Per Bulan</h1></center>";
$db="select * from tbl_tarif where id_tarif='$_GET[id]'";
$qri=mysqli_query($conn,$db);
$row=mysqli_fetch_array($qri);
echo"<form action='?modul=identitas&aksi=update&id_tarif=$row[id_tarif]' method=POST>";
echo"<center><table id='tabeledit'>";
echo"<tr><td></td><td><input style='background-color:#eeeeff'; readonly='1' type=hidden name='id_tarif' value='$row[id_tarif]'></td></tr>";
echo"<tr><td>Tarif : </td><td><input type=text name='tarif' maxlength='10' value='$row[tarif]'></td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"</table></center>";
break;

//UPDATE 
case "update":
mysqli_query($conn,"UPDATE tbl_tarif SET id_tarif='$_POST[id_tarif]',
                                tarif='$_POST[tarif]'		
			where id_tarif='$_GET[id_tarif]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=identitas&aksi=tampil"\' ,0);</script>';
break;
}


?>