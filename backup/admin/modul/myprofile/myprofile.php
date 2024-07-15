<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
if(!isset($_GET['id'])){
echo '<script>alert(\'Instrukti Tidak Sah !\')
setTimeout(\'location.href="?modul=pasien&aksi=tampil"\' ,0);</script>';
}else{

$query0=mysqli_query($conn,"select * from tbl_login where user='$_GET[id]'");
echo"<center><table border='0' style='border-collapse:collapse;width:500px; color:white; font-size:9px; background-color:grey' id='tabel'>";

$baris0=1;
while($tampil0=mysqli_fetch_array($query0)){ 
echo"<tr><td style='padding:5px' colspan='2' align='center'>";
 if (file_exists("images/user/$_SESSION[adminmembership].jpg")) {
	  echo '<img width="100px"  src="images/user/def.png"/>';
	  }else
	  {
	  echo '<img width="100px"  src="images/user/def.png"/>';
	  }
echo"</td></tr>";
echo"<tr><td width='30%'>Username tbl_login</td><td>$tampil0[user]</td></tr>";
echo"<tr><td>Password tbl_login</td><td>$tampil0[password]</td></tr>";
echo"<tr><td>Nama</td><td>$tampil0[nama]</td></tr>";
echo"<tr><td>Tanggal Lahir</td><td>$tampil0[tanggal_lahir]</td></tr>";
echo"<tr><td>Alamat</td><td>$tampil0[alamat]</td></tr>";
echo"<tr><td>No Telepon</td><td>$tampil0[no_telp]</td></tr>";
$baris0++;}
echo"</tr>";
echo"</table></br><a href='index.php?modul=myprofile&aksi=editmyprofile&id=$_SESSION[adminmembership]' class='button'>Ubah Data</a></center></br></br>";
}
break;

//INTERFACE TAMBAH
case "tambahriwayat":
if(!isset($_GET['id'])){
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
                    <input type="text" size="30" id="id_pasien" name="id_pasien" class="k-textbox" value="<?php echo "$_GET[id]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
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
case "editmyprofile":
$db="select * from tbl_login where user='$_GET[id]'";
$qri=mysqli_query($conn,$db);
$row=mysqli_fetch_array($qri);

$tanggal_lahir = $row['tanggal_lahir'];

echo '<div class="container2">';

	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=myprofile&aksi=update">';
echo '<div id="papanpanel2">
	<h3>Edit My Profile</h3>
	</div>  ';
?>
       
        <div id="tickets">
            <ul>
			 <li>
                    <label for="user" class="required">Username</label>
                    <input type="text" size="30" id="user" name="user" class="k-textbox" value="<?php echo "$row[user]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
                <li>
                    <label for="password" class="required">Password</label>
                    <input type="text" size="30" maxlength="10" id="password" name="password" value="<?php echo "$row[password]"; ?>" class="k-textbox" placeholder="Masukkan Password" required validationMessage="Mohon Masukkan Nama Password" />
                </li>
				<li>
                    <label for="nama" class="required">Nama</label>
                    <input type="text" size="30" maxlength="40" id="nama" name="nama" value="<?php echo "$row[nama]"; ?>" class="k-textbox" placeholder="Masukkan Nama" required validationMessage="Mohon Masukkan Nama" />
                </li>
				<li>
                    <label for="alamat" class="required">Alamat</label>
                    <textarea name="alamat" rows="4" id="alamat" class="k-textbox" placeholder="Isi Alamat" required validationMessage="Please enter {0}">
					<?php echo "$row[alamat]"; ?></textarea>
                </li>
				<li>
                    <label for="kota" class="required">Kota</label>
                    <input type="text" size="30" maxlength="40" id="kota" name="kota" value="<?php echo "$row[kota]"; ?>" class="k-textbox" placeholder="Masukkan Kota" required validationMessage="Mohon Masukkan Kota" />
                </li>
				<li>
                    <label for="kode_pos" class="required">Kode Pos</label>
                    <input type="text" size="30" maxlength="40" id="kode_pos" name="kode_pos" value="<?php echo "$row[kode_pos]"; ?>" class="k-textbox" placeholder="Masukkan Kode Pos" required validationMessage="Mohon Masukkan Kode Pos" />
                </li>
				<li>
                    <label for="tempat_lahir" class="required">Tempat Lahir</label>
                    <input type="text" size="30" maxlength="40" id="tempat_lahir" name="tempat_lahir" value="<?php echo "$row[tempat_lahir]"; ?>" class="k-textbox" placeholder="Masukkan Tempat Lahir" required validationMessage="Mohon Masukkan Tempat Lahir" />
                </li>
				  <li>
                    <label for="nama" class="required">Tanggal Lahir</label>
                    <input type="date" size="30" maxlength="40" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo "$tanggal_lahir"; ?>" class="k-textbox" placeholder="Tanggal Lahir" required validationMessage="Mohon Masukkan Tanggal Lahir Pasien" /></br><span style="padding-left:130px">Format Tanggal adalah DD/MM/YYYY ex:05/25/1990</span>
					 <!--<script>
            $(document).ready(function() {
                // create DatePicker from input HTML element
                $("#tanggal_lahir").kendoDatePicker();
            });
        </script>-->
                </li>
				<li>
                    <label for="no_telp" class="required">No Tepon</label>
                    <input type="text" id="no_telp" name="no_telp" class="k-textbox" value="<?php echo "$row[no_telp]"; ?>" placeholder="Masukkan No Telepon" required validationMessage="Masukkan No Telp !!"/>
						</li>
				<li>
                    <label for="berkas" class="required">Foto</label>
                   <?php 
				   if (file_exists("images/user/$row[user].jpg")) {
	  echo '<img width="50px"  src="images/user/resize.php?src='.$row['user'].'.jpg&scale=100&q=100"/>';
	  }else
	  {
	  echo '<img width="50px"  src="images/user/def.png"/>';
	  }
				   ?>
                </li>
				<li>
                    <label for="berkas" class="required">Ubah Foto</label>
                    <input type="file" size="30" maxlength="40" id="berkas" name="berkas" class="k-textbox"/>
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
                    height: 593px;
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
                            status.text("Complete...!!!").addClass("valid");
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
break;

//HAPUS
case "hapus":
mysqli_query($conn,"DELETE FROM tbl_riwayat WHERE id_riwayat='$_GET[id_riwayat]'");
	echo '<script>setTimeout(\'location.href="?modul=riwayat&aksi=tampil&id_pasien='.$_GET['id'].'"\' ,0);</script>';
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
error_reporting(0);
$maxUp=3000000;
$extensionList = array("bmp", "jpg", "gif");
$error = $_FILES['berkas']['error'];//error
$nama_file = $_FILES['berkas']['name'];//Name
/* New File Name */
$newname = substr( $nama_file , -3 );
$newname2 = substr( $nama_file , +3 );
$pecah = explode(".", $nama_file);
$ekstensi = $pecah[1];
$ukuran = $_FILES['berkas']['size'];//Size Byte
$temp = $_FILES['berkas']['tmp_name'];//Temporary
$tipe_data= $_FILES['berkas']['type'];//Type data
$extension=end(explode(".", $nama_file));
if ($ukuran>$maxUp) {
echo "<script>
	alert('Ukuran File Foto Terlalu Besar, Maximal 3 mb!');
	</script>";
	echo '<script>setTimeout(\'location.href="?modul=myprofile&aksi=tampil&id='.$_POST['user'].'"\' ,0);</script>';
}else{
$cekpass = mysqli_fetch_array(mysqli_query($conn,"select password from tbl_login where user = '$_POST[user]'"));
$sql = mysqli_query($conn,"UPDATE tbl_login SET user = '$_POST[user]',
password = '$_POST[password]',
nama = '$_POST[nama]',
alamat='$_POST[alamat]',
kota = '$_POST[kota]',
kode_pos = '$_POST[kode_pos]',
no_telp = '$_POST[no_telp]',
tempat_lahir = '$_POST[tempat_lahir]',
tanggal_lahir = '$_POST[tanggal_lahir]'
where user='$_POST[user]'");
if($sql){
$tes = $_POST['user'];
$newfilename="$tes"."."."jpg";
$tujuan = "images/user/".$newfilename;//destination
	move_uploaded_file($temp,$tujuan);
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=myprofile&aksi=tampil&id='.$_POST['user'].'"\' ,0);</script>';
	}else{
	echo '<script>alert(\'Gagal Mengedit !\')
setTimeout(\'location.href="?modul=myprofile&aksi=tampil&id='.$_POST['user'].'"\' ,0);</script>';
	}
	}
break;


}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>