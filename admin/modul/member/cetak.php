  <?php
  include "../../koneksi/koneksi.php";
  $sql_limit = "SELECT * FROM tbl_member ORDER BY id_member DESC";
  $query = mysqli_query($conn, $sql_limit);

  echo "<center>
<h3>LAPORAN DATA MEMBER <br>(Data Member)</h3>
<br><br>
<table id='tabel' style='width:900px' border='1'>
<tr align='center'>
<td width='2%'>No</td>
<th>No ID CARD</th>
<th>Nomer Kartu</th>
<th>Nama Member</th>
<th>Tanggal Daftar Member</th>
<th>Status Member</th>
";

  $no = 1;
  $baris = 1;
  while ($tampil = mysqli_fetch_array($query)) {
    echo "<tr>";
    echo "<td><center>$no</center></td>";
    echo "<td>$tampil[nama]</td>";
    echo "<td>$tampil[pekerjaan]</td>";
    echo "<td><center>$tampil[username]</center></td>";
    $pecah2 = explode("-", $tampil['tanggal_daftar']);
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
    $tampilcek = mysqli_fetch_array(mysqli_query($conn, "SELECT id_member,TIMESTAMPDIFF(DAY,current_date,tanggal_berlaku) as wew from tbl_deposit where id_member = '$tampil[id_member]' and TIMESTAMPDIFF(DAY,current_date,tanggal_berlaku) > 0"));
    if ($tampil['id_member'] == "MBR-UMUM") {
    } else {
      if (empty($tampilcek['id_member']) || empty($tampilcek['wew'])) {
        $status = '<div style="color:red; font-weight:bold">EXPIRED</div>';
      } else {
        $status = '<div style="color:GREEN; font-weight:bold">AKTIF</div>';
      }
    }
    echo "<td>$status</td>";
    $no++;
    // error_reporting(0);
    // $total += $tampil['jumlah_deposit'];
  }
  //   echo "</tr>
  // <tr><td style='text-align:right' colspan='6'><b><i>TOTAL </b></i></td><td style='text-align:right'><b>Rp" . number_format($total, 2, ',', '.') . "</b></td><td colspan='2'><b>" . ucwords(Terbilang($total)) . " Rupiah</b></td>
  // </tr>";
  echo "</table></center></br>";
  ?>