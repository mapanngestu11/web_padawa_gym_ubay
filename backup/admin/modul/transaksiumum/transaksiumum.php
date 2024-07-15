<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER


//INTERFACE TAMBAH
case "tambahtransaksi":

echo '<div class="container2">';

	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=transaksiumum&aksi=input">';
echo '<div id="papanpanel2">

	<h3>Tambah Transaksi</h3>
	</div>  ';   
echo"</br>
";

echo"<table border='0' cellpadding='10px' style='border-collapse:collapse;width:500px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";




echo"</table>
";

?>
       
        <div id="tickets">
            <ul>
              <li>
                    <label for="kode_tarif" class="required">ID Member</label>
                     <select id="id_member" required style='width:500px' name="id_member">
					 <?php
					 echo "<option value=''>--Pilih Member--</option>";
					 $quer1 = mysqli_query($conn,"select id_member,nama from tbl_member order by id_member ASC");
					while($tmpkode = mysqli_fetch_array($quer1)){
					 
					 echo "<option value='$tmpkode[id_member]'>$tmpkode[id_member]-$tmpkode[nama]</option>";
					}
					date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
                ?>
            </select>
			</li>
			<li>
                    <label for="id_trainer" class="required">ID Trainer</label>
                     <select id="id_trainer" required style='width:500px' name="id_trainer">
					 <?php
					 echo "<option value=''>--Pilih Trainer--</option>";
					 $quer1 = mysqli_query($conn,"select id_trainer,nama from tbl_trainer order by id_trainer ASC");
					while($tmpkode = mysqli_fetch_array($quer1)){
					 
					 echo "<option value='$tmpkode[id_trainer]'>$tmpkode[id_trainer]-$tmpkode[nama]</option>";
					}
					
                ?>
            </select>
			</li>
			<li>
                    <label for="jumlah_bayar" class="required">Tarif</label>
                    <input type="text" id="jumlah_bayar" style='width:300px' maxlength="10" name="jumlah_bayar" class="k-textbox" placeholder="Masukkan Jumlah Bayar (Tarif)" required
                        validationMessage="Masukkan Jumlah Bayar !!"/>
</li>
               <li>
                    <label for="tanggal_transaksi" class="required">Tanggal Transaksi</label>
                    <input type="text" size="30" maxlength="40" id="tanggal_transaksi" readonly="1" name="tanggal_transaksi" value="<?php echo $tglsekarang; ?>" class="k-textbox" placeholder="Tanggal Transaksi" required validationMessage="Mohon Masukkan Tanggal" /></br><span style="padding-left:130px"></span>
						<script>	
            $(document).ready(function() {
				$("#tanggal_transaksi").kendoDatePicker({
                format: "yyyy-MM-dd"
                });
            });
        </script>
					
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
               

           
                    $("#bulan").kendoDropDownList();

                  

                  
                });
            </script>
			
					<script>
                $(document).ready(function() {
               

           
                    $("#id_member").kendoDropDownList();
                    $("#id_trainer").kendoDropDownList();

                  

                  
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



//INPUT 
case "input":
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);


		$sql = mysqli_query($conn,"INSERT INTO tbl_trans_umum VALUES(
		NULL,
						'$_POST[id_member]',
						'$_POST[id_trainer]',
						'$_POST[jumlah_bayar]',
						'$_POST[tanggal_transaksi]')"); 	
						
								
		if (!$sql)
		{
		echo mysqli_error();
		echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
		
		}else
		{

		
		echo '<script>alert(\'Data Berhasil Dimasukkan. Periksa data di CETAK LAPORAN TRANSAKSI UMUM \')
			setTimeout(\'location.href="?modul=transaksiumum&aksi=tambahtransaksi"\' ,0);</script>';
			
		}	 
	
break;
}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>