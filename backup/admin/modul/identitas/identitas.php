<?php

switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
$query=mysqli_query($conn,"select * from tbl_identitas");
echo"<center><h1>Identitas Tempat</h1></center>";
echo"<center><table id='tabel' style='width:700px; font-size:11pt;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td width='30%'>Nama Tempat</td>
<td width='50%'>Alamat</td>
<td width='15%'>No Telepon</td>";
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
echo"<td align='left'><span style='font-size:11pt;'>$tampil[nama]</span></td>";
echo"<td align='left'><span style='font-size:11pt;'>$tampil[alamat]</span></td>";
echo"<td align='left'><span style='font-size:11pt;'>$tampil[no_telp]</span></td>";
echo"<td align='center'><a href=?modul=identitas&aksi=editidentitas&id=$tampil[id_identitas]>Ubah</td>";
$baris++;}
echo"</tr>";
echo"</table></center>";
break;

//INTERFACE EDIT
case "editidentitas":
echo"<center><h1>Ubah Identitas</h1></center>";
$db="select * from tbl_identitas where id_identitas='$_GET[id]'";
$qri=mysqli_query($conn,$db);
$row=mysqli_fetch_array($qri);
echo"<form action='?modul=identitas&aksi=update&id_identitas=$row[id_identitas]' method=POST>";
echo"<center><table id='tabeledit'>";
echo"<tr><td></td><td><input style='background-color:#eeeeff'; readonly='1' type=hidden name='id_tarif' value='$row[id_tarif]'></td></tr>";
echo"<tr><td>Nama Tempat : </td><td><input type=text name='nama' maxlength='20' value='$row[nama]'></td></tr>";
echo"<tr><td style='vertical-align:top'>Alamat : </td><td><textarea name='alamat' rows='3' style='width:300px' maxlength='80'>$row[alamat]</textarea></td></tr>";
echo"<tr><td>Nomor Telepon : </td><td><input type=text name='no_telp' maxlength='20' value='$row[no_telp]'></td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"</table></center>";
break;

//UPDATE 
case "update":
mysqli_query($conn,"UPDATE tbl_identitas SET id_identitas='$_GET[id_identitas]',
                                nama='$_POST[nama]',
alamat='$_POST[alamat]',
no_telp='$_POST[no_telp]'						
			where id_identitas='$_GET[id_identitas]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=identitas&aksi=tampil"\' ,0);</script>';
break;
}


?>