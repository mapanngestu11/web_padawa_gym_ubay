<?php
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo"<table border='0' cellpadding='10px' style='border-collapse:collapse;width:500px; color:white; font-size:9px; background-color:#c22e2e' id='tabel'>";
echo"<tr>
<td align=center><i>Setelah Konfirmasi Pembayaran Dilakukan pada menu ini, Selanjutnya kontrol transaksi atau admin akan mengecek, lalu melakukan persetujuan konfirmasi pada menu PERSETUJUAN KONFIRMASI MEMBER yang berarti konfirmasi pembayaran iyuran member di anggap sah.</i></td>
</tr>";
echo"</table>";


echo '
		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID TRANSAKSI</th>
                        <th>ID MEMBER</th>
						 <th>Kode Tarif</th>
						<th>Nama Member</th>
						<th>Jumlah Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th>Tanggal Berlaku</th>
						<th>Invoice</th>
						<th>Keterangan</th>
						<th>Konfirmasi'.$_SESSION["adminmembership"].'</th>
                    </tr>
                </thead>
                <tbody>';
				
                                 if($_SESSION['levelmembership']=="member"){      
								 $tmpiluser = mysqli_fetch_array(mysqli_query($conn,"select id_member from tbl_member where user = '$_SESSION[adminmembership]'"));
					          $sql = mysqli_query($conn,"SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) and (tbl_trans_deposit.status_persetujuan = 'Y') and (tbl_trans_deposit.id_member = '$tmpiluser[id_member]') ORDER BY id_transaksi DESC");
							  }else{
							   $sql = mysqli_query($conn,"SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) and (tbl_trans_deposit.status_persetujuan = 'Y') ORDER BY id_transaksi DESC");
							  }
					          $no = 1;
                    while ($r = mysqli_fetch_array($sql)) {
                      echo "<tr>
                            <td width=40>$no</td>
                            <td>$r[id_transaksi]</td>
                            <td>$r[id_member]</td>
							<td>$r[kode_tarif]</td>
							<td>$r[nama]</td>
                            <td>Rp".number_format($r['jumlah_deposit'],2,',','.')."</td>";
							$pecah3 = explode("-", $r['tanggal_transaksi']);
$date3 = $pecah3[2];
$month3 = $pecah3[1];
$year3 = $pecah3[0];
if ($month3=="01"){
$bulan2 = "Januari";
}elseif($month3=="02"){
$bulan2 = "Februari";
}elseif($month3=="03"){
$bulan2 = "Maret";
}elseif($month3=="04"){
$bulan2 = "April";
}elseif($month3=="05"){
$bulan2 = "Mei";
}elseif($month3=="06"){
$bulan2 = "Juni";
}elseif($month3=="07"){
$bulan2 = "Juli";
}elseif($month3=="08"){
$bulan2 = "Agustus";
}elseif($month3=="09"){
$bulan2 = "September";
}elseif($month3=="10"){
$bulan2 = "Oktober";
}elseif($month3=="11"){
$bulan2 = "November";
}elseif($month3=="12"){
$bulan2 = "Desember";
}
							echo "<td>$date3 $bulan2 $year3</td>";
							$pecah2 = explode("-", $r['tanggal_berlaku']);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
if ($month2=="01"){
$bulan1 = "Januari";
}elseif($month2=="02"){
$bulan1 = "Februari";
}elseif($month2=="03"){
$bulan1 = "Maret";
}elseif($month2=="04"){
$bulan1 = "April";
}elseif($month2=="05"){
$bulan1 = "Mei";
}elseif($month2=="06"){
$bulan1 = "Juni";
}elseif($month2=="07"){
$bulan1 = "Juli";
}elseif($month2=="08"){
$bulan1 = "Agustus";
}elseif($month2=="09"){
$bulan1 = "September";
}elseif($month2=="10"){
$bulan1 = "Oktober";
}elseif($month2=="11"){
$bulan1 = "November";
}elseif($month2=="12"){
$bulan1 = "Desember";
}
							echo "<td>$date2 $bulan1 $year2</td>";
							 echo'<td><a href=\'javascript:window.open("modul/transaksi/cetakinvoice.php?id_transaksi='.$r['id_transaksi'].'", "WinC'.$r['id_transaksi'].'",
"width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no")\'>Invoice</a></td>';
							if ($r['status_konfirmasitagihan']=="N"){
							echo "<td><div style='color:red; font-weight:bold'>BELUM KONFIRM</div></td>";
							echo"<td><b><a href='?modul=tagihan&aksi=konfirmasi&id_transaksi=".$r['id_transaksi']."&id_member=".$r['id_member']."&nama=".$r['nama']."&jumlah_deposit=".$r['jumlah_deposit']."&tanggal_transaksi=".$r['tanggal_transaksi']."&tanggal_berlaku=".$r['tanggal_berlaku']."'>KONFIRMASI</a></b></td>";
							}else{
							echo "<td><div style='color:blue; font-weight:bold'>DIKONFIRMASI</div></td>";
							echo"<td><b><a href='?modul=tagihan&aksi=konfirmasi&id_transaksi=".$r['id_transaksi']."&id_member=".$r['id_member']."&nama=".$r['nama']."&jumlah_deposit=".$r['jumlah_deposit']."&tanggal_transaksi=".$r['tanggal_transaksi']."&tanggal_berlaku=".$r['tanggal_berlaku']."'>KONFIRM ULANG</a></b></td>";
							}
						  
							echo "
                            </tr>";
							
                      $no++;
                    }                    
                    echo "
                </tbody>
         </table>";
break;

case "konfirmasi":
echo '<div class="container2">';
	echo'
<form id="contactform" class="rounded" method="post" enctype="multipart/form-data" action="?modul=tagihan&aksi=simpankonfirmasi">';
echo '<div id="papanpanel2">
	<h3>Konfirmasi Pembayaran Member</h3>
	</div>  ';
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
?>
       
        <div id="tickets">
            <ul>
			 <li>
                    <label for="id_transaksi" class="required">ID Transaksi</label>
                    <input type="text" size="30" id="id_transaksi" name="id_transaksi" class="k-textbox" value="<?php echo "$_GET[id_transaksi]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
			 <li>
                    <label for="id_member" class="required">ID Member</label>
                    <input type="text" size="30" id="id_member" name="id_member" class="k-textbox" value="<?php echo "$_GET[id_member]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
				 <li>
                    <label for="nama" class="required">Nama Member</label>
                    <input type="text" size="30" id="nama" name="nama" class="k-textbox" value="<?php echo "$_GET[nama]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
                <li>
                    <label for="jumlah_deposit" class="required">Jumlah Deposit</label>
                    Rp<input type="text" size="30" id="jumlah_deposit" name="jumlah_deposit" class="k-textbox" value="<?php echo "$_GET[jumlah_deposit]"; ?>" readonly="readonly" style="background:transparent; color:GREY"/>
                </li>
				<li>
                    <label for="transfer_dari" class="required">Transfer Dari Bank</label>
                    <input type="text" size="30" maxlength="40" id="transfer_dari" name="transfer_dari" class="k-textbox" placeholder="Masukkan Data" required validationMessage="Masukkan Data" />
                </li>
				<li>
                    <label for="bank_tujuan" class="required">Bank Tujuan</label>
                    <input type="text" size="30" maxlength="40" id="bank_tujuan" name="bank_tujuan" class="k-textbox" placeholder="Masukkan Data" required validationMessage="Masukkan Data" />
                </li>
				<li>
                    <label for="nama_pemilik" class="required">Pemilik Rekening</label>
                    <input type="text" size="30" maxlength="40" id="nama_pemilik" name="nama_pemilik" class="k-textbox" placeholder="Masukkan Data" required validationMessage="Masukkan Data" />
                </li>
				<li>
                    <label for="jumlah_transfer" class="required">Jumlah Transfer</label>
                    <input type="text" size="30" maxlength="40" id="jumlah_transfer" name="jumlah_transfer" class="k-textbox" placeholder="Masukkan Data" required validationMessage="Masukkan Data" />
                </li>
				 <li>
                    <label for="tanggal_transfer" class="required">Tanggal Transfer</label>
                    <input type="text" size="30" maxlength="40" id="tanggal_transfer" readonly="1" name="tanggal_transfer" class="k-textbox" placeholder="Tanggal Transfer" required validationMessage="Mohon Masukkan Tanggal Transfer" /></br><span style="padding-left:130px"></span>
		<script>	
            $(document).ready(function() {
				$("#tanggal_transfer").kendoDatePicker({
                format: "yyyy-MM-dd"
                });
            });
        </script>
                </li>
				<li>
                    <label for="keterangan" class="required">Keterangan Transfer</label>
                    <textarea name="keterangan" id="alamat" class="k-textbox" placeholder="Isi Keterangan" required validationMessage="Please enter {0}"></textarea>
                </li>
                <li  class="accept">
                    <button class="k-button" type="submit">Submit</button>&nbsp&nbsp&nbsp
					<button class="k-button" onclick="self.history.back()" type="button">Batal</button>
                </li
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

case "simpankonfirmasi":
		
		$sql = mysqli_query($conn,"INSERT INTO tbl_konfirmasi VALUES(
						NULL,
						'$_POST[id_transaksi]',
						'$_POST[id_member]',
						'$_POST[transfer_dari]',
						'$_POST[bank_tujuan]',
						'$_POST[nama_pemilik]',
						'$_POST[jumlah_transfer]',
						'$_POST[tanggal_transfer]',
						'$_POST[keterangan]'
						)"); 	
if($sql){
echo '<script>alert(\'Konfirmasi Pembayaran Berhasil Dilakukan\')
	setTimeout(\'location.href="?modul=tagihan&aksi=tampil"\' ,0);</script>';
	mysqli_query($conn,"UPDATE tbl_trans_deposit SET
status_konfirmasitagihan = 'Y'
where id_transaksi ='$_POST[id_transaksi]'");
	}else{
	echo '<script>alert(\'Konfirmasi Gagal!\')
setTimeout(\'location.href="?modul=tagihan&aksi=tampil"\' ,0);</script>';
	}
	

	
	
break;

	}



?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>