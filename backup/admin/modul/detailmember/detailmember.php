<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
if(!isset($_GET['id'])){
echo '<script>alert(\'Instrukti Tidak Sah !\')
setTimeout(\'location.href="?modul=pasien&aksi=tampil"\' ,0);</script>';
}else{
	function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
		$BulanIndo = array("Januari", "Februari", "Maret",
						   "April", "Mei", "Juni",
						   "Juli", "Agustus", "September",
						   "Oktober", "November", "Desember");
	
		$tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
		$bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
		$tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
		
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return($result);
}       
echo"<center><h1>Detail Paket</h1></center>";



/*echo"<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
echo"<tr>
<td align=center><i>Data Berlaku Member Akan Berubah Setelah Pembayaran Iyuran Transaksi Dikonfirmasi Oleh Admin / Kontrol Transaksi. Klik Tambah/Aktifasi Untuk memulai proses iyuran transaksi</i></td>
</tr>";
echo"</table>";*/
 echo '
		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                       
						<th>Kode Tarif (Paket)</th>
					
						<th>Deposit Terakhir</th>
						<th>Berlaku s/d</th>
						<th>KUOTA LATIH</th>
						<th>Absen Latihan</td>
						<th>Tambah/Aktivasi</td>
						
                    </tr>
                </thead>
                <tbody>';
                                 			  
					          $sql = mysqli_query($conn,"SELECT * FROM tbl_tarif ORDER BY kode_tarif");
							  
					          $no = 1;
                    while ($r = mysqli_fetch_array($sql)) {
                      echo "<tr>
                            <td width=20>$no</td>
                           
                       <td>$r[kode_tarif] ($r[jenis_tarif])</td>
					   
							";
							$tampil_member =  mysqli_fetch_array(mysqli_query($conn,"select * from tbl_member,tbl_deposit where tbl_deposit.id_member = tbl_member.id_member and tbl_deposit.id_member = '$_GET[id]' and tbl_deposit.kode_tarif = '$r[kode_tarif]'"));
							date_default_timezone_set('Asia/Jakarta');
$tanggal1= mktime(date("m"),date("d"),date("Y"));
$tglsekarang1 = date("Y-m-d", $tanggal1);
$pecah2 = explode("-", $tglsekarang1);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
$sekarang2 = GregorianToJD($month2, $date2, $year2);
$valid2 = $tampil_member['tanggal_berlaku'];
$pecah3 = explode("-", $valid2);
$date3= $pecah3[2];
$month3 = $pecah3[1];
$year3 = $pecah3[0];
$valid3 = GregorianToJD($month3, $date3, $year3);
$selisih2 = $valid3 - $sekarang2;
if($selisih2 < 0 || ($r['tipe']=="REGULAR" && $tampil_member['kuota_latihan']==0))
{echo "<td><div style='color:red; font-weight:bold'>NONAKTIF</div></td>";
}else{
$pecah2 = explode("-", $tampil_member['tanggal_deposit']);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];

							echo "
							<td>".DateToIndo($tampil_member['tanggal_deposit'])."</td>
							";
							}
							date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$pecah1 = explode("-", $tglsekarang);
$date1 = $pecah1[2];
$month1 = $pecah1[1];
$year1 = $pecah1[0];
$sekarang = GregorianToJD($month1, $date1, $year1);
$valid = $tampil_member['tanggal_berlaku'];
$pecah2 = explode("-", $valid);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
$valid2 = GregorianToJD($month2, $date2, $year2);
$selisih = $valid2 - $sekarang;
if($selisih < 0 || ($r['tipe']=="REGULAR" && $tampil_member['kuota_latihan']==0))
{echo "<td><div style='color:red; font-weight:bold'>NONAKTIF</div></td>";
}else{
							echo "<td>".DateToIndo($tampil_member['tanggal_berlaku'])."</td>";

							}
							if($selisih < 0 || ($r['tipe']=="REGULAR" && $tampil_member['kuota_latihan']==0))
							{echo "<td><div style='color:red; font-weight:bold'>NONAKTIF</div></td>";
							}else{
							if($r['tipe']=="REGULAR"){
							echo "<td>$tampil_member[kuota_latihan]</td>";
							}else{
								echo "<td>UNLIMITED</td>";
							}
							}
							if($selisih < 0 || ($r['tipe']=="REGULAR" && $tampil_member['kuota_latihan']==0)){
								echo "<td><div style='color:red; font-weight:bold'>NONAKTIF</div></td>";
							}else{
							echo "<td><a href='?modul=tambahdeposit&aksi=tambahlatihan&id=".$_GET['id']."&kd=".$r['kode_tarif']."'>Absen Latihan</td>";
							}
							echo "<td><a href='?modul=tambahdeposit&aksi=tambahdeposit&id=".$_GET['id']."&kd=".$r['kode_tarif']."'>Tambah/Aktivasi</td>";
							echo "	
                         </tr>";
							
                      $no++;
                    }                    
                    echo "
                </tbody>
         </table></br>";
$query0=mysqli_query($conn,"select * from tbl_member where id_member='$_GET[id]'");
echo"<center><table border='0' style='border-collapse:collapse;width:500px; color:white; font-size:9px; background-color:grey' id='tabel'>";

$baris0=1;
while($tampil0=mysqli_fetch_array($query0)){ 
echo"<tr><td style='padding:5px' colspan='2' align='center'>";
  if (file_exists("images/member/$tampil0[id_member].jpg")) {
	  echo '<img width="100px"  src="images/member/'.$tampil0['id_member'].'.jpg"/>';
  }else{
	  echo '<img width="100px"  src="images/member/def.png"/>';
  }
	 
echo"</td></tr>";

echo"<tr><td width='30%'>ID MEMBER</td><td>$tampil0[id_member]</td></tr>";
echo"<tr><td>Nama</td><td>$tampil0[username]</td></tr>";
echo"<tr><td>Jenis Kelamin</td><td>$tampil0[jenis_kelamin]</td></tr>";
echo"<tr><td>Tanggal Lahir</td><td>$tampil0[tanggal_lahir]</td></tr>";
echo"<tr><td>Alamat</td><td>$tampil0[alamat]</td></tr>";
echo"<tr><td>Pekerjaan </td><td>$tampil0[pekerjaan]</td></tr>";
echo"<tr><td>Tanggal Daftar</td><td>$tampil0[tanggal_daftar]</td></tr>";
echo"<tr><td>No Telepon</td><td>$tampil0[tel]</td></tr>";
$baris0++;}
echo"</tr>";
echo"</table></br><a href='?modul=member&aksi=editmember&id=$_GET[id]' class='button'>Ubah Data</a><a href='javascript:self.history.back()' class='button button-red'>Kembali</a></center></br></br>";

}
break;

//INTERFACE TAMBAH

//INTERFACE EDITUSER
case "editmyprofile":
$db="select * from login where user='$_GET[id]'";
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
	  echo '<img width="50px"  src="images/user/resize.php?src=def.jpg&scale=100&q=100"/>';
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
$cekpass = mysqli_fetch_array(mysqli_query($conn,"select password from login where user = '$_POST[user]'"));
$sql = mysqli_query($conn,"UPDATE login SET user = '$_POST[user]',
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