  <?php
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Data_Pembayaran.xls");
  include "../../koneksi/koneksi.php";
  $sql_limit = "SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) and (tbl_trans_deposit.status_setujukonfirmasi = 'Y') ORDER BY id_transaksi DESC";
  $query = mysqli_query($conn, $sql_limit);

  echo "<center>
<h3>LAPORAN DATA PEMBAYARAN <br>(Transaksi Pembayaran Member)</h3>
<br><br>
<table id='tabel' style='width:900px' border='1'>
<tr align='center'>
<td width='2%'>No</td>
<td>ID TRANSAKSI</td>
<td>ID MEMBER</td>
<td>Nama Member</td>
<td>Jumlah Transaksi</td>
<td>Tanggal Transaksi</td>
<td>Keterangan</td>
";

  $no = 1;
  $baris = 1;
  while ($tampil = mysqli_fetch_array($query)) {
    echo "<tr>";
    echo "<td><center>$no</center></td>";
    echo "<td>$tampil[id_transaksi]</td>";
    echo "<td>$tampil[id_member]</td>";
    echo "<td><center>$tampil[username]</center></td>";
    echo "<td style='text-align:right'>Rp" . number_format($tampil['jumlah_deposit'], 2, ',', '.') . "</td>";
    $pecah2 = explode("-", $tampil['tanggal_transaksi']);
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
    echo "<td>$date2 $bulan $year2</td>";
    echo "<td>$tampil[ket]</td>";
    $no++;
    error_reporting(0);
    $total += $tampil['jumlah_deposit'];
  }
  echo "</tr>
  <tr><td style='text-align:right' colspan='4'><b><i>TOTAL </b></i></td><td style='text-align:right'><b>Rp" . number_format($total, 2, ',', '.') . "</b></td><td colspan='2'><b>" . ucwords(Terbilang($total)) . " Rupiah</b></td>
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