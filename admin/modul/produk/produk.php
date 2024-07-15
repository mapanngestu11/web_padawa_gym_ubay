<?php

switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
$query=mysqli_query($conn,"select * from tbl_tarif");

echo"<center><h1>TEST PRODUK</h1></center>";
if ($_SESSION['levelmembership']=="member"){
 }else{
echo '
<a href="index.php?modul=tarif&aksi=tambahtarif" class="button">Tambah Data Tarif</a></br></br>';
}
echo '

		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Paket</th>
                        <th>Nama Paket</th>
						<th>Tipe</th>
						<th>Batas Latihan Maximum</th>
						<th>Jumlah Bulan Keanggotaan</th>
						<th>Tarif Paket</th>
						<th>Ubah</th>
						<th>Hapus</th>
                    </tr>
                </thead>
                <tbody>';
                                      
					          $sql = mysqli_query($conn,"SELECT * FROM tbl_tarif order by id_tarif DESC");
					          $no = 1;
                    while ($r = mysqli_fetch_array($sql)) {
                      echo "<tr>
                            <td width=40>$no</td>
                            <td>$r[kode_tarif]</td>
                            <td>$r[jenis_tarif]</td>
							<td>$r[tipe]</td>";
							if($r['tipe']=="REGULAR"){
							echo "<td>$r[jml_latih_max]</td>";
							}elseif($r['tipe']=="UNLIMITED"){
							echo "<td>UNLIMITED</td>";
							}
							echo "<td>$r[jml_bulan] Bulan</td>
                            <td>Rp.".number_format($r['tarif'],0,',','.').",-</td>
                            ";
							echo"<td align='center'><a href=?modul=tarif&aksi=edittarif&id=$r[id_tarif]>Ubah</td>";
echo"<td align='center'><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href=?modul=tarif&aksi=hapus&id=$r[id_tarif]>Hapus</td>";
							echo "</tr>";
							
                      $no++;
                    }                    
                    echo "
                </tbody>
         </table>";
/*echo '<center>';
 
echo"<table id='tabel' style='width:700px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td>Kode Tarif</td>
<td>Jenis Tarif</td>
<td>Jumlah Bulan</td>
<td>Tarif</td>";
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
echo"<td align='center'><span style='font-size:20pt;'>".$tampil['kode_tarif']."</span></td>";
echo"<td align='center'><span style='font-size:20pt;'>".$tampil['jenis_tarif']."</span></td>";
echo"<td align='center'><span style='font-size:20pt;'>".$tampil['jml_bulan']." Bulan</span></td>";
echo"<td align='center'><span style='font-size:20pt;'>Rp.".number_format($tampil['tarif'],2,',','.').",-</span></td>";
 if ($_SESSION['levelmembership']=="member"){
 }else{
echo"<td align='center'><a href=?modul=tarif&aksi=edittarif&id=$tampil[id_tarif]>Ubah</td>";
echo"<td align='center'><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href=?modul=tarif&aksi=hapus&id=$tampil[id_tarif]>Hapus</td>";
}
$baris++;}
echo"</tr>";
echo"</table></center>";*/
break;

case "tambahtarif":
echo"<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
echo"</table>";
echo '<div class="container2">';

	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=tarif&aksi=input">';
echo '<div id="papanpanel2">
	<h3>Tambah Data tarif</h3>
	</div>  ';
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
?>
       
        <div id="tickets">
            <ul>
			 <li>
                    <label for="kode_tarif" class="required">Kode Paket</label>
                    <input type="text" size="30" maxlength="10" id="kode_tarif" name="kode_tarif" class="k-textbox" placeholder="Masukkan Kode Tarif" required validationMessage="Mohon Kode Tarif"/>
                </li>
				<li>
                    <label for="jenis_tarif" class="required">Jenis/Nama Paket</label>
                    <input type="text" size="30" maxlength="30" id="jenis_tarif" name="jenis_tarif" class="k-textbox" placeholder="Masukkan jenis tarif" required validationMessage="Mohon Masukkan jenis tarif" />
                </li>
				<li>
                    <label for="tipe" class="required">Tipe Tarif</label>
                     <select id="tipe" name="tipe">
					 <?php 
					 echo "<option value='REGULAR'>REGULAR</option>";
					 echo "<option value='UNLIMITED'>UNLIMITED</option>";	 
                ?>
            </select>
                </li>
				<li>
                    <label for="jml_latih_max" class="required">Jumlah Latih Max</label>
                    <input type="text" size="30" style="width:300px" maxlength="30" id="jml_latih_max" name="jml_latih_max" class="k-textbox" placeholder="Batas Jumlah Latihan Maksimum" required validationMessage="Masukkan Jumlah" />Isi 0 jika tipe UNLIMITED
                </li>
                <li>
                    <label for="tarif" class="required">Tarif Paket</label>
                    <input type="text" size="30" maxlength="20" id="tarif" name="tarif" class="k-textbox" placeholder="Masukkan tarif" required validationMessage="Mohon Masukkan tarif" />
                </li>
				  <li>
                    <label for="jml_bulan" class="required">Jumlah Bulan</label>
                     <select id="jml_bulan" name="jml_bulan">
					 <?php
					  echo "<option value=''>----- Pilih Bulan -------</option>";
					 echo "<option value='1'>1 Bulan</option>";
					 echo "<option value='2'>2 Bulan</option>";
					 echo "<option value='3'>3 Bulan</option>";
					 echo "<option value='4'>4 Bulan</option>";
					 echo "<option value='5'>5 Bulan</option>";
					 echo "<option value='6'>6 Bulan</option>";
					 echo "<option value='7'>7 Bulan</option>";
					 echo "<option value='8'>8 Bulan</option>";
					 echo "<option value='9'>9 Bulan</option>";
					 echo "<option value='10'>10 Bulan</option>";
					 echo "<option value='11'>11 Bulan</option>";
					  echo "<option value='12'>12 Bulan</option>";
					 
                ?>
            </select>
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
                    height: 523px;
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
                    $("#jml_bulan").kendoDropDownList();
                    $("#tipe").kendoDropDownList();
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

break;

case "edittarif":
echo"<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
echo"</table>";
echo '<div class="container2">';

	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=tarif&aksi=update">';
echo '<div id="papanpanel2">
	<h3>Edit Data tarif</h3>
	</div>  ';
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$db="select * from tbl_tarif where id_tarif='$_GET[id]'";
$qri=mysqli_query($conn,$db);
$row=mysqli_fetch_array($qri);
?>
       
        <div id="tickets">
            <ul>
			 <li>
                    <label for="kode_tarif" class="required">Kode Paket</label>
                    <input type="text" size="30" maxlength="10" readonly id="kode_tarif" name="kode_tarif" value="<?php echo "$row[kode_tarif]"; ?>" class="k-textbox" placeholder="Masukkan Kode Tarif" required validationMessage="Mohon Kode Tarif"/>
					<input type="hidden" size="30" maxlength="10" id="id_tarif" name="id_tarif" value="<?php echo "$row[id_tarif]"; ?>"/>
                </li>
				<li>
                    <label for="jenis_tarif" class="required">Jenis/Nama Paket</label>
                    <input type="text" size="30" maxlength="30" id="jenis_tarif" name="jenis_tarif" value="<?php echo "$row[jenis_tarif]"; ?>" class="k-textbox" placeholder="Masukkan jenis tarif" required validationMessage="Mohon Masukkan jenis tarif" />
                </li>
				<li>
                    <label for="tipe" class="required">Tipe Tarif</label>
                     <select id="tipe" name="tipe">
					 <?php 
					  echo "<option value='$row[tipe]'>$row[tipe]</option>";
					 echo "<option value='REGULAR'>REGULAR</option>";
					 echo "<option value='UNLIMITED'>UNLIMITED</option>";	 
                ?>
            </select>
                </li>
				<li>
                    <label for="jml_latih_max" class="required">Jumlah Latih Max</label>
                    <input type="text" size="30" style="width:300px" maxlength="30" id="jml_latih_max" value="<?php echo "$row[jml_latih_max]"; ?>" name="jml_latih_max" class="k-textbox" placeholder="Batas Jumlah Latihan Maksimum" required validationMessage="Masukkan Jumlah" />
                </li>
                <li>
                    <label for="tarif" class="required">Tarif Paket</label>
                    <input type="text" size="30" maxlength="20" id="tarif" name="tarif" value="<?php echo "$row[tarif]"; ?>" class="k-textbox" placeholder="Masukkan tarif" required validationMessage="Mohon Masukkan tarif" />
                </li>
				 <li>
                    <label for="jml_bulan" class="required">Jumlah Bulan</label>
                     <select id="jml_bulan" name="jml_bulan">
					 <?php
					 echo "<option value='$row[jml_bulan]'>$row[jml_bulan] Bulan</option>";
					  echo "<option value=''>----- Pilih Bulan -------</option>";
					 echo "<option value='1'>1 Bulan</option>";
					 echo "<option value='2'>2 Bulan</option>";
					 echo "<option value='3'>3 Bulan</option>";
					 echo "<option value='4'>4 Bulan</option>";
					 echo "<option value='5'>5 Bulan</option>";
					 echo "<option value='6'>6 Bulan</option>";
					 echo "<option value='7'>7 Bulan</option>";
					 echo "<option value='8'>8 Bulan</option>";
					 echo "<option value='9'>9 Bulan</option>";
					 echo "<option value='10'>10 Bulan</option>";
					 echo "<option value='11'>11 Bulan</option>";
					  echo "<option value='12'>12 Bulan</option>";
					 
                ?>
            </select>
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
                    height: 523px;
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
                    $("#jml_bulan").kendoDropDownList();
                    $("#tipe").kendoDropDownList();
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

break;

case "hapus":
mysqli_query($conn,"DELETE FROM tbl_tarif WHERE id_tarif='$_GET[id]'");
	echo '<script>setTimeout(\'location.href="?modul=tarif&aksi=tampil"\' ,0);</script>';
break;

case "input":

$query=mysqli_query($conn,"select * from tbl_tarif where kode_tarif = '$_POST[kode_tarif]'");
$tampil=mysqli_fetch_row($query);
if ($tampil>0){
echo '<script>alert(\'Data Dengan Kode Paket ini Sudah Ada . . !\')
	setTimeout(\'location.href="?modul=tarif&aksi=tambahtarif"\' ,0);</script>';
}

else{

	//echo"ukuran File Anda : $ukuran "."Byte</br>";
	//echo" File Disimpan di ".$tujuan;
	//echo "</br></br>$tes";
		if($_POST['tipe']=="UNLIMITED"){
		$jmllatih = 0;
		}elseif($_POST['tipe']=="REGULAR"){
			$jmllatih = $_POST['jml_latih_max'];
		}
		$sql = mysqli_query($conn,"INSERT INTO tbl_tarif VALUES(
						NULL,
						'$_POST[kode_tarif]',
						'$_POST[jenis_tarif]',
						'$_POST[tipe]',
						'$jmllatih',
						'$_POST[jml_bulan]',
						$_POST[tarif]
						)"); 		
						
		if (!$sql)
		{
		echo mysqli_error();
		echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
		
		}else
		{
		echo '<script>alert(\'Data Berhasil Dimasukkan.\')
			setTimeout(\'location.href="?modul=tarif&aksi=tampil"\' ,0);</script>';
		}	 
	}
break;

//UPDATE 
case "update":
mysqli_query($conn,"UPDATE tbl_tarif SET kode_tarif='$_POST[kode_tarif]',
jenis_tarif='$_POST[jenis_tarif]',
jml_bulan='$_POST[jml_bulan]',
                                tarif=$_POST[tarif]		
			where id_tarif='$_POST[id_tarif]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=tarif&aksi=tampil"\' ,0);</script>';
break;
}


?>