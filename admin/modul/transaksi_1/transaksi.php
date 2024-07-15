<?php
switch ($_GET['aksi']) {
        //INTERFACE TABLE BROWSER
    case "tampil";
        echo '
            <a href="modul/transaksi/cetak.php" target="_blank" onclick="popup(this);" class="button">Cetak PDF</a>
            <a href="modul/transaksi/cetak_excel.php" target="_blank" onclick="popup(this);" class="button">Cetak Excel</a></br></br>';
        echo '
		<table id="datatables" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID TRANSAKSI</th>
                        <th>ID MEMBER</th>
						<th>Nama Member</th>
						<th>Jumlah Transaksi</th>
						<th>Tanggal Transaksi</th>
						<th>Keterangan</th>
						<th>Cetak Invoice</th>
						<th>Hapus</th>
                    </tr>
                </thead>
                <tbody>';
        /* if ($_SESSION['levelmembership']=="member") {
									   $sql = mysqli_query($conn,"SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) and (tbl_trans_deposit.status_setujukonfirmasi = 'Y') and (tbl_member.user = '$_SESSION[usermembership]') ORDER BY id_transaksi DESC");
									   }else{ */
        $sql = mysqli_query($conn, "SELECT * FROM tbl_trans_deposit,tbl_member where (tbl_member.id_member = tbl_trans_deposit.id_member) and (tbl_trans_deposit.status_setujukonfirmasi = 'Y') ORDER BY id_transaksi DESC");
        // }
        $no = 1;
        while ($r = mysqli_fetch_array($sql)) {
            echo "<tr>
                            <td width=40>$no</td>
                            <td>$r[id_transaksi]</td>
                            <td>$r[id_member]</td>
							<td>$r[username]</td>
                            <td>Rp" . number_format($r['jumlah_deposit'], 2, ',', '.') . "</td>";
            $pecah3 = explode("-", $r['tanggal_transaksi']);
            $date3 = $pecah3[2];
            $month3 = $pecah3[1];
            $year3 = $pecah3[0];
            if ($month3 == "01") {
                $bulan2 = "Januari";
            } elseif ($month3 == "02") {
                $bulan2 = "Februari";
            } elseif ($month3 == "03") {
                $bulan2 = "Maret";
            } elseif ($month3 == "04") {
                $bulan2 = "April";
            } elseif ($month3 == "05") {
                $bulan2 = "Mei";
            } elseif ($month3 == "06") {
                $bulan2 = "Juni";
            } elseif ($month3 == "07") {
                $bulan2 = "Juli";
            } elseif ($month3 == "08") {
                $bulan2 = "Agustus";
            } elseif ($month3 == "09") {
                $bulan2 = "September";
            } elseif ($month3 == "10") {
                $bulan2 = "Oktober";
            } elseif ($month3 == "11") {
                $bulan2 = "November";
            } elseif ($month3 == "12") {
                $bulan2 = "Desember";
            }
            echo "<td>$date3 $bulan2 $year3</td>";
            echo "
                            <td>$r[ket]</td>
						    ";
            echo '<td><a href=\'javascript:window.open("modul/transaksi/cetakinvoice.php?id_transaksi=' . $r['id_transaksi'] . '", "WinC' . $r['id_transaksi'] . '",
"width=1000,height=500,toolbar=no,location=no,directories=no,status=no,menubar=no, scrollbars=no,resizable=yes,copyhistory=no")\'>Print Invoice</a></td>
';
            echo "<td><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=transaksi&aksi=hapus&id_transaksi=" . $r['id_transaksi'] . "'>Hapus</td>";
            echo "
                            </tr>";

            $no++;
        }
        echo "
                </tbody>
         </table>";
        break;

    case "hapus";
        mysqli_query($conn, "DELETE FROM tbl_trans_deposit WHERE id_transaksi ='$_GET[id_transaksi]'");
        echo '<script>setTimeout(\'location.href="?modul=transaksi&aksi=tampil"\' ,0);</script>';
        break;
}



?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>