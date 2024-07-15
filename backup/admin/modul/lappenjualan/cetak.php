<html>

<head>
  <title>Laporan Data Penjualan Produk</title>
  <style>
    #tabel {
      font-size: 15px;
      border-collapse: collapse;
    }

    #tabel td {
      padding-left: 5px;
      border: 1px solid black;
    }
  </style>
</head>

<body>
  <?php
  include "../../koneksi/koneksi.php";
  $sql_limit = "SELECT tbl_penjualan_produk.*, tb_produk.nama_produk AS nama_produk,tb_produk.update_at, tb_produk.kode_produk AS kode_produk, tb_produk.harga_produk AS harga_produk FROM tbl_penjualan_produk JOIN tb_produk ON tbl_penjualan_produk.id_produk = tb_produk.id_produk WHERE (tbl_penjualan_produk.created_at between '$_POST[dari]' and '$_POST[sampai]') ORDER BY tbl_penjualan_produk.created_at ASC";


  $query = mysqli_query($conn, $sql_limit);
  $query2 = mysqli_query($conn, $sql_limit);
  $cek = mysqli_fetch_array($query2);

  // var_dump($cek);
  // die();

  if (empty($cek['id_penjualan_produk'])) {
    echo '<script>alert(\'Data Tidak Ada\')
      window.close()</script>';
  }

  $sub = substr($_POST['dari'], 1, 1);

  $pecah4 = explode("-", $_POST['dari']);
  $date4 = $pecah4[2];
  $month4 = $pecah4[1];
  $year4 = $pecah4[0];

  if ($month4 == "01") {
    $bulan2 = "Januari";
  } elseif ($month4 == "02") {
    $bulan2 = "Februari";
  } elseif ($month4 == "03") {
    $bulan2 = "Maret";
  } elseif ($month4 == "04") {
    $bulan2 = "April";
  } elseif ($month4 == "05") {
    $bulan2 = "Mei";
  } elseif ($month4 == "06") {
    $bulan2 = "Juni";
  } elseif ($month4 == "07") {
    $bulan2 = "Juli";
  } elseif ($month4 == "08") {
    $bulan2 = "Agustus";
  } elseif ($month4 == "09") {
    $bulan2 = "September";
  } elseif ($month4 == "10") {
    $bulan2 = "Oktober";
  } elseif ($month4 == "11") {
    $bulan2 = "November";
  } elseif ($month4 == "12") {
    $bulan2 = "Desember";
  }

  $pecah5 = explode("-", $_POST['sampai']);
  $date5 = $pecah5[2];
  $month5 = $pecah5[1];
  $year5 = $pecah5[0];
  if ($month5 == "01") {
    $bulan5 = "Januari";
  } elseif ($month5 == "02") {
    $bulan5 = "Februari";
  } elseif ($month5 == "03") {
    $bulan5 = "Maret";
  } elseif ($month5 == "04") {
    $bulan5 = "April";
  } elseif ($month5 == "05") {
    $bulan5 = "Mei";
  } elseif ($month5 == "06") {
    $bulan5 = "Juni";
  } elseif ($month5 == "07") {
    $bulan5 = "Juli";
  } elseif ($month5 == "08") {
    $bulan5 = "Agustus";
  } elseif ($month5 == "09") {
    $bulan5 = "September";
  } elseif ($month5 == "10") {
    $bulan5 = "Oktober";
  } elseif ($month5 == "11") {
    $bulan5 = "November";
  } elseif ($month5 == "12") {
    $bulan5 = "Desember";
  }

  $dari = "$date4 $bulan2 $year4";
  $sampai = "$date5 $bulan5 $year5";

  echo "<center>
      <h3>LAPORAN DATA PENJUALAN</h3>
      Dari Tanggal \"$dari\" Sampai \"$sampai\"<br><br>
      <table id='tabel' style='width:900px' border='1'>
      <tr align='center'>
      <td width='10%'>No</td>
      <td width='10%'>Kode Produk</td>
      <td width='20%'>Nama Produk</td>
      <td width='20%'>Harga Produk</td>
      <td width='10%'>Jumlah Penjualan</td>
      <td width='10%'>Total Pendapatan</td>
      <td width='20%'>Waktu Penjualan</td>
	  <td width='20%'>In Charge</td>
    ";

  $no = 1;
  $baris = 1;

  while ($tampil = mysqli_fetch_array($query)) {
    $totalPendapatan = $tampil['jumlah'] * $tampil['harga_produk'];

    echo "<tr>";
    echo "<td>$no</td>";
    echo "<td>$tampil[kode_produk]</td>";
    echo "<td>$tampil[nama_produk]</td>";
    echo "<td style='text-align:right'>Rp" . number_format($tampil['harga_produk'], 2, ',', '.') . "</td>";
    echo "<td>$tampil[jumlah]</td>";
    echo "<td style='text-align:right'>Rp" . number_format($totalPendapatan, 2, ',', '.') . "</td>";
    echo "<td>$tampil[update_at]</td>";
	echo "<td>$tampil[created_by]</td>";

    $no++;
    error_reporting(0);
    $total += $totalPendapatan;
  }
  echo "</tr>
    <tr><td style='text-align:right' colspan='6'><b><i>TOTAL </b></i></td><td style='text-align:right'><b>Rp" . number_format($total, 2, ',', '.') . "
    </tr>";
  echo "</table></center></br></body>";

  function Terbilang($x)
  {
    $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($x < 12)
      return " " . $abil[$x];
    elseif ($x < 20)
      return Terbilang($x - 10) . "belas";
    elseif ($x < 100)
      return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
    elseif ($x < 200)
      return " seratus" . Terbilang($x - 100);
    elseif ($x < 1000)
      return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
    elseif ($x < 2000)
      return " seribu" . Terbilang($x - 1000);
    elseif ($x < 1000000)
      return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
    elseif ($x < 1000000000)
      return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
  }
  ?>

</html>