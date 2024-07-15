<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
if($_POST['submit']=="Update")
{
	$pagetype=$_GET['type'];
	$pagedetails=$_POST['pgedetails'];
$sql = mysqli_query($conn,"UPDATE tblpages SET detail='$pagedetails' WHERE type='$pagetype'");
$msg='<script>alert(\'Halaman Berhasil Diedit\');</script>';
}
?>
	<h1>Manage Halaman </h1>
	<div style="text-align:center; background-color:#FFFFFF; width:50%'">
					
					

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									
									<div class="panel-body">
									<script>
									function MM_jumpMenu(targ,selObj,restore){ //v3.0
									eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
									if (restore) selObj.selectedIndex=0;
									}
									</script>
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo $msg; ?> </div><?php }?>
											<div class="form-group">
												<div class="col-sm-8">
															   <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
                  <option value="" selected="selected" class="form-control">*** Pilih Halaman ***</option>
                  <option value="index.php?modul=web_halaman&aksi=tampil&type=panduan">Panduan Pebayaran</option>
                  <option value="index.php?modul=web_halaman&aksi=tampil&type=privacy">privacy and policy</option>
                  <option value="index.php?modul=web_halaman&aksi=tampil&type=aboutus">aboutus</option> 
                  <option value="index.php?modul=web_halaman&aksi=tampil&type=faqs">FAQs</option>
                </select>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
											<div class="form-group">
												
												<div class="col-sm-8">
						<?php
			
			switch($_GET['type'])
			{
				case "panduan" :
									echo "Panduan Pembayaran";
									break;
				
				case "privacy" :
									echo "Privacy And Policy";
									break;
				
				case "aboutus" :
									echo "About US";
									break;
			
				case "faqs" :
									echo "FAQs";
									break;
											
				default :
								echo "";
								break;
			
			}
			
			?>
												</div>
											</div>
								<script type="text/javascript" src="js/nicEdit.js"></script>
	<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	</script>
									<div class="form-group">
												
												<div class="col-sm-8">
			<center><textarea class="form-control" rows="5" cols="60" name="pgedetails" id="pgedetails" placeholder="Package Details" required>
										<?php 
$pagetype=$_GET['type'];
$sql = "SELECT detail from tblpages where type='$pagetype'";

$query = mysqli_query($conn,$sql);

$cnt=1;
if(mysqli_num_rows($query) > 0)
{
while($result=mysqli_fetch_array($query))
{  		
echo htmlentities($result['detail']);
}
}
?>

										</textarea> </center>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
												<button type="submit" name="submit" value="Update" id="submit" class="btn-primary btn">Update</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
<?php
break;

//INTERFACE TAMBAH
case "tambahuser":

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
echo '<div class="container2">';

	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=user&aksi=input">';
echo '<div id="papanpanel2">
	<h3>Tambah Data User</h3>
	</div>  ';
echo '
<div class="field">
	<label for="name">Username :</label>
  	<input type="text" class="input" name="user"/>
	<p class="hint">Masukkan Username Anda</p>
</div>

<div class="field">
	<label for="email">Password :</label>
  	<input type="password" class="input" name="password" id="password" />
	<p class="hint">Masukkan Password Anda</p>
</div>

<div class="field">
	<label for="message">Nama :</label>
	<input type="text" class="input" name="nama" id="nama" />
	<p class="hint">Masukkan Nama Anda</p>
</div>

<div class="field">
	<label for="message">Level :</label>
	<select name="level">
	<option value="admin">Admin</option>

	</select>
	<p class="hint">Pilih Level Anda</p>
</div>

<div class="field">
	<label for="message">Alamat :</label>
  	<textarea class="input textarea" name="alamat" id="alamat"></textarea>
	<p class="hint">Masukkan Alamat Anda</p>
</div>



<div class="field">
	<label for="message">Kota :</label>
	<input type="text" class="input" name="kota" id="kota" />
	<p class="hint">Masukkan Kota Tempat Tinggal Anda</p>
</div>

<div class="field">
	<label for="message">Kode Pos :</label>
	<input type="text" class="input" name="kode_pos" id="kode_pos" />
	<p class="hint">Masukkan Kode Pos Tempat Tinggal Anda</p>
</div>

<div class="field">
	<label for="message">No Telepon :</label>
	<input type="text" class="input" name="no_telp" id="no_telp" />
	<p class="hint">Masukkan No Telepon Anda</p>
</div>

<div class="field">
	<label for="message">Tempat Lahir :</label>
	<input type="text" class="input" name="tempat_lahir" id="tempat_lahir" />
	<p class="hint">Masukkan Tempat Lahir Anda</p>
</div>

<div class="field">
	<label for="message">Tanggal Lahir :</label>
	<input type="date" class="input" name="tanggal_lahir" id="tanggal_lahir" />
	<p class="hint">Masukkan Tanggal Lahir Anda</p>
</div>

<div class="field">
	<label for="message">Upload Foto :</label>
	<input type="file" name="berkas"/>
	<p class="hint">Masukkan Foto Anda</p>
</div>



<div class="field">
	<label for="message">:</label>
	<input type="submit" name="Submit"  class="button" value="Save" /><input type="button" class="button button-red" onclick="self.history.back()"  value="Cancel"/>
	<p class="hint">Tekan Untuk Input / Batal</p>
</div>

</form>
</div>';
break;

//INTERFACE EDITUSER
case "edituser":
$db="select * from tbl_login where user='$_GET[id]'";
$qri=mysqli_query($conn,$db);
$row=mysqli_fetch_array($qri);

$tanggal_lahir = $row['tanggal_lahir'];

echo '<div class="container2">';

	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=user&aksi=update">';
echo '<div id="papanpanel2">
	<h3>Edit Data User</h3>
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
                    <label for="nama" class="required">Level</label>
                   <select name="level" id="level">
				   <option value="<?php echo "$row[level]"; ?>"><?php echo "$row[level]"; ?></option>
	
	<option value="admin">Admin</option>

	</select>
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
mysqli_query($conn,"DELETE FROM tbl_login WHERE user='$_GET[id]'");
	echo '<script>setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
	error_reporting(0);
	unlink("images/user/$_GET[id].jpg");
break;

//INPUT
case "input":
$querycek=mysqli_query($conn,"select * from tbl_login where user = '$_POST[user]'");
$tampilcek=mysqli_fetch_array($querycek);
if (empty($_POST['user']) or empty($_POST['password']))
{
echo"<p>Username Dan Password Harus Diisi !<input type='button' onclick=self.history.back() value='back'/>";

}
elseif ($tampilcek['user'] == $_POST['user']){
echo '<script>alert(\'Username Sudah Ada ! !\')
	setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
}
Else
{	error_reporting(0);
$maxUp=3000000;
$extensionList = array("bmp", "jpg", "gif");
$error = $_FILES['berkas']['error'];//error
$nama_file = $_FILES['berkas']['name'];//Name
$ukuran = $_FILES['berkas']['size'];//Size Byte
$temp = $_FILES['berkas']['tmp_name'];//Temporary
if ($ukuran>$maxUp) {
echo "<script>
	alert('Ukuran File Foto Terlalu Besar, Maximal 3 mb!');
	</script>";
	echo '<script>setTimeout(\'location.href="?modul=user&aksi=tambahuser"\' ,0);</script>';
}elseif ((exif_imagetype($temp) != IMAGETYPE_JPEG) && (!empty($temp))) {
echo "<script>
	alert('Format Foto Salah !!');
	</script>";
	echo '<script>setTimeout(\'location.href="?modul=user&aksi=tambahuser"\' ,0);</script>';
}
elseif (file_exists($tujuan)){
	echo $nama_file ." sudah ada , ganti dengan file lainnya";
	}
else{
$nama = str_replace("'", "''",$_POST['nama']);
		$tempat_lahir = str_replace("'", "''",$_POST['tempat_lahir']);
		$alamat = str_replace("'", "''",$_POST['alamat']);	
  $sql = mysqli_query($conn,"INSERT INTO tbl_login VALUES('$_POST[user]','$_POST[password]','$nama','$_POST[level]','$alamat','$_POST[kota]','$_POST[kode_pos]','$_POST[no_telp]','$tempat_lahir','$_POST[tanggal_lahir]')"); 	  
if (!$sql)
		{
		echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
		}else
		{
$tes = $_POST['user'];
$newfilename="$tes"."."."jpg";
$tujuan = "images/user/".$newfilename;//destination
$default = "images/user/def.jpg";
$gambar = "images/user/".$newfilename;
if ($nama_file == ""){
}else{
	move_uploaded_file($temp,$tujuan);
	}
		echo '<script>alert(\'Data Berhasil Dimasukkan\')
			setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
		}	 
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
	echo '<script>setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
}else{
$cekpass = mysqli_fetch_array(mysqli_query($conn,"select password from tbl_login where user = '$_POST[user]'"));
$sql = mysqli_query($conn,"UPDATE tbl_login SET user = '$_POST[user]',
password = '$_POST[password]',
nama = '$_POST[nama]',
level='$_POST[level]',
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
	setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
	}else{
	echo '<script>alert(\'Gagal Mengedit !\')
setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
	}
	}
}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>