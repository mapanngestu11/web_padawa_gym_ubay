<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
if(!isset($_GET['id_pasien'])){
echo '<script>alert(\'Instrukti Tidak Sah !\')
setTimeout(\'location.href="?modul=pasien&aksi=tampil"\' ,0);</script>';
}else{

$query0=mysqli_query($conn,"select * from tbl_pasien where id_pasien='$_GET[id_pasien]'");
echo"<center><table border='0' style='border-collapse:collapse;width:500px; font-size:9px; background-color:yellow' id='tabel'>";

$baris0=1;
while($tampil0=mysqli_fetch_array($query0)){ 
echo"<tr><td>ID PASIEN</td><td>$tampil0[id_pasien]</td></tr>";
echo"<tr><td>Nama</td><td>$tampil0[nama]</td></tr>";
echo"<tr><td>Tanggal Lahir</td><td>$tampil0[tanggal_lahir]</td></tr>";
echo"<tr><td>Alamat</td><td>$tampil0[alamat]</td></tr>";
echo"<tr><td>Jenis Kelamin</td><td>$tampil0[jenis_kelamin]</td></tr>";
echo"<tr><td>Pekerjaan</td><td>$tampil0[pekerjaan]</td></tr>";
echo"<tr><td>Nama Kepala Keluarga</td><td>$tampil0[namakk]</td></tr>";
echo"<tr><td>Berat</td><td>$tampil0[berat]</td></tr>";
echo"<tr><td>Tinggi</td><td>$tampil0[tinggi]</td></tr>";
echo"<tr><td>No Telepon</td><td>$tampil0[tel]</td></tr>";
$baris0++;}
echo"</tr>";
echo"</table></center></br>";


$query=mysqli_query($conn,"select * from tbl_riwayat where id_pasien='$_GET[id_pasien]' order by id_riwayat ASC");
echo "<center><a href='index.php?modul=riwayat&aksi=tambahriwayat&id_pasien=$_GET[id_pasien]' class='button'>Tambah Data Riwayat Pasien Ini</a></br></br>
";
echo"<table border='1' style='border-collapse:collapse;width:900px; font-size:9px;' id='tabel'>
<tr bgcolor='#141b64' style=\"color:#FFFFFF\" align='center'>
<td width='10%'>No.</td>
<td width='35%'>Riwayat</td>
<td width='35%'>Ketarangan</td>
<td width='6%'>Hapus</td>
<td width='6%'>Edit</td>";
$no=1;
$baris=1;
while($tampil=mysqli_fetch_array($query)){ 
if($baris%2==0)
{
echo "<tr bgcolor=\"#d9e2da\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo"<td align='center'>$no</td>";
echo"<td>$tampil[riwayat]</td>";
echo"<td>$tampil[keterangan]</td>";
echo"<td><center><a href=?modul=riwayat&aksi=editriwayat&id_riwayat=$tampil[id_riwayat]&id_pasien=$tampil[id_pasien]>Edit</center></td>";
echo"<td><center><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=riwayat&aksi=hapus&id_riwayat=$tampil[id_riwayat]&id_pasien=$tampil[id_pasien]'>Hapus</center></td>";


$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
}
break;

//INTERFACE TAMBAH
case "tambahriwayat":
if(!isset($_GET['id_pasien'])){
echo '<script>alert(\'Instrukti Tidak Sah !\')
setTimeout(\'location.href="?modul=pasien&aksi=tampil"\' ,0);</script>';
}else{
echo '<div class="container2">';

	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=riwayat&aksi=input">';
echo '<div id="papanpanel2">
	<h3>Tambah Data Riwayat</h3>
	</div>  ';
	$qr	= mysqli_query($conn,"SELECT MAX(CONCAT(LPAD((RIGHT((id_riwayat),7)+1),7,'0')))FROM tbl_riwayat");
$qr2	= mysqli_query($conn,"SELECT MIN(CONCAT(LPAD((RIGHT((id_riwayat),7)),7,'0')))FROM tbl_riwayat");	
$kde= mysqli_fetch_array($qr);
$kde2= mysqli_fetch_array($qr2);
if ($kde2[0]!="0000001"){
$kodea = "0000001";
}
else{
$kodea = $kde[0];
}   
?>
       
        <div id="tickets">
            <ul>
			 
			 <li>
                    <label for="id_pasien" class="required">ID PASIEN</label>
                    <input type="text" size="30" id="id_pasien" name="id_pasien" class="k-textbox" value="<?php echo "$_GET[id_pasien]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
				 <li>
                  
                    <input type="hidden" size="30" id="id_riwayat" name="id_riwayat" class="k-textbox" value="<?php echo "RWT$kodea"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
                <li>
                    <label for="riwayat" class="required">Riwayat</label>
                    <input type="text" size="30" maxlength="40" id="riwayat" name="riwayat" class="k-textbox" placeholder="Masukkan Riwayat" required validationMessage="Mohon Masukkan Riwayat Pasien" />
                </li>
				  <li>
                    <label for="keterangan" class="required">Ketarangan</label>
                    <input type="text" size="30" maxlength="40" id="keterangan" name="keterangan" class="k-textbox" placeholder="Masukkan keterangan" required validationMessage="Mohon Masukkan Keterangan" />
                </li>
				  

                <li  class="accept">
                    <button class="k-button" type="submit">Submit</button>&nbsp&nbsp&nbsp
					<button class="k-button" onclick="self.history.back()" type="button">Batal</button>
                </li>
                <li class="status">
                </li>
				</form>
            </ul>
        </div>

            <style scoped>

                .k-textbox {
                    width: 11.8em;
                }

                #tickets {
                    width: 810px;
                    height: 223px;
                    margin-left: 0px auto;
                    padding: 0px;
                }

                #tickets h3 {
                    font-weight: normal;
                    font-size: 1.4em;
                    border-bottom: 1px solid #ccc;
                }

                #tickets ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }
                #tickets li {
                    margin: 10px 0 0 0;
                }

                label {
                    display: inline-block;
                    width: 90px;
                    text-align: right;
                }

                .required {
                    font-weight: bold;
                }

                .accept, .status {
                    padding-left: 90px;
                }

                .valid {
                    color: green;
                }

                .invalid {
                    color: red;
                }
                span.k-tooltip {
                    margin-left: 6px;
                }
            </style>

            <script>
                $(document).ready(function() {
                    var data = [
                    "12 Angry Men",
                    "Il buono, il brutto, il cattivo.",
                    "Inception",
                    "One Flew Over the Cuckoo's Nest",
                    "Pulp Fiction",
                    "Schindler's List",
                    "The Dark Knight",
                    "The Godfather",
                    "The Godfather: Part II",
                    "The Shawshank Redemption"
                    ];

                    $("#search").kendoAutoComplete({
                        dataSource: data,
                        separator: ", "
                    });

                    var validator = $("#tickets").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("button").click(function() {
                        if (validator.validate()) {
                            status.text("Input Data Sukses...!!!").addClass("valid");
                            } else {
                            status.text("Maaf.. Mohon Periksa Kembali Data Yang Anda Masukkan").addClass("invalid");
                        }
                    });
                });
            </script>
			<script>
                $(document).ready(function() {
               

           
                    $("#jenis_kelamin").kendoDropDownList();

                  

                  
                });
            </script>

        </div>
<?php
echo '<style TYPE="text/css" > 
	.container2{ width: 900px; background: transparent;}	
	#contactform {
	
	width: 900px;
	padding-left:0px;
	padding-top:0px;
	background: #f0f0f0;
	overflow:auto;
	
	border: 5px solid #000000;
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	
	-moz-box-shadow: 2px 2px 2px #cccccc;
	-webkit-box-shadow: 2px 2px 2px #cccccc;
	box-shadow: 2px 2px 2px #cccccc;
	
	}
	
	.field{margin-bottom:3px;}
	
	label {
	font-family: Arial, Verdana; 
	text-shadow: 2px 2px 2px #ccc;
	display: block; 
	float: left; 
	margin-right:10px; 
	text-align: right; 
	width: 120px; 
	line-height: 20px; 
	font-size: 12px; 
	}
	
	.input{
	font-family: Arial, Verdana; 
	font-size: 12px; 
	padding: 5px; 
	border: 1px solid #b9bdc1; 
	width: 500px; 
	color: #797979;	
	}
	
	.input:focus{
	background-color:#E7E8E7;	
	}
	
	.textarea {
	height:100px;	
	}
	
	.hint{
	display:none;
	}
	
	.field:hover .hint {  
	position: absolute;
	display: block;  
	margin: -30px 0 0 650px;
	color: #FFFFFF;
	padding: 7px 10px;
	background: rgba(0, 0, 0, 0.6);
	
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	}
	
	
	
	
    
   </style>';
}
break;

//INTERFACE EDITUSER
case "editriwayat":
if(!isset($_GET['id_pasien'])){
echo '<script>alert(\'Instrukti Tidak Sah !\')
setTimeout(\'location.href="?modul=pasien&aksi=tampil"\' ,0);</script>';
}else{
$db="select * from tbl_riwayat where id_riwayat='$_GET[id_riwayat]'";
$qri=mysqli_query($conn,$db);
$row=mysqli_fetch_array($qri);
echo '<div class="container2">';

	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=riwayat&aksi=update">';
echo '<div id="papanpanel2">
	<h3>Tambah Data Riwayat</h3>
	</div>  ';
?>
       
        <div id="tickets">
            <ul>
			 
			 <li>
                    <label for="id_pasien" class="required">ID PASIEN</label>
                    <input type="text" size="30" id="id_pasien" name="id_pasien" class="k-textbox" value="<?php echo "$row[id_pasien]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
				 <li>
                   
                    <input type="hidden" size="30" id="id_riwayat" name="id_riwayat" class="k-textbox" value="<?php echo "$row[id_riwayat]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
                <li>
                    <label for="riwayat" class="required">Riwayat</label>
                    <input type="text" size="30" maxlength="40" id="riwayat" name="riwayat" class="k-textbox" value="<?php echo "$row[riwayat]"; ?>" placeholder="Masukkan Riwayat" required validationMessage="Mohon Masukkan Riwayat Pasien" />
                </li>
				  <li>
                    <label for="keterangan" class="required">Ketarangan</label>
                    <input type="text" size="30" maxlength="40" id="keterangan" name="keterangan" class="k-textbox" value="<?php echo "$row[keterangan]"; ?>" placeholder="Masukkan keterangan" required validationMessage="Mohon Masukkan Keterangan" />
                </li>
				  

                <li  class="accept">
                    <button class="k-button" type="submit">Submit</button>&nbsp&nbsp&nbsp
					<button class="k-button" onclick="self.history.back()" type="button">Batal</button>
                </li>
                <li class="status">
                </li>
				</form>
            </ul>
        </div>

            <style scoped>

                .k-textbox {
                    width: 11.8em;
                }

                #tickets {
                    width: 810px;
                    height: 223px;
                    margin-left: 0px auto;
                    padding: 0px;
                }

                #tickets h3 {
                    font-weight: normal;
                    font-size: 1.4em;
                    border-bottom: 1px solid #ccc;
                }

                #tickets ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }
                #tickets li {
                    margin: 10px 0 0 0;
                }

                label {
                    display: inline-block;
                    width: 90px;
                    text-align: right;
                }

                .required {
                    font-weight: bold;
                }

                .accept, .status {
                    padding-left: 90px;
                }

                .valid {
                    color: green;
                }

                .invalid {
                    color: red;
                }
                span.k-tooltip {
                    margin-left: 6px;
                }
            </style>

            <script>
                $(document).ready(function() {
                    var data = [
                    "12 Angry Men",
                    "Il buono, il brutto, il cattivo.",
                    "Inception",
                    "One Flew Over the Cuckoo's Nest",
                    "Pulp Fiction",
                    "Schindler's List",
                    "The Dark Knight",
                    "The Godfather",
                    "The Godfather: Part II",
                    "The Shawshank Redemption"
                    ];

                    $("#search").kendoAutoComplete({
                        dataSource: data,
                        separator: ", "
                    });

                    var validator = $("#tickets").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("button").click(function() {
                        if (validator.validate()) {
                            status.text("Input Data Sukses...!!!").addClass("valid");
                            } else {
                            status.text("Maaf.. Mohon Periksa Kembali Data Yang Anda Masukkan").addClass("invalid");
                        }
                    });
                });
            </script>
			<script>
                $(document).ready(function() {
               

           
                    $("#jenis_kelamin").kendoDropDownList();

                  

                  
                });
            </script>

        </div>
<?php
echo '<style TYPE="text/css" > 
	.container2{ width: 900px; background: transparent;}	
	#contactform {
	
	width: 900px;
	padding-left:0px;
	padding-top:0px;
	background: #f0f0f0;
	overflow:auto;
	
	border: 5px solid #000000;
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	
	-moz-box-shadow: 2px 2px 2px #cccccc;
	-webkit-box-shadow: 2px 2px 2px #cccccc;
	box-shadow: 2px 2px 2px #cccccc;
	
	}
	
	.field{margin-bottom:3px;}
	
	label {
	font-family: Arial, Verdana; 
	text-shadow: 2px 2px 2px #ccc;
	display: block; 
	float: left; 
	margin-right:10px; 
	text-align: right; 
	width: 120px; 
	line-height: 20px; 
	font-size: 12px; 
	}
	
	.input{
	font-family: Arial, Verdana; 
	font-size: 12px; 
	padding: 5px; 
	border: 1px solid #b9bdc1; 
	width: 500px; 
	color: #797979;	
	}
	
	.input:focus{
	background-color:#E7E8E7;	
	}
	
	.textarea {
	height:100px;	
	}
	
	.hint{
	display:none;
	}
	
	.field:hover .hint {  
	position: absolute;
	display: block;  
	margin: -30px 0 0 650px;
	color: #FFFFFF;
	padding: 7px 10px;
	background: rgba(0, 0, 0, 0.6);
	
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	border-radius: 7px;	
	}
	
	
	
	
    
   </style>';
}
break;

//HAPUS
case "hapus":
mysqli_query($conn,"DELETE FROM tbl_riwayat WHERE id_riwayat='$_GET[id_riwayat]'");
	echo '<script>setTimeout(\'location.href="?modul=riwayat&aksi=tampil&id_pasien='.$_GET['id_pasien'].'"\' ,0);</script>';
break;

//INPUT
case "input":
$query=mysqli_query($conn,"select * from tbl_riwayat where id_riwayat = '$_POST[id_riwayat]'");
$tampil=mysqli_fetch_row($query);
if ($tampil>0){
echo '<script>alert(\'Data Dengan id_riwayat ini Sudah Ada . . !\')
	setTimeout(\'location.href="?modul=riwayat&aksi=tambahriwayat&id_pasien='.$_POST['id_pasien'].'"\' ,0);</script>';
}

else{

	//echo"ukuran File Anda : $ukuran "."Byte</br>";
	//echo" File Disimpan di ".$tujuan;
	//echo "</br></br>$tes";
		$kelas = str_replace("'", "''",$_POST['kelas']);
		
		$sql = mysqli_query($conn,"INSERT INTO tbl_riwayat VALUES(
						'$_POST[id_pasien]',
						'$_POST[id_riwayat]',
						'$_POST[riwayat]',		
						'$_POST[keterangan]'								
						)"); 		
						
		if (!$sql)
		{
		echo mysqli_error();
		echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
		
		}else
		{
		echo '<script>alert(\'Data Berhasil Dimasukkan\')
			setTimeout(\'location.href="?modul=riwayat&aksi=tampil&id_pasien='.$_POST['id_pasien'].'"\' ,0);</script>';
		}	 
	}
break;

//UPDATE USER
case "update":
$sql = mysqli_query($conn,"UPDATE tbl_riwayat SET 
id_pasien = '$_POST[id_pasien]',
riwayat = '$_POST[riwayat]',
keterangan = '$_POST[keterangan]'
where id_riwayat='$_POST[id_riwayat]'");
if($sql){
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=riwayat&aksi=tampil&id_pasien='.$_POST['id_pasien'].'"\' ,0);</script>';
	}else{
	echo '<script>alert(\'Gagal Mengedit !\')
setTimeout(\'location.href="?modul=riwayat&aksi=tampil&id_pasien='.$_POST['id_pasien'].'"\' ,0);</script>';
	}
break;
break;


}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>