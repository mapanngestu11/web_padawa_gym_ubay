<?php
switch ($_GET['aksi']) {
        //INTERFACE TABLE BROWSER
    case "tampil";

        echo '

<a href="index.php?modul=trainer&aksi=tambahtrainer" class="button">Tambah Data Trainer</a></br></br>';

        echo '
		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Trainer</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
						<th>Ubah</th>
						<th>Hapus</th>
                    </tr>
                </thead>
                <tbody>';

        $sql = mysqli_query($conn, "SELECT * FROM tbl_trainer ORDER BY id_trainer");

        $no = 1;
        while ($r = mysqli_fetch_array($sql)) {
            echo "<tr>
                            <td width=20>$no</td>
                            <td>$r[id_trainer]</td>
                            <td>$r[nama]</td>
							<td>$r[jenis_kelamin]</td>
							<td>$r[tanggal_lahir]</td>
							<td>$r[alamat]</td>
							<td>$r[tel]</td>
						
                          
							";
            date_default_timezone_set('Asia/Jakarta');
            $tanggal1 = mktime(date("m"), date("d"), date("Y"));
            $tglsekarang1 = date("Y-m-d", $tanggal1);

            echo "
							<td><a href='?modul=trainer&aksi=edittrainer&id=" . $r['id_trainer'] . "'>Ubah</td>
<td><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=trainer&aksi=hapus&id=" . $r['id_trainer'] . "'>Hapus</td>";

            echo "
                            </tr>";

            $no++;
        }
        echo "
                </tbody>
         </table>";
        break;

        //INTERFACE TAMBAH
    case "tambahtrainer":

        echo '<div class="container2">';

        echo '
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=trainer&aksi=input">';
        echo '<div id="papanpanel2">
	<h3>Tambah Data Trainer</h3>
	</div>  ';
        $qr    = mysqli_query($conn, "SELECT MAX(CONCAT(LPAD((RIGHT((id_trainer),7)+1),7,'0')))FROM tbl_trainer");
        $qr2    = mysqli_query($conn, "SELECT MIN(CONCAT(LPAD((RIGHT((id_trainer),7)),7,'0')))FROM tbl_trainer");
        $kde = mysqli_fetch_array($qr);
        $kde2 = mysqli_fetch_array($qr2);
        if ($kde2[0] != "0000001") {
            $kodea = "0000001";
        } else {
            $kodea = $kde[0];
        }

        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
?>

        <div id="tickets">
            <ul>
                <li>
                    <label for="id_trainer" class="required">ID Trainer</label>
                    <input type="text" size="30" id="id_trainer" name="id_trainer" class="k-textbox" value="<?php echo "TRN$kodea"; ?>" readonly="readonly" style="background:transparent; color:GREY" />
                </li>
                <li>
                    <label for="nama" class="required">Tanggal Daftar</label>
                    <input type="date" size="30" maxlength="40" id="tanggal_daftar" name="tanggal_daftar" class="form-control" placeholder="Tanggal Daftar" required validationMessage="Mohon Masukkan Tanggal Daftar Trainer" /></br><span style="padding-left:130px">Format Tanggal adalah DD/MM/YYYY ex:05/25/1990</span>
                </li>
                <li>
                    <label for="nama" class="required">Nama Trainer</label>
                    <input type="text" size="30" maxlength="40" id="nama" name="nama" class="k-textbox" placeholder="Masukkan Nama" required validationMessage="Mohon Masukkan Nama Trainer" />
                </li>
                <li>
                    <label for="nama" class="required">Tanggal Lahir</label>
                    <input type="date" size="30" maxlength="40" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" required validationMessage="Mohon Masukkan Tanggal Lahir" /></br><span style="padding-left:130px">Format Tanggal adalah DD/MM/YYYY ex:05/25/1990</span>
                </li>
                <li>
                    <label for="alamat" class="required">Alamat</label>
                    <textarea name="alamat" id="alamat" class="k-textbox" placeholder="Isi Alamat" required validationMessage="Please enter {0}"></textarea>
                </li>
                <li>
                    <label for="jenis_kelamin" class="required">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin">
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </li>
                <li>
                    <label for="tel" class="required">Phone</label>
                    <input type="tel" id="tel" name="tel" class="k-textbox" placeholder="Masukkan No Telepon" required validationMessage="Masukkan No Telp !!" />
                </li>
                <li>
                    <label for="tel" class="required">Upload Foto</label>
                    <input type="file" name="berkas" />
                </li>
                <li class="accept">
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
                height: auto;
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

            .accept,
            .status {
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
        <script>
            $(document).ready(function() {



                $("#bulan").kendoDropDownList();




            });
        </script>

        <script>
            $(document).ready(function() {



                $("#kode_tarif").kendoDropDownList();




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

        //INTERFACE EDITUSER
    case "edittrainer":
        $db = "select * from tbl_trainer where id_trainer='$_GET[id]'";
        $qri = mysqli_query($conn, $db);
        $row = mysqli_fetch_array($qri);

        $tanggal_lahir = $row['tanggal_lahir'];

        $tanggal_daftar = $row['tanggal_daftar'];
        echo '<div class="container2">';

        echo '
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=trainer&aksi=update">';
        echo '<div id="papanpanel2">
	<h3>Edit Data Trainer</h3>
	</div>  ';
    ?>

        <div id="tickets">
            <ul>
                <li>
                    <label for="id_trainer" class="required">ID Trainer</label>
                    <input type="text" size="30" id="id_trainer" name="id_trainer" class="k-textbox" value="<?php echo "$row[id_trainer]"; ?>" readonly="readonly" style="background:transparent; color:GREY" />
                </li>
                <li>
                    <label for="nama" class="required">Tanggal Daftar</label>
                    <input type="date" size="30" maxlength="40" id="tanggal_daftar" name="tanggal_daftar" value="<?php echo "$tanggal_daftar"; ?>" class="form-control" placeholder="Tanggal Daftar" required validationMessage="Mohon Masukkan Tanggal Daftar Trainer" /></br><span style="padding-left:130px">Format Tanggal adalah DD/MM/YYYY ex:05/25/1990</span>
                </li>
                <li>
                    <label for="nama" class="required">Nama Trainer</label>
                    <input type="text" size="30" id="nama" name="nama" value="<?php echo "$row[nama]"; ?>" class="k-textbox" placeholder="Masukkan Nama" required validationMessage="Mohon Masukkan Nama Trainer" />
                </li>
                <li>
                    <label for="nama" class="required">Tanggal Lahir</label>
                    <input type="date" size="30" id="tanggal_daftar" name="tanggal_lahir" value="<?php echo "$tanggal_lahir"; ?>" class="form-control" placeholder="Tanggal Lahir" required validationMessage="Mohon Masukkan Tanggal Lahir Trainer" /></br><span style="padding-left:130px">Format Tanggal adalah DD/MM/YYYY ex:05/25/1990</span>
                </li>
                <li>
                    <label for="alamat" class="required">Alamat</label>
                    <textarea name="alamat" rows="4" id="alamat" class="k-textbox" placeholder="Isi Alamat" required validationMessage="Please enter {0}"><?php echo "$row[alamat]"; ?></textarea>
                </li>
                <li>
                    <label for="jenis_kelamin" class="required">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin">
                        <option value="<?php echo "$row[jenis_kelamin]"; ?>"><?php echo "$row[jenis_kelamin]"; ?></option>
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </li>

                <li>
                    <label for="tel" class="required">Phone</label>
                    <input type="tel" id="tel" name="tel" class="k-textbox" value="<?php echo "$row[tel]"; ?>" placeholder="Masukkan No Telepon" required validationMessage="Masukkan No Telp !!" />
                </li>
                <label for="berkas" class="required">Foto</label>
                <?php
                if (file_exists("images/trainer/$row[id_trainer].jpg")) {
                    echo '<img width="50px"  src="images/trainer/' . $row['id_trainer'] . '.jpg"/>';
                } else {
                    echo '<img width="50px"  src="images/trainer/def.png"/>';
                }
                ?>
                </li>
                <li>
                    <label for="berkas" class="required">Ubah Foto</label>
                    <input type="file" size="30" maxlength="40" id="berkas" name="berkas" class="k-textbox" />
                </li>
                <li class="accept">
                    <button class="k-button" type="submit">Submit</button>&nbsp&nbsp&nbsp<button class="k-button" onclick="self.history.back()" type="button">Batal</button>
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

            .accept,
            .status {
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
        <script>
            $(document).ready(function() {



                $("#deposit").kendoDropDownList();




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
        mysqli_query($conn, "DELETE FROM tbl_trainer WHERE id_trainer='$_GET[id]'");
        error_reporting(0);
        unlink("images/trainer/$_GET[id].jpg");
        echo '<script>setTimeout(\'location.href="?modul=trainer&aksi=tampil"\' ,0);</script>';
        break;

        //INPUT
    case "input":

        $tanggal_lahir = $_POST['tanggal_lahir'];
        $tanggal_daftar = $_POST['tanggal_daftar'];

        $query = mysqli_query($conn, "select * from tbl_trainer where id_trainer = '$_POST[id_trainer]'");
        $tampil = mysqli_fetch_row($query);
        error_reporting(0);
        $maxUp = 3000000;
        $extensionList = array("bmp", "jpg", "gif");
        $error = $_FILES['berkas']['error']; //error
        $nama_file = $_FILES['berkas']['name']; //Name
        $ukuran = $_FILES['berkas']['size']; //Size Byte
        $temp = $_FILES['berkas']['tmp_name']; //Temporary
        if ($tampil > 0) {
            echo '<script>alert(\'Data Dengan id_trainer ini Sudah Ada . . !\')
	setTimeout(\'location.href="?modul=trainer&aksi=tambahtrainer"\' ,0);</script>';
        } elseif ($ukuran > $maxUp) {
            echo "<script>
	alert('Ukuran File Foto Terlalu Besar, Maximal 3 mb!');
	</script>";
            echo '<script>setTimeout(\'location.href="?modul=trainer&aksi=tambahtrainer"\' ,0);</script>';
        } elseif ((exif_imagetype($temp) != IMAGETYPE_JPEG) && (!empty($temp))) {
            echo "<script>
	alert('Format Foto Salah !!');
	</script>";
            echo '<script>setTimeout(\'location.href="?modul=trainer&aksi=tambahtrainer"\' ,0);</script>';
        } elseif (file_exists($tujuan)) {
            echo $nama_file . " sudah ada , ganti dengan file lainnya";
        } else {

            //echo"ukuran File Anda : $ukuran "."Byte</br>";
            //echo" File Disimpan di ".$tujuan;
            //echo "</br></br>$tes";


            $sql = mysqli_query($conn, "INSERT INTO tbl_trainer VALUES(
						'$_POST[id_trainer]',
						'$tanggal_daftar',
						'$_POST[nama]',
						'$tanggal_lahir',
						'$_POST[alamat]',
						'$_POST[jenis_kelamin]',
						'$_POST[tel]'
						)");

            if (!$sql) {
                echo mysqli_error();
                echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
            } else {
                $tes = $_POST['id_trainer'];
                $newfilename = "$tes" . "." . "jpg";
                $tujuan = "images/trainer/" . $newfilename; //destination
                $default = "images/trainer/def.jpg";
                $gambar = "images/trainer/" . $newfilename;
                if ($nama_file == "") {
                } else {
                    move_uploaded_file($temp, $tujuan);
                }
                echo '<script>alert(\'Data Berhasil Dimasukkan.\')
			setTimeout(\'location.href="?modul=trainer&aksi=tampil"\' ,0);</script>';
            }
        }
        break;

        //UPDATE USER
    case "update":
        error_reporting(0);
        $maxUp = 3000000;
        $extensionList = array("bmp", "jpg", "gif");
        $error = $_FILES['berkas']['error']; //error
        $nama_file = $_FILES['berkas']['name']; //Name
        /* New File Name */
        $newname = substr($nama_file, -3);
        $newname2 = substr($nama_file, +3);
        $pecah = explode(".", $nama_file);
        $ekstensi = $pecah[1];
        $ukuran = $_FILES['berkas']['size']; //Size Byte
        $temp = $_FILES['berkas']['tmp_name']; //Temporary
        $tipe_data = $_FILES['berkas']['type']; //Type data
        $extension = end(explode(".", $nama_file));
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $tanggal_daftar = $_POST['tanggal_daftar'];
        if ($ukuran > $maxUp) {
            echo "<script>
	alert('Ukuran File Foto Terlalu Besar, Maximal 3 mb!');
	</script>";
            echo '<script>setTimeout(\'location.href="?modul=trainer&aksi=tampil"\' ,0);</script>';
        } else {
            $sql = mysqli_query($conn, "UPDATE tbl_trainer SET
nama = '$_POST[nama]',
tanggal_daftar = '$tanggal_daftar',
tanggal_lahir = '$tanggal_lahir',
alamat = '$_POST[alamat]',
jenis_kelamin = '$_POST[jenis_kelamin]',
tel = '$_POST[tel]'
where id_trainer='$_POST[id_trainer]'");
            if ($sql) {
                $tes = $_POST['id_trainer'];
                $newfilename = "$tes" . "." . "jpg";
                $tujuan = "images/trainer/" . $newfilename; //destination
                move_uploaded_file($temp, $tujuan);
                echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=trainer&aksi=tampil"\' ,0);</script>';
            } else {
                echo '<script>alert(\'Gagal Mengedit !\')
setTimeout(\'location.href="?modul=trainer&aksi=tampil"\' ,0);</script>';
            }
        }
        break;
}


?>