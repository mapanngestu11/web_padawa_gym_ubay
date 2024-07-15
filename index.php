<?php session_start(); 
if (!isset($_SESSION['adminmembership'])){
echo '<head>
  <title>Login Admin</title>
  <link rel="shortcut icon" href="href="assets/favicon1.ico">
  <link rel="stylesheet" href="admin/css/style-login.css ">
  
</head>
<body>
';

echo '<center>
<div style="border:4px solid white; width:350px; padding-top:20px; margin:100px">
<img id="reflection" src="admin/images/logot.png" width="70px" height="70px"/></br></br></br>
<form action="admin/loginadmin/aksilogin.php" method="POST">
<table border=0>
<tr>
<td>Login</td><td><select name="level">
<option value="admin">Admin</option>
<option value="Karyawan">Karyawan</option>
<option value="manajer">manajer</option>
</select>
</td>
</tr>
<tr>
<td>Username</td><td><input type="text" name="username"/></td>
</tr>
<tr>
<td>Password</td><td><input type="password" name="password"/></td>
</tr>
</table>
  <div class="container">
    <input type="submit" class="button" value="Login">
  </form>
  </div>
</div>
  </center>';
  
echo '
</body>
</html>';

}else{?>
<html lang="en-US">
<head>
<link rel="shortcut icon" href="href="assets/favicon1.ico">
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>Pandawa Fitnes & Aerobic | Admin</title>
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/icons/icomoon/styles.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" charset="utf-8" src="js/nav.js"></script>
    <link href="admin/plugin/kendo/styles/kendo.common.min.css" rel="stylesheet">
    <link href="admin/plugin/kendo/styles/kendo.default.min.css" rel="stylesheet">
	<link href="admin/plugin/kendo/content/shared/styles/examples-offline.css" rel="stylesheet">
    <script src="admin/plugin/kendo/js/kendo.web.min.js"></script>
    <script src="admin/plugin/kendo/content/shared/js/console.js"></script>
	<script type="text/javascript" src="plugin/Charts/jquery.fusioncharts.js" ></script>
	
	<style type="text/css">
            @import "admin/plugin/media/css/demo_table_jui.css";
            @import "admin/plugin/media/themes/sunny/jquery-ui-1.8.4.custom.css";
    </style>      
        <script src="admin/plugin/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf-8">
          $(document).ready(function(){
            $('#datatables').dataTable({
					     "oLanguage": {
						      "sLengthMenu": "Tampilkan _MENU_ data per halaman",
						      "sSearch": "Pencarian: ", 
						      "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
						      "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
						      "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
						      "sInfoFiltered": "(di filter dari _MAX_ total data)",
						      "oPaginate": {
						          "sFirst": "<<",
						          "sLast": ">>", 
						          "sPrevious": "<", 
						          "sNext": ">"
					       }
				      },
              "sPaginationType":"full_numbers",
              "bJQueryUI":true
            });
          })    
        </script>
</head>

<body>
  <div id="w">
    <div id="papanpanel">
    <img src="images/pandawa.jpg" width="500px" height="50px"/>

	</div>    
	<?php 
		include "koneksi/koneksi.php";
		include "menu/menu.php";
		
	?>
  </div>
  <div id="content">
  <br>
  <br>
  <br>
  <?php
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
error_reporting(0);
switch($_GET['modul']){
default:
include "admin/modul/dashboard/dashboard.php";
break;
case 'user':
include 'admin/modul/user/user.php';
break;
case 'member':
include 'admin/modul/member/member.php';
break;
case 'trainer':
include 'admin/modul/trainer/trainer.php';
break;
case 'detailmember':
include 'admin/modul/detailmember/detailmember.php';
break;
case 'tarif':
include 'admin/modul/tarif/tarif.php';
break;
case 'persetujuan':
include 'admin/modul/persetujuan/persetujuan.php';
break;
case 'tagihan':
include 'admin/modul/tagihan/tagihan.php';
break;
case 'persetujuankonfirmasi':
include 'admin/modul/persetujuankonfirmasi/persetujuankonfirmasi.php';
break;
case 'transaksi':
include 'admin/modul/transaksi/transaksi.php';
break;
case 'datakonfirmasi':
include 'admin/modul/datakonfirmasi/datakonfirmasi.php';
break;
case 'tambahdeposit':
include 'admin/modul/tambahdeposit/tambahdeposit.php';
break;
case 'transaksiumum':
include 'admin/modul/transaksiumum/transaksiumum.php';
break;
case 'myprofile':
include 'admin/modul/myprofile/myprofile.php';
break;
case 'identitas':
include 'admin/modul/identitas/identitas.php';
break;
case 'rekmember':
include 'admin/modul/rekmember/rekmember.php';
break;
case 'statistik':
include 'admin/modul/statistik/statistik.php';
break;
case 'statistiktransaksi':
include 'admin/modul/statistiktransaksi/statistiktransaksi.php';
break;
case 'lapkeuangan':
include 'admin/modul/lapkeuangan/lapkeuangan.php';
break;
case 'laptransumum':
include 'admin/modul/laptransumum/laptransumum.php';
break;
case 'lapkonfirmasi':
include 'admin/modul/lapkonfirmasi/lapkonfirmasi.php';
break;
case 'menunggu_konfirmasi':
include 'admin/modul/menunggu_konfirmasi/menunggu_konfirmasi.php';
break;
case 'web_halaman':
include 'admin/modul/web_halaman/web_halaman.php';
break;
case 'web_contactus':
include 'admin/modul/web_contactus/web_contactus.php';
break;
case 'web_testimoni':
include 'admin/modul/web_testimoni/web_testimoni.php';
break;
case 'lappenjualan':
  include 'admin/modul/lappenjualan/lappenjualan.php';
  break;
case 'transaksi':
  include 'admin/modul/transaksi/transaksi.php';
  break;
}

  ?>
	<?php 
}	?>	
  </div>
</body>
</html>