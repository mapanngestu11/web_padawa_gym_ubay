  <?php
  include "../../koneksi/koneksi.php";
  $sql_limit = "SELECT tbl_penjualan_produk.*, tb_produk.nama_produk AS nama_produk,tb_produk.update_at, tb_produk.kode_produk AS kode_produk, tb_produk.harga_produk AS harga_produk FROM tbl_penjualan_produk JOIN tb_produk ON tbl_penjualan_produk.id_produk = tb_produk.id_produk ORDER BY tbl_penjualan_produk.created_at ASC";
  $query = mysqli_query($conn, $sql_limit);

  echo "<center>
<h3>LAPORAN DATA PEMBAYARAN <br>(Transaksi Pembayaran Member)</h3>
<br><br>
<table id='tabel' style='width:900px' border='1'>
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
    $pecah2 = explode("-", $tampil['update_at']);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 = $pecah2[0];
    if ($month2 == "01") {
      $bulan = "Januari";
    } elseif ($month2 == "02") {
      $bulan = "Februari";
    } elseif ($month2 == "03") {
      $bulan = "Maret";
    } elseif ($month2 == "04") {
      $bulan = "April";
    } elseif ($month2 == "05") {
      $bulan = "Mei";
    } elseif ($month2 == "06") {
      $bulan = "Juni";
    } elseif ($month2 == "07") {
      $bulan = "Juli";
    } elseif ($month2 == "08") {
      $bulan = "Agustus";
    } elseif ($month2 == "09") {
      $bulan = "September";
    } elseif ($month2 == "10") {
      $bulan = "Oktober";
    } elseif ($month2 == "11") {
      $bulan = "November";
    } elseif ($month2 == "12") {
      $bulan = "Desember";
    }
    echo "<td>$tampil[update_at]</td>";
    echo "<td>$tampil[created_by]</td>";
    $no++;
    error_reporting(0);
    $total += $totalPendapatan;
  }
  echo "</tr>
  <tr><td style='text-align:right' colspan='5'><b><i>TOTAL </b></i></td><td style='text-align:right'><b>Rp" . number_format($total, 2, ',', '.') . "</b></td><td colspan='2'><b>" . ucwords(Terbilang($total)) . " Rupiah</b></td>
  </tr>";
  echo "</table></center></br>";
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