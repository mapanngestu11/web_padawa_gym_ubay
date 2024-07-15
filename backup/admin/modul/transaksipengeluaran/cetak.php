<?php
include "../../koneksi/koneksi.php";
$sql_limit = "SELECT * FROM tb_transaksipengeluaran ORDER BY id DESC";
$query = mysqli_query($conn, $sql_limit);

echo "<center>
<h3>LAPORAN DATA PENGELUARAN <br>(Transaksi Pengeluaran)</h3>
<br><br>
<table id='tabel' style='width:900px' border='1'>
<td width='10%'><center>No</center></td>
<th>Tanggal</th>
<th>Jam</th>
<th>In Charge</th>
<th>Nama transaksi Pengeluaran</th>
<th>Nominal</th>
";

$no = 1;
$baris = 1;
while ($tampil = mysqli_fetch_array($query)) {
  $totalPendapatan = $tampil['jumlah'] * $tampil['harga_produk'];
  $tanggal = date('d/M/Y', strtotime($tampil['created_at']));
  $jam = date('H:i:s', strtotime($tampil['created_at']));

  echo "<tr>";
  echo "<td><center>$no</center></td>";
  echo "<td>$tanggal</td>";
  echo "<td><center>$jam</center></td>";
  echo "<td><center>$tampil[created_by]</center></td>";
  echo "<td>$tampil[nama_transaksi]</td>";
  echo "<td style='text-align:right'>Rp" . number_format($tampil['nominal'], 2, ',', '.') . "</td>";
  $no++;
  error_reporting(0);
  $total += $tampil['nominal'];
}
echo "</tr>
  <tr><td style='text-align:right' colspan='5'><b><i>TOTAL </b></i></td><td style='text-align:right'><b>Rp" . number_format($total, 2, ',', '.') . "
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
