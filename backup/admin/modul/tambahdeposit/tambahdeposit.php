<?php
switch ($_GET['aksi']) {
        //INTERFACE TABLE BROWSER

        //INTERFACE TAMBAH
    case "tambahdeposit":
        echo '<div class="container2">';
        echo '
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=tambahdeposit&aksi=input&id_member=' . $_GET['id'] . '">';
        echo '<div id="papanpanel2">

	<h3>Tambah Deposit</h3>
	</div>  ';
        $qr    = mysqli_query($conn, "SELECT MAX(CONCAT(LPAD((RIGHT((id_transaksi),7)+1),7,'0')))FROM tbl_trans_deposit");
        $qr2    = mysqli_query($conn, "SELECT MIN(CONCAT(LPAD((RIGHT((id_transaksi),7)),7,'0')))FROM tbl_trans_deposit");
        $kde = mysqli_fetch_array($qr);
        $kde2 = mysqli_fetch_array($qr2);
        if ($kde2[0] != "0000001") {
            $kodea = "0000001";
        } else {
            $kodea = $kde[0];
        }
        if (!isset($_GET['id'])) {
            echo '<script>alert(\'Instrukti Tidak Sah !\')
setTimeout(\'location.href="?modul=pasien&aksi=tampil"\' ,0);</script>';
        } else {

            $query0 = mysqli_query($conn, "select * from tbl_member where id_member='$_GET[id]'");
            echo "<table border='0' style='border-collapse:collapse;width:500px; color:white; font-size:9px; background-color:grey' id='tabel'>";

            $baris0 = 1;
            while ($tampil0 = mysqli_fetch_array($query0)) {
                echo "<tr><td style='padding:5px'  colspan='2' align='center'>";
                echo '<img width="100px"   src="images/user/def.png"/>';
                echo "</td></tr>";
                echo "<tr><td width='30%'>ID MEMBER</td><td>$tampil0[id_member]</td></tr>";
                echo "<tr><td>No ID CARD</td><td>$tampil0[nama]</td></tr>";
                echo "<tr><td>Nama</td><td>$tampil0[username]</td></tr>";
                echo "<tr><td>Jenis Kelamin</td><td>$tampil0[jenis_kelamin]</td></tr>";
                echo "<tr><td>Tanggal Lahir</td><td>$tampil0[tanggal_lahir]</td></tr>";
                echo "<tr><td>Alamat</td><td>$tampil0[alamat]</td></tr>";
                echo "<tr><td>Tanggal Daftar</td><td>$tampil0[tanggal_daftar]</td></tr>";
                echo "<tr><td>No Telepon</td><td>$tampil0[tel]</td></tr>";
                $baris0++;
            }
            echo "</tr>";
            echo "</table></br>";
            echo "<table border='0' cellpadding='10px' style='border-collapse:collapse;width:500px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
            echo "<tr>
</tr>";
            echo "</table>
";
        }
?>

        <div id="tickets">
            <ul>
                <li>
                    <label for="kode_tarif" class="required">Kode Tarif (Paket)</label>
                    <?php
                    if (isset($_GET['kd'])) { ?>
                        <select id="kode_tarif" required style='width:500px' name="kode_tarif">
                            <?php


                            $quer1 = mysqli_query($conn, "select kode_tarif,jenis_tarif,tarif,jml_bulan from tbl_tarif where kode_tarif = '$_GET[kd]' order by kode_tarif ASC");
                            while ($tmpkode = mysqli_fetch_array($quer1)) {
                                echo "<option value='$tmpkode[kode_tarif]'>$tmpkode[kode_tarif]-$tmpkode[jenis_tarif]-$tmpkode[jml_bulan] Bulan-Rp" . number_format($tmpkode['tarif'], 0, ',', '.') . "</option>";
                            }
                        } else { ?>

                            <select id="kode_tarif" required style='width:500px' name="kode_tarif">
                            <?php

                            echo "<option value=''>--Pilih Jenis Tarif--</option>";
                            $quer1 = mysqli_query($conn, "select kode_tarif,jenis_tarif,tarif,jml_bulan from tbl_tarif order by kode_tarif ASC");
                            while ($tmpkode = mysqli_fetch_array($quer1)) {

                                echo "<option value='$tmpkode[kode_tarif]'>$tmpkode[kode_tarif]-$tmpkode[jenis_tarif]-$tmpkode[jml_bulan] Bulan-Rp" . number_format($tmpkode['tarif'], 0, ',', '.') . "</option>";
                            }
                        }
                            ?>
                            </select>
                </li>
                <!-- <li>
                    <label for="bulan" class="required">Jumlah Bulan</label>
                     <select id="bulan" required name="bulan">
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
                </li>-->
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
                height: 323px;
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
    case "tambahlatihan":
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
        $now = date("Y-m-d H:i:s");
        echo '<div class="container2">';

        echo '
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=tambahdeposit&aksi=inputlatihan&id_member=' . $_GET['id'] . '&kd=' . $_GET['kd'] . '">';
        echo '<div id="papanpanel2">

	<h3>Tambah Absensi Latihan</h3>
	</div>  ';

        if (!isset($_GET['id'])) {
            echo '<script>alert(\'Instrukti Tidak Sah !\')
setTimeout(\'location.href="?modul=pasien&aksi=tampil"\' ,0);</script>';
        } else {
        }
    ?>

        <div id="tickets">
            <ul>
                <li>
                    <label for="id_transaksi" class="required">ID MEMBER</label>
                    <input type="text" size="30" id="id_member" name="id_member" class="k-textbox" value="<?php echo $_GET['id']; ?>" readonly="readonly" style="background:transparent; color:GREY" />
                </li>

                <li>
                    <label for="kode_tarif" class="required">Kode Tarif (Paket)</label>
                    <?php
                    if (isset($_GET['kd'])) { ?>
                        <select id="kode_tarif" required style='width:500px' name="kode_tarif">
                        <?php


                        $quer1 = mysqli_query($conn, "select kode_tarif,jenis_tarif,tarif,jml_bulan from tbl_tarif where kode_tarif = '$_GET[kd]' order by kode_tarif ASC");
                        while ($tmpkode = mysqli_fetch_array($quer1)) {

                            echo "<option value='$tmpkode[kode_tarif]'>$tmpkode[kode_tarif]-$tmpkode[jenis_tarif]-$tmpkode[jml_bulan] Bulan-Rp" . number_format($tmpkode['tarif'], 0, ',', '.') . "</option>";
                        }
                    }
                        ?>
                        </select>

                </li>
                <li>
                    <label for="id_trainer" class="required">ID Trainer</label>
                    <select id="id_trainer" required style='width:500px' name="id_trainer">
                        <?php
                        echo "<option value=''>--Pilih Trainer--</option>";
                        $quer1 = mysqli_query($conn, "select id_trainer,nama from tbl_trainer order by id_trainer ASC");
                        while ($tmpkode = mysqli_fetch_array($quer1)) {

                            echo "<option value='$tmpkode[id_trainer]'>$tmpkode[id_trainer]-$tmpkode[nama]</option>";
                        }

                        ?>
                    </select>
                </li>
                <li>
                    <label for="id_transaksi" class="required">Waktu Latihan</label>
                    <input type="text" size="30" id="waktu_latihan" name="waktu_latihan" class="k-textbox" value="<?php echo $now; ?>" readonly="readonly" style="background:transparent; color:GREY; width:250px" />
                </li>
                <!-- <li>
                    <label for="bulan" class="required">Jumlah Bulan</label>
                     <select id="bulan" required name="bulan">
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
                </li>-->
                <li class="accept">

                    <?php
                    $cekkuota = mysqli_fetch_array(mysqli_query($conn, "select kuota_latihan from tbl_deposit where id_member = '$_GET[id]' and kode_tarif = '$_GET[kd]'"));
                    if ($cekkuota['kuota_latihan'] < 1) { ?>
                        <button class="k-button" type="submit" style="background-color:transparent" disabled onclick="return confirm('Anda Yakin Menginput Absensi Latihan Ini? Setelah Diinput Maka Kuota Latihan Pada Paket Member Ini Akan Berkurang..!!')">Kuota Habis</button>
                    <?php } else {
                    ?>
                        <button class="k-button" type="submit" onclick="return confirm('Anda Yakin Menginput Absensi Latihan Ini? Setelah Diinput Maka Kuota Latihan Pada Paket Member Ini Akan Berkurang..!!')">Input</button>

                        <?php } ?>&nbsp&nbsp&nbsp
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



                $("#bulan").kendoDropDownList();
                $("#id_trainer").kendoDropDownList();




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
        function DateToIndo($date)
        { // fungsi atau method untuk mengubah tanggal ke format indonesia
            // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
            $BulanIndo = array(
                "Januari", "Februari", "Maret",
                "April", "Mei", "Juni",
                "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            );

            $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
            $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
            $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring

            $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
            return ($result);
        }
        echo '

<h1>Data Latihan Paket Ini</h1>';

        echo '
		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
						<th>Tanggal Latihan</th>
						<th>Trainer</th>
                        <th>Waktu</th>
						
						
                    </tr>
                </thead>
                <tbody>';

        $sql = mysqli_query($conn, "SELECT TIME(waktu_latihan) as wkt, DATE(waktu_latihan) as tgl, tbl_trainer.id_trainer, tbl_trainer.nama FROM tbl_latihan
							  left join tbl_trainer on tbl_latihan.id_trainer = tbl_trainer.id_trainer
							  where tbl_latihan.id_member = '$_GET[id]' and tbl_latihan.kode_tarif = '$_GET[kd]' ORDER BY tbl_latihan.id_latihan DESC");

        $no = 1;
        while ($r = mysqli_fetch_array($sql)) {
            echo "<tr>
                            <td width=20>$no</td>
							 <td>" . DateToIndo($r['tgl']) . "</td>
							  <td>$r[id_trainer]-$r[nama]</td>
                            <td>$r[wkt]</td>
                          
						
                          
							";

            echo "
                            </tr>";

            $no++;
        }
        echo "
                </tbody>
         </table>";
        break;


        //INPUT 
    case "input":
        //auto
        $qr    = mysqli_query($conn, "SELECT MAX(CONCAT(LPAD((RIGHT((id_transaksi),7)+1),7,'0')))FROM tbl_trans_deposit");
        $qr2    = mysqli_query($conn, "SELECT MIN(CONCAT(LPAD((RIGHT((id_transaksi),7)),7,'0')))FROM tbl_trans_deposit");
        $kde = mysqli_fetch_array($qr);
        $kde2 = mysqli_fetch_array($qr2);
        if ($kde2[0] != "0000001") {
            $kodea = "0000001";
        } else {
            $kodea = $kde[0];
        }
        //auto
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
        $tampiltarif = mysqli_fetch_array(mysqli_query($conn, "select tarif,jml_bulan from tbl_tarif where kode_tarif = '$_POST[kode_tarif]'"));
        //$deposit = $tampiltarif['tarif']*$_POST['bulan'];
        $deposit = $tampiltarif['tarif'];
        $cekdep = mysqli_fetch_array(mysqli_query($conn, "select * from tbl_deposit where id_member = '$_GET[id_member]' and kode_tarif='$_POST[kode_tarif]'"));

        if (empty($cekdep['kode_tarif'])) {
            $cekdep2 = mysqli_fetch_array(mysqli_query($conn, "select * from tbl_deposit where id_member = '$_GET[id_member]' and kode_tarif='$_POST[kode_tarif]'"));
            if (!empty($cekdep2['kode_tarif'])) {
                echo '<script>alert(\'Gagal.. Member dengan paket ini sudah ada. Tinggal Diaktivasi saja\')
			setTimeout(\'location.href="?modul=member&aksi=tampil"\' ,0);</script>';
            } else {
                $quertarif0 = mysqli_fetch_array(mysqli_query($conn, "select * from tbl_tarif where kode_tarif='$_POST[kode_tarif]'"));
                $berlaku0 = mysqli_fetch_array(mysqli_query($conn, "SELECT ADDDATE('$tglsekarang', INTERVAL $tampiltarif[jml_bulan] MONTH) AS berlaku"));
                mysqli_query($conn, "INSERT INTO tbl_deposit (id_member,kode_tarif,tanggal_deposit,tanggal_berlaku,kuota_latihan) VALUES ('$_GET[id_member]','$_POST[kode_tarif]','$tglsekarang','$berlaku0[berlaku]',$quertarif0[jml_latih_max])");

                $sql = mysqli_query($conn, "INSERT INTO tbl_trans_deposit (id_transaksi,id_member,kode_tarif,jumlah_deposit,tanggal_transaksi,tanggal_berlaku, status_persetujuan,status_konfirmasitagihan,status_setujukonfirmasi,ket) VALUES ('TRN$kodea','$_GET[id_member]','$_POST[kode_tarif]',$deposit,'$tglsekarang','$berlaku0[berlaku]','Y','Y','Y','-')");
            }
        } else {
            $cekberlaku0 = mysqli_fetch_array(mysqli_query($conn, "select tanggal_berlaku,kuota_latihan from tbl_deposit where id_member='$_GET[id_member]' and kode_tarif='$_POST[kode_tarif]'"));
            date_default_timezone_set('Asia/Jakarta');
            $tanggal10 = mktime(date("m"), date("d"), date("Y"));
            $tglsekarang10 = date("Y-m-d", $tanggal10);
            $pecah20 = explode("-", $tglsekarang10);
            $date20 = $pecah20[2];
            $month20 = $pecah20[1];
            $year20 = $pecah20[0];
            $sekarang20 = GregorianToJD($month20, $date20, $year20);
            $valid20 = $cekberlaku0['tanggal_berlaku'];
            $pecah30 = explode("-", $valid20);
            $date30 = $pecah30[2];
            $month30 = $pecah30[1];
            $year30 = $pecah30[0];
            $valid30 = GregorianToJD($month30, $date30, $year30);
            $selisih20 = $valid30 - $sekarang20;
            if ($cekberlaku0['tanggal_berlaku'] == "0000-00-00") {
                $quertarif0 = mysqli_fetch_array(mysqli_query($conn, "select * from tbl_tarif where kode_tarif='$_POST[kode_tarif]'"));
                //$iberlaku0 = $deposit/$quertarif0['tarif'];
                $iberlaku0 = $tampiltarif['jml_bulan'];
                $berlaku0 = mysqli_fetch_array(mysqli_query($conn, "SELECT ADDDATE('$tglsekarang', INTERVAL $iberlaku0 MONTH) AS berlaku"));
            } else {
                if ($selisih20 < 0) {
                    $quertarif0 = mysqli_fetch_array(mysqli_query($conn, "select * from tbl_tarif where kode_tarif='$_POST[kode_tarif]'"));
                    //$iberlaku0 = $deposit/$quertarif0['tarif'];
                    $iberlaku0 = $tampiltarif['jml_bulan'];
                    $berlaku0 = mysqli_fetch_array(mysqli_query($conn, "SELECT ADDDATE('$tglsekarang', INTERVAL $iberlaku0 MONTH) AS berlaku"));
                    $kuotalatih = $quertarif0['jml_latih_max'];
                } elseif ($cekberlaku0['kuota_latihan'] == 0) {
                    $quertarif0 = mysqli_fetch_array(mysqli_query($conn, "select * from tbl_tarif where kode_tarif='$_POST[kode_tarif]'"));
                    $iberlaku0 = $tampiltarif['jml_bulan'];
                    $berlaku0 = mysqli_fetch_array(mysqli_query($conn, "SELECT ADDDATE('$tglsekarang', INTERVAL $iberlaku0 MONTH) AS berlaku"));
                    $kuotalatih = $quertarif0['jml_latih_max'];
                } else {
                    $quertarif0 = mysqli_fetch_array(mysqli_query($conn, "select * from tbl_tarif where kode_tarif='$_POST[kode_tarif]'"));
                    //$iberlaku0 = $deposit/$quertarif0['tarif'];
                    $iberlaku0 = $tampiltarif['jml_bulan'];
                    $berlaku0 = mysqli_fetch_array(mysqli_query($conn, "SELECT ADDDATE('$cekberlaku0[tanggal_berlaku]', INTERVAL $iberlaku0 MONTH) AS berlaku"));
                    $kuotalatih = $cekberlaku0['kuota_latihan'] + $quertarif0['jml_latih_max'];
                }
            }

            $sql = mysqli_query($conn, "INSERT INTO tbl_trans_deposit VALUES(
		'TRN$kodea',
						'$_GET[id_member]',
						'$_POST[kode_tarif]',
						$deposit,
						'$tglsekarang',
						'$berlaku0[berlaku]',
						'Y',
						'Y',
						'Y',
						'-'
						)");

            mysqli_query($conn, "update tbl_deposit set
		id_member = '$_GET[id_member]',
		tanggal_deposit = '$tglsekarang',
		tanggal_berlaku = '$berlaku0[berlaku]',
		kuota_latihan = $kuotalatih
		where id_member = '$_GET[id_member]' and kode_tarif = '$_POST[kode_tarif]'");
        }
        if (!$sql) {
            echo mysqli_error();
            echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
        } else {
            echo '<script>alert(\'Perpanjang Paket Berhasil \')
			setTimeout(\'location.href="?modul=detailmember&aksi=tampil&id=' . $_GET['id_member'] . '"\' ,0);</script>';
        }

        break;


    case "inputlatihan":
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);



        $sql = mysqli_query($conn, "insert into tbl_latihan (id_member,kode_tarif,id_trainer,waktu_latihan) values ('$_POST[id_member]','$_POST[kode_tarif]','$_POST[id_trainer]','$_POST[waktu_latihan]')");

        if (!$sql) {
            echo mysqli_error();
            echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
        } else {

            echo '<script>alert(\'Input Data Latihan Berhasil. Kuota Latihan Akan Berkurang\')
			setTimeout(\'location.href="?modul=detailmember&aksi=tampil&id=' . $_GET['id_member'] . '"\' ,0);</script>';
            mysqli_query($conn, "update tbl_deposit set
		kuota_latihan = kuota_latihan-1
		where id_member = '$_POST[id_member]' and kode_tarif = '$_POST[kode_tarif]'");
        }
        break;
}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>