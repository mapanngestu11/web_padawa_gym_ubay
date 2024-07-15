<?php
switch ($_GET['aksi']) {
        //INTERFACE TABLE BROWSER

    case "tampil";
        if ($_SESSION['levelmembership'] == "tb_produk" || $_SESSION['levelmembership'] == "Karyawan") {
        } else {
            echo '
            <a href="index.php?modul=datakonfirmasi&aksi=tambahdataproduk" class="button">Tambah Data Produk</a>
            <a href="modul/datakonfirmasi/cetak.php" target="_blank" onclick="popup(this);" class="button">Cetak PDF</a>
            <a href="modul/datakonfirmasi/cetak_excel.php" target="_blank" onclick="popup(this);" class="button">Cetak Excel</a></br></br>';
        }
        if ($_SESSION['levelmembership'] == "Karyawan") {
            echo '

		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
						<th>Harga Produk</th>
						<th>Qty Produk</th>
						<th>Kurang Qty Produk</th>
					
                    </tr>
                </thead>
                <tbody>';
        } else {
            echo '

            <table id="datatables" class="display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Qty Produk</th>
                            <th>Tambah Qty Produk</th>
                            <th>Kurang Qty Produk</th>
                            
                            <th>Aksi</th>
                        
                        </tr>
                    </thead>
                    <tbody>';
        }

        $sql = mysqli_query($conn, "SELECT * FROM tb_produk ORDER BY id_produk DESC");
        $no = 1;
        while ($r = mysqli_fetch_array($sql)) {
            if ($_SESSION['levelmembership'] == "Karyawan") {
                echo "<tr>
                            <td width=40>$no</td>
                            <td>$r[kode_produk]</td>
                            <td>$r[nama_produk]</td>
							<td>Rp." . number_format($r['harga_produk'], 0, ',', '.') . ",-</td>
							<td>$r[qty_produk]</td>
                            <td align='center'><a href='?modul=datakonfirmasi&aksi=kurangproduk&id=" . $r['id_produk'] . "'>Kurang</td>";
            } else {
                echo "<tr>
                <td width=40>$no</td>
                <td>$r[kode_produk]</td>
                <td>$r[nama_produk]</td>
                <td>Rp." . number_format($r['harga_produk'], 0, ',', '.') . ",-</td>
                <td>$r[qty_produk]</td>
                <td align='center'><a href='?modul=datakonfirmasi&aksi=tambahproduk&id=" . $r['id_produk'] . "'>Tambah</td>
                <td align='center'><a href='?modul=datakonfirmasi&aksi=kurangproduk&id=" . $r['id_produk'] . "'>Kurang</td>
                <td><a href='?modul=datakonfirmasi&aksi=editproduk&id=" . $r['id_produk'] . "'>Ubah</a> |
                <a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href=?modul=datakonfirmasi&aksi=hapus&id=$r[id_produk]> Hapus</a></td>";
            }






            // echo "
            //                 <td>$r[keterangan]</td>
            // 			    ";

            // echo "
            //                 </tr>";

            $no++;
        }
        echo "
                </tbody>
         </table>";
        break;

        break;

    case "tambahdataproduk":
        echo "<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
        echo "</table>";
        echo '<div class="container2">';

        echo '
    <form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=datakonfirmasi&aksi=input">';
        echo '<div id="papanpanel2">
        <h3>Tambah Data Produk</h3>
        </div>  ';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
?>

        <div id="tickets">
            <ul>
                <li>
                    <label for="kode_produk" class="required">Kode Produk</label>
                    <input type="text" size="30" maxlength="10" id="kode_produk" name="kode_produk" class="k-textbox" placeholder="Masukkan isi Kode Produk" required validationMessage="Mohon isi Kode Produk" />
                </li>
                <li>
                    <label for="nama_produk" class="required">Nama Produk</label>
                    <input type="text" size="30" maxlength="30" id="nama_produk" name="nama_produk" class="k-textbox" placeholder="Masukkan isi Nama Produk" required validationMessage="Mohon isi Masukkan Nama Produk" />
                </li>

                <li>
                    <label for="harga_produk" class="required">Harga Produk</label>
                    <input type="text" size="30" maxlength="20" id="harga_produk" name="harga_produk" class="k-textbox" placeholder="Masukkan isi Harga Produk" required validationMessage="Mohon isi Masukkan tarif" />
                </li>

                <li>
                    <label for="qty_produk" class="required">Quantity Produk</label>
                    <input type="text" size="30" maxlength="20" id="qty_produk" name="qty_produk" class="k-textbox" placeholder="Masukkan Quantity Produk" required validationMessage="Mohon Masukkan Quantity Produk" />
                </li>
                <li>
                    <label for="nama" class="required">ID user</label>
                    <input type="text" size="30" maxlength="40" id="created_by" name="created_by" class="k-textbox" value="<?= $_SESSION['adminmembership'] ?>" readonly />
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

    case "editproduk":
        echo "<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
        echo "</table>";
        echo '<div class="container2">';

        echo '
    <form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=datakonfirmasi&aksi=update">';
        echo '<div id="papanpanel2">
        <h3>Edit Data Produk</h3>
        </div>  ';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
        $db = "select * from tb_produk where id_produk='$_GET[id]'";
        $qri = mysqli_query($conn, $db);
        $row = mysqli_fetch_array($qri);
    ?>

        <div id="tickets">
            <ul>
                <li>
                    <label for="kode_produk" class="required">Kode Produk</label>
                    <input type="text" size="30" maxlength="10" readonly id="kode_produk" name="kode_produk" value="<?php echo "$row[kode_produk]"; ?>" class="k-textbox" placeholder="Masukkan Kode Produk" required validationMessage="Mohon Kode Produk" />
                    <input type="hidden" size="30" maxlength="10" id="id_produk" name="id_produk" value="<?php echo "$row[id_produk]"; ?>" />
                </li>
                <li>
                    <label for="nama_produk" class="required">Nama Produk</label>
                    <input type="text" size="30" maxlength="30" id="nama_produk" name="nama_produk" value="<?php echo "$row[nama_produk]"; ?>" class="k-textbox" placeholder="Masukkan Nama Produk" required validationMessage="Mohon Masukkan Nama Produk" />
                </li>

                <li>
                    <label for="harga_produk" class="required">Harga Produk</label>
                    <input type="text" size="30" maxlength="20" id="harga_produk" name="harga_produk" value="<?php echo "$row[harga_produk]"; ?>" class="k-textbox" placeholder="Masukkan Harga Produk" required validationMessage="Mohon Masukkan Harga Produk" />
                </li>
                <li>
                    <label for="nama" class="required">ID user</label>
                    <input type="text" size="30" maxlength="40" id="created_by" name="created_by" class="k-textbox" value="<?= $_SESSION['adminmembership'] ?>" readonly />
                </li>

                <!-- <li>
                    <label for="qty_produk" class="required">Quantity Produk</label>
                    <input type="text" size="30" maxlength="20" id="qty_produk" name="qty_produk" value="<?php echo "$row[qty_produk]"; ?>" class="k-textbox" placeholder="Masukkan Quantity Produk" required validationMessage="Mohon Masukkan Quantity Produk" />
                </li> -->

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


    case "tambahproduk":
        echo "<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
        echo "</table>";
        echo '<div class="container2">';

        echo '
        <form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=datakonfirmasi&aksi=tambahqty_produk">';
        echo '<div id="papanpanel2">
            <h3>Tambah Quantity Produk</h3>
            </div>  ';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
        $db = "select * from tb_produk where id_produk='$_GET[id]'";
        $qri = mysqli_query($conn, $db);
        $row = mysqli_fetch_array($qri);
    ?>

        <div id="tickets">
            <ul>
                <li>

                    <input type="hidden" size="30" maxlength="10" id="id_produk" name="id_produk" value="<?php echo "$row[id_produk]"; ?>" />
                    <input type="hidden" size="30" maxlength="10" id="qty_produk" name="qty_produk" value="<?php echo "$row[qty_produk]"; ?>" />
                </li>
                <!-- <li>
                    <label for="nama_produk" class="required">Nama Produk</label>
                    <input readonly type="text" size="30" maxlength="30" id="nama_produk" name="nama_produk" value="<?php echo "$row[nama_produk]"; ?>" class="k-textbox" placeholder="Masukkan Nama Produk" required validationMessage="Mohon Masukkan Nama Produk" />
                </li>

                <li>
                    <label for="harga_produk" class="required">Harga Produk</label>
                    <input readonly type="text" size="30" maxlength="20" id="harga_produk" name="harga_produk" value="<?php echo "$row[harga_produk]"; ?>" class="k-textbox" placeholder="Masukkan Harga Produk" required validationMessage="Mohon Masukkan Harga Produk" />
                </li>


                <li>
                    <label for="qty_produk" class="required">Quantity Saat ini</label>
                    <input readonly type="text" size="30" maxlength="20" id="qty_produk" name="qty_produk" value="<?php echo "$row[qty_produk]"; ?>" class="k-textbox" placeholder="Masukkan Quantity Produk" required validationMessage="Mohon Masukkan Quantity Produk" />
                </li> -->


                <li>
                    <label for="qty_produk" class="required">Tambah Quantity </label>
                    <input type="text" size="30" maxlength="20" id="qty_produk" name="qty_produkz" value="" class="k-textbox" placeholder="Masukkan Nilai Quantity" required validationMessage="Mohon Masukkan Nilai Quantity" />
                </li>
                <li>
                    <label for="nama" class="required">ID user</label>
                    <input type="text" size="30" maxlength="40" id="created_by" name="created_by" class="k-textbox" value="<?= $_SESSION['adminmembership'] ?>" readonly />
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

    case "kurangproduk":
        echo "<table border='0' cellpadding='10px' style='border-collapse:collapse;width:700px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
        echo "</table>";
        echo '<div class="container2">';

        echo '
            <form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=datakonfirmasi&aksi=kurangqty_produk">';
        echo '<div id="papanpanel2">
                <h3>Kurang Quantity Produk</h3>
                </div>  ';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
        $db = "select * from tb_produk where id_produk='$_GET[id]'";
        $qri = mysqli_query($conn, $db);
        $row = mysqli_fetch_array($qri);
    ?>

        <div id="tickets">
            <ul>
                <li>

                    <input type="hidden" size="30" maxlength="10" id="id_produk" name="id_produk" value="<?php echo "$row[id_produk]"; ?>" />
                    <input type="hidden" size="30" maxlength="10" id="qty_produk" name="qty_produk" value="<?php echo "$row[qty_produk]"; ?>" />
                </li>
                <!-- <li>
                        <label for="nama_produk" class="required">Nama Produk</label>
                        <input readonly type="text" size="30" maxlength="30" id="nama_produk" name="nama_produk" value="<?php echo "$row[nama_produk]"; ?>" class="k-textbox" placeholder="Masukkan Nama Produk" required validationMessage="Mohon Masukkan Nama Produk" />
                    </li>
    
                    <li>
                        <label for="harga_produk" class="required">Harga Produk</label>
                        <input readonly type="text" size="30" maxlength="20" id="harga_produk" name="harga_produk" value="<?php echo "$row[harga_produk]"; ?>" class="k-textbox" placeholder="Masukkan Harga Produk" required validationMessage="Mohon Masukkan Harga Produk" />
                    </li>
    
    
                    <li>
                        <label for="qty_produk" class="required">Quantity Saat ini</label>
                        <input readonly type="text" size="30" maxlength="20" id="qty_produk" name="qty_produk" value="<?php echo "$row[qty_produk]"; ?>" class="k-textbox" placeholder="Masukkan Quantity Produk" required validationMessage="Mohon Masukkan Quantity Produk" />
                    </li> -->


                <li>
                    <label for="qty_produk" class="required">Kurang Quantity </label>
                    <input type="text" size="30" maxlength="20" id="qty_produk" name="qty_produkz" value="" class="k-textbox" placeholder="Masukkan Nilai Quantity" required validationMessage="Mohon Masukkan Nilai Quantity" />
                </li>
                <li>
                    <label for="nama" class="required">ID user</label>
                    <input type="text" size="30" maxlength="40" id="created_by" name="created_by" class="k-textbox" value="<?= $_SESSION['adminmembership'] ?>" readonly />
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
        mysqli_query($conn, "DELETE FROM tb_produk WHERE id_produk='$_GET[id]'");
        echo '<script>setTimeout(\'location.href="?modul=datakonfirmasi&aksi=tampil"\' ,0);</script>';
        break;

    case "input":

        $query = mysqli_query($conn, "select * from tb_produk where kode_produk = '$_POST[kode_produk]'");
        $tampil = mysqli_fetch_row($query);
        if ($tampil > 0) {
            echo '<script>alert(\'Data Dengan Kode Paket ini Sudah Ada . . !\')
        setTimeout(\'location.href="?modul=datakonfirmasi&aksi=tambahdataproduk"\' ,0);</script>';
        } else {
            $sql = "INSERT INTO tb_produk (kode_produk, nama_produk, harga_produk, qty_produk, created_at, update_at, created_by) VALUES('$_POST[kode_produk]', '$_POST[nama_produk]', '$_POST[harga_produk]', '$_POST[qty_produk]',NOW(), NOW(),'$_POST[created_by]')";

            if (mysqli_query($conn, $sql)) {
                echo '<script>alert(\'Data Berhasil Dimasukkan.\')
                setTimeout(\'location.href="?modul=datakonfirmasi&aksi=tampil"\' ,0);</script>';
            } else {
                echo mysqli_error($conn) . "<input type='button' onclick=self.history.back() value='Kembali'/>";
                // echo "Gagal Memasukkan Database,</br>
                //         Pastikan Data Yang Dimasukkan Benar.</br>
                //         <input type='button' onclick=self.history.back() value='Kembali'/>";
            }

            mysqli_close($conn);
            // if (!$sql) {
            //     echo mysqli_error();
            //     echo "Gagal Memasukkan Database,</br>
            // Pastikan Data Yang Dimasukkan Benar.</br>
            // <input type='button' onclick=self.history.back() value='Kembali'/>";
            // } else {
            //     echo '<script>alert(\'Data Berhasil Dimasukkan.\')
            //     setTimeout(\'location.href="?modul=datakonfirmasi&aksi=tampil"\' ,0);</script>';
            // }
        }
        break;

        //UPDATE 
    case "update":
        mysqli_query($conn, "UPDATE tb_produk SET kode_produk='$_POST[kode_produk]',
    nama_produk='$_POST[nama_produk]',
    harga_produk='$_POST[harga_produk]'		
                where id_produk='$_POST[id_produk]'");
        echo '<script>alert(\'Data Berhasil Diedit\')
        setTimeout(\'location.href="?modul=datakonfirmasi&aksi=tampil"\' ,0);</script>';
        break;

    case "tambahqty_produk":
        $qty = $_POST['qty_produk'];
        $qty_tambah = $_POST['qty_produkz'];
        $updater = $_POST['created_by'];

        $a = $qty + $qty_tambah;

        // var_dump($a);
        // die();

        mysqli_query($conn, "UPDATE tb_produk SET qty_produk='$a',updated_by ='$updater'	
                    where id_produk='$_POST[id_produk]'");
        echo '<script>alert(\'Data Berhasil Diedit\')
            setTimeout(\'location.href="?modul=datakonfirmasi&aksi=tampil"\' ,0);</script>';
        break;

    case "kurangqty_produk":
        $stock = $_POST['qty_produk'];
        $qty_kurang = $_POST['qty_produkz'];
        $updater = $_POST['created_by'];

        $a = $stock - $qty_kurang;

        // var_dump($a);
        // die();

        if ($stock < $qty_kurang) {
            echo '<script>alert(\'Jumlah Pengurangan Melebihi Stock!\')
            setTimeout(\'location.href="?modul=datakonfirmasi&aksi=kurangproduk"\' ,0);</script>';
        } else {

            mysqli_query($conn, "UPDATE tb_produk SET qty_produk='$a',updated_by ='$updater'		
                        where id_produk='$_POST[id_produk]'");

            $sqlPenjualanProduk = "INSERT INTO tbl_penjualan_produk (id_produk, jumlah, created_at, created_by) VALUES('$_POST[id_produk]', '$qty_kurang', NOW(),'$_POST[created_by]')";

            if (mysqli_query($conn, $sqlPenjualanProduk)) {
                echo '<script>alert(\'Data Berhasil Diedit\')
                setTimeout(\'location.href="?modul=datakonfirmasi&aksi=tampil"\' ,0);</script>';
            } else {
                echo mysqli_error($conn) . "<input type='button' onclick=self.history.back() value='Kembali'/>";
            }
        }
        break;
}


?>

<br>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>