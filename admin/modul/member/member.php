<?php

switch ($_GET['aksi']) {

        //INTERFACE TABLE BROWSER

    case "tampil";

        if ($_SESSION['levelmembership'] == "Karyawan") {

            echo '

		<a href="index.php?modul=member&aksi=tambahmember" class="button">Tambah Data member</a>

		</br></br>';
        } else {

            echo '

		<a href="index.php?modul=member&aksi=tambahmember" class="button">Tambah Data member</a>

		<a href="modul/member/cetak.php" target="_blank" onclick="popup(this);" class="button">Cetak PDF</a>

		<a href="modul/member/cetak_excel.php" target="_blank" onclick="popup(this);" class="button">Cetak Excel</a>

		</br></br>';
        }



        echo "<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";

        echo "<tr>

	<td align=center><i>Untuk Memperpanjang / Menambah Paket yang ada klik 'Detail & Paket'</i></td>

	</tr>";

        echo "</table>";

        if ($_SESSION['levelmembership'] == "Karyawan") {

            echo '
                <table id="datatables" class="display">

                <thead>

                <tr>

                <th>No</th>

                <th>No ID CARD</th>

                <th>Nomer Kartu</th>

                <th>Nama Member</th>

                <th>Tanggal Daftar Member</th>
                
                <th>Jam</th>

                <th>Detail Member</th>

                <th>Status Member</th>

                </tr>

                </thead>

                <tbody>';
        } else {

            echo '

		<table id="datatables" class="display">

		<thead>

		<tr>

		<th>No</th>

		<th>No ID CARD</th>

		<th>Nomer Kartu</th>

		<th>Nama Member</th>

		<th>Tanggal</th>
		
		<th>Jam</th>

		<th><center>Detail Member</center></th>

		<th><center>Status Member</center></th>

		<th>Ubah</th>

		<th>Hapus</th>

		</tr>

		</thead>

		<tbody>';
        }



        if ($_SESSION['levelmembership'] == "member") {

            $sql = mysqli_query($conn, "SELECT * FROM tbl_member where user = '$_SESSION[adminmembership]' ORDER BY id_member DESC");
        } else {

            $sql = mysqli_query($conn, "SELECT * FROM tbl_member ORDER BY `tbl_member`.`id_member` DESC");
        }

        $no = 1;

        while ($r = mysqli_fetch_array($sql)) {
            $tanggal = date('d/M/Y', strtotime($r['tanggal_daftar']));
            $jam = date('H:i:s', strtotime($r['tanggal_daftar']));


            if ($_SESSION['levelmembership'] == "Karyawan") {

                echo "<tr>

			<td width=20>$no</td>

			<td>$r[nama]</td>

			<td>$r[pekerjaan]</td>

			<td>$r[username]</td>

			<td><center>$tanggal</center></td>
			<td><center>$jam</center></td>

			";

                date_default_timezone_set('Asia/Jakarta');

                $tanggal1 = mktime(date("m"), date("d"), date("Y"));

                $tglsekarang1 = date("Y-m-d", $tanggal1);

                if ($r['id_member'] == "MBR-UMUM") {

                    echo "<td></td>";
                } else {

                    echo "

				<td><center><a href='?modul=detailmember&aksi=tampil&id=" . $r['id_member'] . "'>Detail & Paket</center></td>";
                }

                $tampilcek = mysqli_fetch_array(mysqli_query($conn, "SELECT b.tipe,MAX(a.kuota_latihan) as kuota_latihan, a.id_member,TIMESTAMPDIFF(DAY,current_date,a.tanggal_berlaku) as wew from tbl_deposit as a LEFT JOIN tbl_tarif as b ON b.kode_tarif=a.kode_tarif where a.id_member = '$r[id_member]' and TIMESTAMPDIFF(DAY,current_date,a.tanggal_berlaku) > 0"));

                $cek_data_unlimited = mysqli_fetch_array(mysqli_query($conn, "SELECT b.tipe,MAX(a.kuota_latihan) as kuota_latihan, a.id_member,TIMESTAMPDIFF(DAY,current_date,a.tanggal_berlaku) as wew from tbl_deposit as a LEFT JOIN tbl_tarif as b ON b.kode_tarif=a.kode_tarif where a.id_member = '$r[id_member]' and b.tipe = 'UNLIMITED'"));

                // var_dump($cek_data_unlimited['tipe']);

                if ($r['id_member'] == "MBR-UMUM") {
                } else {
                    if (empty($tampilcek['id_member']) || empty($tampilcek['wew'])) {
                        $status = '<div style="color:red; font-weight:bold">EXPIRED</div>';
                    } else {
                        if ($tampilcek['tipe'] == 'UNLIMITED') {
                            $status = '<div style="color:GREEN; font-weight:bold">AKTIF</div>';
                        } else if ($tampilcek['kuota_latihan'] == '0') {
                            if ($cek_data_unlimited['tipe'] == 'UNLIMITED') {
                                $status = '<div style="color:GREEN; font-weight:bold">AKTIF</div>';
                            } else {
                                $status = '<div style="color:red; font-weight:bold">NONAKTIF</div>';
                            }
                        } else {
                            $status = '<div style="color:GREEN; font-weight:bold">AKTIF</div>';
                        }
                    }
                }

                if ($r['id_member'] == "MBR-UMUM") {

                    echo "<td></td>";

                    echo "<td></td>";
                } else {

                    echo "<td>$status</td>";
                }

                echo "

			</tr>";



                $no++;
            } else {

                echo "<tr>

			<td width=20>$no</td>

			<td>$r[nama]</td>

			<td>$r[pekerjaan]</td>

			<td>$r[username]</td>
			
        	<td>$tanggal</td>
			<td>$jam</td>




			";

                date_default_timezone_set('Asia/Jakarta');

                $tanggal1 = mktime(date("m"), date("d"), date("Y"));

                $tglsekarang1 = date("Y-m-d", $tanggal1);



                if ($r['id_member'] == "MBR-UMUM") {

                    echo "<td></td>";
                } else {

                    echo "

				<td><a href='?modul=detailmember&aksi=tampil&id=" . $r['id_member'] . "'>Detail & Paket</td>";
                }

                $tampilcek = mysqli_fetch_array(mysqli_query($conn, "SELECT b.tipe,MAX(a.kuota_latihan) as kuota_latihan, a.id_member,TIMESTAMPDIFF(DAY,current_date,a.tanggal_berlaku) as wew from tbl_deposit as a LEFT JOIN tbl_tarif as b ON b.kode_tarif=a.kode_tarif where a.id_member = '$r[id_member]' and TIMESTAMPDIFF(DAY,current_date,a.tanggal_berlaku) > 0"));

                $cek_data_unlimited = mysqli_fetch_array(mysqli_query($conn, "SELECT b.tipe,MAX(a.kuota_latihan) as kuota_latihan, a.id_member,TIMESTAMPDIFF(DAY,current_date,a.tanggal_berlaku) as wew from tbl_deposit as a LEFT JOIN tbl_tarif as b ON b.kode_tarif=a.kode_tarif where a.id_member = '$r[id_member]' and b.tipe = 'UNLIMITED'"));

                // var_dump($cek_data_unlimited['tipe']);

                if ($r['id_member'] == "MBR-UMUM") {
                } else {
                    if (empty($tampilcek['id_member']) || empty($tampilcek['wew'])) {
                        $status = '<div style="color:red; font-weight:bold">EXPIRED</div>';
                    } else {
                        if ($tampilcek['tipe'] == 'UNLIMITED') {
                            $status = '<div style="color:GREEN; font-weight:bold">AKTIF</div>';
                        } else if ($tampilcek['kuota_latihan'] == '0') {
                            if ($cek_data_unlimited['tipe'] == 'UNLIMITED') {
                                $status = '<div style="color:GREEN; font-weight:bold">AKTIF</div>';
                            } else {
                                $status = '<div style="color:red; font-weight:bold">NONAKTIF</div>';
                            }
                        } else {
                            $status = '<div style="color:GREEN; font-weight:bold">AKTIF</div>';
                        }
                    }
                }



                if ($r['id_member'] == "MBR-UMUM") {

                    echo "<td></td>";

                    echo "<td></td>";

                    echo "<td></td>";
                } else {

                    echo "<td>$status</td>";

                    echo "<td><a href='?modul=member&aksi=editmember&id=" . $r['id_member'] . "'>Ubah</td>

				<td><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=member&aksi=hapus&id=" . $r['id_member'] . "'>Hapus</td>";
                }

                echo "

			</tr>";



                $no++;
            }
        }

        echo "

	</tbody>

	</table>";

        break;



        //INTERFACE TAMBAH

    case "tambahmember":

?>

        <!--<script type="text/javascript" src="js/nicEdit.js"></script>

	<script type="text/javascript">

	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

</script>-->



        <?php

        echo '<div class="container2">';



        echo '

<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=member&aksi=input">';

        echo '<div id="papanpanel2">

<h3>Tambah Data member</h3>

</div>  ';

        $qr    = mysqli_query($conn, "SELECT MAX(CONCAT(LPAD((RIGHT((id_member),7)+1),7,'0')))FROM tbl_member");

        $qr2    = mysqli_query($conn, "SELECT MIN(CONCAT(LPAD((RIGHT((id_member),7)),7,'0')))FROM tbl_member");

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
                    <label for="id_member" class="required">ID member</label>
                    Otomatis
                </li>
                <li>
                    <label for="nama" class="required">Nama Member</label>
                    <input type="text" size="30" maxlength="40" id="username" name="username" class="k-textbox" placeholder="Masukkan Nama Member" required validationMessage="Masukkan Nama Member" />
                </li>
                <li>

                    <label for="nama" class="required">Tanggal Lahir</label>

                    <input type="date" size="30" name="tanggal_lahir" class="form-control" placeholder="Tanggal Lahir" required validationMessage="Mohon Masukkan Tanggal Lahir member" /></br><span style="padding-left:130px"></span>
                </li>
                <li>
                    <label for="alamat" class="required">Alamat</label>
                    <textarea name="alamat" id="alamat" class="k-textbox" placeholder="Isi Alamat" required validationMessage="Please enter {0}"></textarea>
                </li>
                <li>
                    <label for="jenis_kelamin" class="required">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin">
                        <option value="Laki-Laki">Laki-Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </li>
                <li>
                    <label for="tanggal_daftar" class="required">Tanggal Daftar</label>
                    <input type="date" name="tanggal_daftar" class="form-control" placeholder="Tanggal Daftar" required validationMessage="Mohon Masukkan Tanggal Daftar" /></br><span style="padding-left:130px"></span>
                </li>
                <li>
                    <label for="kode_tarif" class="required">Kode Tarif (Paket)</label>
                    <select id="kode_tarif" style='width:500px' required name="kode_tarif">
                        <?php
                        echo "<option value=''>--Pilih Jenis Tarif--</option>";
                        $quer1 = mysqli_query($conn, "select kode_tarif,jenis_tarif,tarif,jml_bulan from tbl_tarif order by kode_tarif ASC");
                        while ($tmpkode = mysqli_fetch_array($quer1)) {
                            echo "<option value='$tmpkode[kode_tarif]'>$tmpkode[kode_tarif]-$tmpkode[jenis_tarif]-$tmpkode[jml_bulan] Bulan-Rp" . number_format($tmpkode['tarif'], 0, ',', '.') . "</option>";
                        }
                        ?>
                    </select>
                </li>
                <!--  <li>
                    <label for="bulan" class="required">Jumlah Bulan</label>
                     <select id="bulan" name="bulan">
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

                <li>

                    <label for="tel" class="required">Phone</label>

                    <input type="tel" id="tel" name="tel" class="k-textbox" placeholder="Masukkan No Telepon" required validationMessage="Masukkan No Telp !!" />

                </li>

                <li>

                    <label for="nama" class="required">NOMER KARTU</label>

                    <input type="text" size="30" maxlength="40" id="nama" name="pekerjaan" class="k-textbox" placeholder="TAB Pada Mesin ID card" required validationMessage="Input manual Nomer Yang ada pada Kartu" />

                </li>

                <li>

                    <label for="nama" class="required">NOMER ID CARD</label>

                    <input type="text" size="30" maxlength="40" id="nama" name="nama" class="k-textbox" placeholder="TAB Pada Mesin ID card" required validationMessage="TAB Pada Mesin ID card" />

                </li>

                <li>

                    <label for="nama" class="required">In Charge</label>

                    <input type="text" size="30" maxlength="40" id="created_by" name="created_by" class="k-textbox" value="<?php echo $_SESSION['adminmembership'] ?>" readonly>

                </li>

                <style type="text/css">
                    .text-foto {

                        color: red;

                        padding-left: 130px;

                        padding-top: 10px;

                    }
                </style>

                <li>

                    <label for="nama" class="required">Foto</label>

                    <input type="file" id="foto" name="foto" class="k-textbox">

                    <p class="text-foto">File Foto Tidak Lebih Dari 2 MB</p>

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
    case "editmember":
        $db = "select a.*,b.*,c.* from tbl_member as a left join tbl_deposit as b on b.id_member=a.id_member left join tbl_tarif as c on c.kode_tarif=b.kode_tarif where a.id_member='$_GET[id]'";
        $qri = mysqli_query($conn, $db);
        $row = mysqli_fetch_array($qri);
        $tanggal_lahir = $row['tanggal_lahir'];
        $tanggal_daftar = $row['tanggal_daftar'];
        echo '<div class="container2">';
        echo '

<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=member&aksi=update">';

        echo '<div id="papanpanel2">

<h3>Edit Data member</h3>

</div>  ';

    ?>
        <div class="row">
            <div id="tickets" class="col-md-6">
                <ul>
                    <li>
                        <label for="id_member" class="required">ID member</label>
                        <input type="text" size="30" id="id_member" name="id_member" class="k-textbox" value="<?php echo "$_GET[id]"; ?>" readonly="readonly" style="background:transparent; color:GREY" />
                    </li>
                    <li>
                        <label for="nama" class="required">No KARTU</label>
                        <input type="text" size="30" maxlength="40" id="pekerjaan" name="pekerjaan" value="<?php echo "$row[pekerjaan]"; ?>" class="k-textbox" placeholder="Masukkan No ID CARD" required validationMessage="Masukkan No ID CARD" />
                    </li>
                    <li>
                        <label for="nama" class="required">No ID CARD</label>
                        <input type="text" size="30" maxlength="40" id="nama" name="nama" value="<?php echo "$row[nama]"; ?>" class="k-textbox" placeholder="Masukkan No ID CARD" required validationMessage="Masukkan No ID CARD" />
                    </li>
                    <li>
                        <label for="nama" class="required">Nama Member</label>
                        <input type="text" size="30" maxlength="40" id="username" name="username" value="<?php echo "$row[username]"; ?>" class="k-textbox" placeholder="Masukkan Nama User" required validationMessage="Mohon Nama Email" />
                    </li>
                    <li>
                        <label for="nama" class="required">Tanggal Lahir</label>
                        <input type="date" size="30" maxlength="40" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo "$tanggal_lahir"; ?>" class="k-textbox" placeholder="Tanggal Lahir" required validationMessage="Mohon Masukkan Tanggal Lahir member" /></br><span style="padding-left:130px"></span>
                        <!--<script>
            $(document).ready(function() {

                // create DatePicker from input HTML element

                $("#tanggal_lahir").kendoDatePicker();

            });

        </script>-->

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
                        <label for="tanggal_daftar" class="required">Tanggal Daftar</label>
                        <input type="date" size="30" maxlength="40" id="tanggal_daftar" name="tanggal_daftar" class="k-textbox" value="<?php echo "$tanggal_daftar"; ?>" placeholder="Tanggal Daftar" required validationMessage="Mohon Masukkan Tanggal Daftar" /></br><span style="padding-left:130px"></span>
                    </li>
                    <li>
                        <label for="tel" class="required">Phone</label>
                        <input type="tel" id="tel" name="tel" class="k-textbox" value="<?php echo "$row[tel]"; ?>" placeholder="Masukkan No Telepon" required validationMessage="Masukkan No Telp !!" />
                    </li>
                    <li>
                        <style type="text/css">
                            .text-foto {
                                color: red;
                                padding-left: 130px;
                                padding-top: 10px;
                            }
                        </style>
                        <label for="nama" class="required">Foto</label>
                        <input type="file" id="foto" name="foto" class="k-textbox" validationMessage="Masukan Foto" />
                        <br>
                        <p class="text-foto">File Foto Tidak Lebih Dari 2 MB</p>
                    </li>
                    <li class="accept">
                        <button class="k-button" type="submit">Submit</button>&nbsp&nbsp&nbsp<button class="k-button" onclick="self.history.back()" type="button">Batal</button>
                    </li>

                    <style type="text/css">
                        .gambar-profil {
                            float: right;
                            margin-right: -60px;
                            margin-top: -500px;
                        }

                        .foto {
                            height: 100px;
                            width: 100px;
                            border-radius: 10%;
                        }
                    </style>
                    <div class="gambar-profil">
                        <?php
                        $cek_foto = $row['foto'];

                        if (@$cek_foto == NULL) { ?>
                            <img class="foto" src="foto_member/icon_user.jpg">
                        <?php  } else { ?>
                            <img class="foto" src="foto_member/<?php echo $row[foto]  ?>">
                        <?php } ?>
                    </div>

                    </form>

                </ul>


            </div>

        </div>


        <style scoped>
            .k-textbox {

                width: 11.8em;

            }

            #tickets {

                width: 400px;

                height: auto;

                margin-left: 0px auto;

                padding: 0px;

                padding-right: 50px;

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

        mysqli_query($conn, "DELETE FROM tbl_member WHERE id_member='$_GET[id]'");

        mysqli_query($conn, "DELETE FROM tbl_deposit WHERE id_member='$_GET[id]'");

        error_reporting(0);

        unlink("images/member/$_GET[id].jpg");

        echo '<script>setTimeout(\'location.href="?modul=member&aksi=tampil"\' ,0);</script>';

        break;



        //INPUT

    case "input":



        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');

        $foto = $_FILES['foto']['name'];

        $x = explode('.', $foto);

        $ekstensi = strtolower(end($x));

        // var_dump($ekstensi);

        // die;

        $ukuran = $_FILES['foto']['size'];





        $file_tmp = $_FILES['foto']['tmp_name'];



        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {

            if ($ukuran < 200000) {

                $cek = move_uploaded_file($file_tmp, 'foto_member/' . $foto);
            } else {

                echo '<script>alert(\'Ukuran File Terlalu Besar . . !\')

		setTimeout(\'location.href="?modul=member&aksi=tambahmember"\' ,0);</script>';
                return false;
            }
        } else {

            echo '<script>alert(\'Format File Tidak Sesuai . . !\')

	setTimeout(\'location.href="?modul=member&aksi=tambahmember"\' ,0);</script>';
            return false;
        }





        $tanggal_lahir = $_POST['tanggal_lahir'];

        $created_by  = $_POST['created_by'];



        // $tanggal_daftar = $_POST['tanggal_daftar'];
        $tanggal_daftar = date("Y-m-d H:i:s");

        // var_dump($tanggal_daftar);
        // die;

        $query = mysqli_query($conn, "select * from tbl_member where id_member = '$_POST[id_member]'");

        $tampil = mysqli_fetch_row($query);

        $cekusername = mysqli_fetch_row(mysqli_query($conn, "select * from tbl_member where username = '$_POST[username]'"));

        error_reporting(0);

        $maxUp = 3000000;

        if ($tampil > 0) {

            echo '<script>alert(\'Data Dengan id_member ini Sudah Ada . . !\')

	setTimeout(\'location.href="?modul=member&aksi=tambahmember"\' ,0);</script>';
        } elseif ($cekusername > 0) {

            echo '<script>alert(\'Username ini sudah Ada. Gunakan Username Lain . . !\')

	setTimeout(\'location.href="?modul=member&aksi=tambahmember"\' ,0);</script>';
        } elseif (file_exists($tujuan)) {

            echo $nama_file . " sudah ada , ganti dengan file lainnya";
        } else {

            //auto

            $mqr    = mysqli_query($conn, "SELECT MAX(CONCAT(LPAD((RIGHT((id_member),7)+1),7,'0')))FROM tbl_member");

            $mqr2    = mysqli_query($conn, "SELECT MIN(CONCAT(LPAD((RIGHT((id_member),7)),7,'0')))FROM tbl_member");

            $mkde = mysqli_fetch_array($mqr);

            $mkde2 = mysqli_fetch_array($mqr2);

            if ($mkde2[0] != "0000001") {

                $mkodea = "0000001";
            } else {

                $mkodea = $mkde[0];
            }

            $tanggal_daftar = $_POST['tanggal_daftar'] . ' ' . date("H:i:s");

            //auto

            $pass = md5($_POST['password']);

            $sql = mysqli_query($conn, "INSERT INTO tbl_member VALUES(

		'MMB$mkodea',

		'$_POST[nama]',

		'member',

		'$_POST[tanggal_lahir]',
		'$_POST[alamat]',
		'$_POST[jenis_kelamin]',
		'$_POST[pekerjaan]',
		'$tanggal_daftar',
        '$_POST[tanggal_daftar]',
		'$_POST[tel]',
		'$_POST[username]',
		'$pass',
		'$foto',
		'$created_by'

	)");

            if (!$sql) {

                echo mysqli_error();

                echo "Gagal Memasukkan Database,</br>

		Pastikan Data Yang Dimasukkan Benar.</br>

		<input type='button' onclick=self.history.back() value='Kembali'/>";
            } else {

                $tampiltarif = mysqli_fetch_array(mysqli_query($conn, "select tarif,jml_bulan from tbl_tarif where kode_tarif = '$_POST[kode_tarif]'"));

                //$deposit = $tampiltarif['tarif']*$tampiltarif['jml_bulan'];

                $deposit = $tampiltarif['tarif'];

                date_default_timezone_set('Asia/Jakarta');

                $tanggal = mktime(date("m"), date("d"), date("Y"));

                $tglsekarang = date("Y-m-d", $tanggal);

                $quertarif = mysqli_fetch_array(mysqli_query($conn, "select * from tbl_tarif where kode_tarif = '$_POST[kode_tarif]'"));

                //$iberlaku = $deposit/$quertarif['tarif'];

                $iberlaku = $tampiltarif['jml_bulan'];

                $berlaku = mysqli_fetch_array(mysqli_query($conn, "SELECT ADDDATE('$_POST[tanggal_daftar]', INTERVAL $iberlaku MONTH) AS berlaku"));

                //mysqli_query($conn,"insert into tbl_deposit values ('$_POST[id_member]','$tglsekarang','$berlaku[berlaku]')");

                mysqli_query($conn, "insert into tbl_deposit values ('','MMB$mkodea','$_POST[kode_tarif]','$_POST[tanggal_daftar]','$berlaku[berlaku]','$quertarif[jml_latih_max]')");



                $qr    = mysqli_query($conn, "SELECT MAX(CONCAT(LPAD((RIGHT((id_transaksi),7)+1),7,'0')))FROM tbl_trans_deposit");

                $qr2    = mysqli_query($conn, "SELECT MIN(CONCAT(LPAD((RIGHT((id_transaksi),7)),7,'0')))FROM tbl_trans_deposit");

                $kde = mysqli_fetch_array($qr);

                $kde2 = mysqli_fetch_array($qr2);

                if ($kde2[0] != "0000001") {

                    $kodea = "0000001";
                } else {

                    $kodea = $kde[0];
                }

                mysqli_query($conn, "insert into tbl_trans_deposit values (

			'TRN$kodea',

			'MMB$mkodea',

			'$_POST[kode_tarif]',

			$deposit,

			'$_POST[tanggal_daftar]',

			'$berlaku[berlaku]',

			'Y',

			'Y',

			'Y',

			'-')");

                $tes = $_POST['id_member'];

                $newfilename = "$tes" . "." . "jpg";

                $tujuan = "images/member/" . $newfilename; //destination

                $default = "images/member/def.jpg";

                $gambar = "images/member/" . $newfilename;

                if ($nama_file == "") {
                } else {

                    move_uploaded_file($temp, $tujuan);
                }

                echo '<script>alert(\'Data Berhasil Dimasukkan.\n Member Telah Aktif Sesuai Dengan Paket Yang Dipilih. \')

                setTimeout(\'location.href="?modul=member&aksi=tampil"\' ,0);</script>';
            }
        }

        break;



        //UPDATE USER

    case "update":

        error_reporting(0);


        $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');

        $foto = $_FILES['foto']['name'];

        $x = explode('.', $foto);

        $ekstensi = strtolower(end($x));

        // var_dump($ekstensi);

        // die;

        $ukuran = $_FILES['foto']['size'];

        $file_tmp = $_FILES['foto']['tmp_name'];


        $tanggal_lahir = $_POST['tanggal_lahir'];

        $tanggal_daftar = $_POST['tanggal_daftar'];


        $pass = md5($_POST['password']);
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {

            if ($ukuran < 200000) {

                $cek = move_uploaded_file($file_tmp, 'foto_member/' . $foto);
            } else {

                echo '<script>alert(\'Ukuran File Terlalu Besar . . !\')

        		setTimeout(\'location.href="?modul=member&aksi=tambahmember"\' ,0);</script>';
            }
        } else {

            echo '<script>alert(\'Format File Tidak Sesuai . . !\')

        	setTimeout(\'location.href="?modul=member&aksi=tambahmember"\' ,0);</script>';
        }

        $tanggal_daftar = $_POST['tanggal_daftar'] . ' ' . date("H:i:s");

        $sql = mysqli_query($conn, "UPDATE tbl_member SET
        	nama = '$_POST[nama]',
        	tanggal_lahir = '$tanggal_lahir',
        	alamat = '$_POST[alamat]',
        	jenis_kelamin = '$_POST[jenis_kelamin]',
        	pekerjaan='$_POST[pekerjaan]',
        	tanggal_daftar = '$tanggal_daftar',
            tgl_daftar = '$_POST[tanggal_daftar]',
        	tel = '$_POST[tel]',
        	username = '$_POST[username]',
        	password = '$pass',
        	foto    = '$foto'
        	where id_member='$_POST[id_member]'");

        if ($sql) {
            $tes = $_POST['id_member'];

            $newfilename = "$tes" . "." . "jpg";

            $tujuan = "images/member/" . $newfilename; //destination

            move_uploaded_file($temp, $tujuan);

            echo '<script>alert(\'Data Berhasil Diedit\')
    
            setTimeout(\'location.href="?modul=member&aksi=tampil"\' ,0);</script>';
        } else {

            echo '<script>alert(\'Gagal Mengedit !\')

            	setTimeout(\'location.href="?modul=member&aksi=tampil"\' ,0);</script>';
        }

        break;
}

?>