<html>

<head>
    <title>Scan Kartu</title>
    <link rel="shortcut icon" href="assets/favicon1.ico">
    <link rel="stylesheet" href="css/style-login.css ">
</head>

<style TYPE="text/css">
    .container2 {
        width: 900px;
        background: transparent;
    }

    #contactform {

        width: 900px;
        padding-left: 0px;
        padding-top: 0px;
        background: #f0f0f0;
        overflow: auto;

        border: 5px solid #000000;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border-radius: 7px;

        -moz-box-shadow: 2px 2px 2px #cccccc;
        -webkit-box-shadow: 2px 2px 2px #cccccc;
        box-shadow: 2px 2px 2px #cccccc;

    }

    .field {
        margin-bottom: 3px;
    }

    label {
        font-family: Arial, Verdana;
        text-shadow: 2px 2px 2px #ccc;
        display: block;
        float: left;
        margin-right: 10px;
        text-align: right;
        width: 120px;
        line-height: 20px;
        font-size: 12px;
    }

    .input {
        font-family: Arial, Verdana;
        font-size: 12px;
        padding: 5px;
        border: 1px solid #b9bdc1;
        width: 500px;
        color: #797979;
    }

    .input:focus {
        background-color: #E7E8E7;
    }

    .textarea {
        height: 100px;
    }

    .hint {
        display: none;
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

    #papanpanel2 {
        background: #AF5224;
        width: 100%;
        /* margin: 0px auto 0 auto; */
        color: white;
        /*Some cool shadow and glow effect*/
        box-shadow:
            0 5px 15px 1px rgba(0, 0, 0, 0.6),
            0 0 200px 1px rgba(255, 255, 255, 0.5);
    }

    /*heading styles*/
    #papanpanel2 h3 {
        font-size: 12px;
        line-height: 30px;
        padding: 0 10px;
        margin-bottom: 20px;
        cursor: pointer;
        /*fallback for browsers not supporting gradients*/
        background: #00be48;
        background: linear-gradient(#00be48, #ffffff);
    }
</style>

<?php
include "koneksi.php";
$sql_limit = "SELECT a.*, b.kode_tarif FROM tbl_member as a LEFT JOIN tbl_deposit as b ON b.id_member=a.id_member WHERE a.pekerjaan = '$_POST[id_kartu]' ";
$query = mysqli_query($conn, $sql_limit);

function DateToIndo($date)
{ // fungsi atau method untuk mengubah tanggal ke format indonesia
    // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
    $BulanIndo = array(
        "Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "September",
        "Oktober", "November", "Desember"
    );

    $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
    $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
    $tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring

    $result = $tgl . " " . $BulanIndo[(int)$bulan - 1] . " " . $tahun;
    return ($result);
}
$tampil = mysqli_fetch_array($query);

$sql = mysqli_query($conn, "SELECT * FROM tbl_tarif WHERE kode_tarif = '$tampil[kode_tarif]'  ORDER BY kode_tarif");
$r = mysqli_fetch_array($sql);

?>
<?php

$detail_1 =  mysqli_fetch_array(mysqli_query($conn, "select * from tbl_member,tbl_deposit where tbl_deposit.id_member = tbl_member.id_member and tbl_deposit.id_member = '$tampil[id_member]' and tbl_deposit.kode_tarif = '$r[kode_tarif]'"));

//var_dump($tampil['kode_tarif']);
//die;
if ($tampil['kode_tarif']) {
    if ($detail_1['kuota_latihan'] > '0' && $r['tipe'] == 'REGULAR') {
        mysqli_query($conn, "update tbl_deposit set
            kuota_latihan = kuota_latihan-1
            where id_member = '$tampil[id_member]' and kode_tarif = '$detail_1[kode_tarif]'");
        $detail_member =  mysqli_fetch_array(mysqli_query($conn, "select * from tbl_member,tbl_deposit where tbl_deposit.id_member = tbl_member.id_member and tbl_deposit.id_member = '$tampil[id_member]' and tbl_deposit.kode_tarif = '$r[kode_tarif]'"));
        date_default_timezone_set('Asia/Jakarta');
        $tanggal1 = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang1 = date("Y-m-d", $tanggal1);
        $pecah2 = explode("-", $tglsekarang1);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 = $pecah2[0];
        $sekarang2 = GregorianToJD($month2, $date2, $year2);
        $valid2 = $detail_member['tanggal_berlaku'];
        $pecah3 = explode("-", $valid2);
        $date3 = $pecah3[2];
        $month3 = $pecah3[1];
        $year3 = $pecah3[0];
        $valid3 = GregorianToJD($month3, $date3, $year3);
        $selisih2 = $valid3 - $sekarang2;
        if ($selisih2 < 0 || ($r['tipe'] == "REGULAR" && $detail_member['kuota_latihan'] == 0)) {
            $tanggal_deposit = "<div style='color:red; font-weight:bold'>NONAKTIF</div>";
        } else {
            $pecah2 = explode("-", $detail_member['tanggal_deposit']);
            $date2 = $pecah2[2];
            $month2 = $pecah2[1];
            $year2 = $pecah2[0];
            $tanggal_deposit =  DateToIndo($detail_member['tanggal_deposit']);
        }

        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
        $pecah1 = explode("-", $tglsekarang);
        $date1 = $pecah1[2];
        $month1 = $pecah1[1];
        $year1 = $pecah1[0];
        $sekarang = GregorianToJD($month1, $date1, $year1);
        $valid = $detail_member['tanggal_berlaku'];
        $pecah2 = explode("-", $valid);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 = $pecah2[0];
        $valid2 = GregorianToJD($month2, $date2, $year2);
        $selisih = $valid2 - $sekarang;

        if ($selisih < 0 || ($r['tipe'] == "REGULAR" && $detail_member['kuota_latihan'] == 0)) {
            $tanggal_berlaku =  "<div style='color:red; font-weight:bold'>NONAKTIF</div>";
        } else {
            $tanggal_berlaku =  DateToIndo($detail_member['tanggal_berlaku']);
        }
        if ($selisih < 0 || ($r['tipe'] == "REGULAR" && $detail_member['kuota_latihan'] == 0)) {
            $kuota_latihan = "<div style='color:red; font-weight:bold'>NONAKTIF</div>";
        } else {
            if ($r['tipe'] == "REGULAR") {
                $kuota_latihan = $detail_member['kuota_latihan'];
            } else {
                $kuota_latihan =  "UNLIMITED";
            }
        }
    } elseif ($detail_1['kuota_latihan'] == '0' && $r['tipe'] == 'UNLIMITED') {
        $detail_member =  mysqli_fetch_array(mysqli_query($conn, "select * from tbl_member,tbl_deposit where tbl_deposit.id_member = tbl_member.id_member and tbl_deposit.id_member = '$tampil[id_member]' and tbl_deposit.kode_tarif = '$r[kode_tarif]'"));
        date_default_timezone_set('Asia/Jakarta');
        $tanggal1 = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang1 = date("Y-m-d", $tanggal1);
        $pecah2 = explode("-", $tglsekarang1);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 = $pecah2[0];
        $sekarang2 = GregorianToJD($month2, $date2, $year2);
        $valid2 = $detail_member['tanggal_berlaku'];
        $pecah3 = explode("-", $valid2);
        $date3 = $pecah3[2];
        $month3 = $pecah3[1];
        $year3 = $pecah3[0];
        $valid3 = GregorianToJD($month3, $date3, $year3);
        $selisih2 = $valid3 - $sekarang2;
        if ($selisih2 < 0 || ($r['tipe'] == "REGULAR" && $detail_member['kuota_latihan'] == 0)) {
            $tanggal_deposit = "<div style='color:red; font-weight:bold'>NONAKTIF</div>";
        } else {
            $pecah2 = explode("-", $detail_member['tanggal_deposit']);
            $date2 = $pecah2[2];
            $month2 = $pecah2[1];
            $year2 = $pecah2[0];
            $tanggal_deposit =  DateToIndo($detail_member['tanggal_deposit']);
        }

        date_default_timezone_set('Asia/Jakarta');
        $tanggal = mktime(date("m"), date("d"), date("Y"));
        $tglsekarang = date("Y-m-d", $tanggal);
        $pecah1 = explode("-", $tglsekarang);
        $date1 = $pecah1[2];
        $month1 = $pecah1[1];
        $year1 = $pecah1[0];
        $sekarang = GregorianToJD($month1, $date1, $year1);
        $valid = $detail_member['tanggal_berlaku'];
        $pecah2 = explode("-", $valid);
        $date2 = $pecah2[2];
        $month2 = $pecah2[1];
        $year2 = $pecah2[0];
        $valid2 = GregorianToJD($month2, $date2, $year2);
        $selisih = $valid2 - $sekarang;

        if ($selisih < 0 || ($r['tipe'] == "REGULAR" && $detail_member['kuota_latihan'] == 0)) {
            $tanggal_berlaku =  "<div style='color:red; font-weight:bold'>NONAKTIF</div>";
        } else {
            $tanggal_berlaku =  DateToIndo($detail_member['tanggal_berlaku']);
        }
        if ($selisih < 0 || ($r['tipe'] == "REGULAR" && $detail_member['kuota_latihan'] == 0)) {
            $kuota_latihan = "<div style='color:red; font-weight:bold'>NONAKTIF</div>";
        } else {
            if ($r['tipe'] == "REGULAR") {
                $kuota_latihan = $detail_member['kuota_latihan'];
            } else {
                $kuota_latihan =  "UNLIMITED";
            }
        }
    } else {
        $kuota = "Kuota Latihan Habis";
    }
} else {
    $kuota = "Anda Belum Memilih Paket !";
}


?>

<body style="font-family:tahoma; font-size:8pt;">
    <div>

        <?php if ($tampil['kode_tarif']) { ?>
            <?php if ($detail_1['kuota_latihan'] > '0' && $r['tipe'] == 'REGULAR') { ?>
                <center>
                    <div style="padding-top: 50px;">
                        <span style="font-size: 60px;"><b>PANDAWA GYM</b></span>
                    </div>
                    <div style="padding-top: 50px;">

                    </div>
                    <br>
                    <div id="contactform" class="rounded">
                        <div id="papanpanel2">
                            <h3>Detail Member</h3>
                        </div>

                        <div id="tickets">
                            <div style="padding: 20px;">
                                <table width="100%">
                                    <tbody style="color: #000000;">
                                        <tr>
                                            <td>ID Card</td>
                                            <td>:</td>
                                            <td> <?= $tampil['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>No Kartu</td>
                                            <td>:</td>
                                            <td> <?= $tampil['pekerjaan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td> <?= $tampil['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kuota Latih</td>
                                            <td>:</td>
                                            <td> <?= $kuota_latihan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Deposit Terakhir</td>
                                            <td>:</td>
                                            <td> <?= $tanggal_deposit ?></td>
                                        </tr>
                                        <tr>
                                            <td>Berlaku s/d</td>
                                            <td>:</td>
                                            <td> <?= $tanggal_berlaku ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br></br>
                    <a class="button button-blue" href="scan_kartu.php">Oke</a>
                </center>
            <?php  } elseif ($detail_1['kuota_latihan'] == '0' && $r['tipe'] == 'UNLIMITED') { ?>
                <center>
                    <div style="padding-top: 50px;">
                        <span style="font-size: 60px;"><b>PANDAWA GYM</b></span>
                    </div>
                    <div style="padding-top: 50px;">

                    </div>
                    <br>
                    <div id="contactform" class="rounded">
                        <div id="papanpanel2">
                            <h3>Detail Member</h3>
                        </div>

                        <div id="tickets">
                            <div style="padding: 20px;">
                                <table width="100%">
                                    <tbody style="color: #000000;">
                                        <tr>
                                            <td>ID Card</td>
                                            <td>:</td>
                                            <td> <?= $tampil['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>No Kartu</td>
                                            <td>:</td>
                                            <td> <?= $tampil['pekerjaan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td> <?= $tampil['username'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kuota Latih</td>
                                            <td>:</td>
                                            <td> <?= $kuota_latihan ?></td>
                                        </tr>
                                        <tr>
                                            <td>Deposit Terakhir</td>
                                            <td>:</td>
                                            <td> <?= $tanggal_deposit ?></td>
                                        </tr>
                                        <tr>
                                            <td>Berlaku s/d</td>
                                            <td>:</td>
                                            <td> <?= $tanggal_berlaku ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <br></br>
                    <a class="button button-blue" href="scan_kartu.php">Oke</a>
                </center>
            <?php  } else { ?>
                <center>
                    <div style="padding-top: 50px;">
                        <span style="font-size: 60px;"><b>PANDAWA GYM</b></span>
                    </div>
                    <div style="padding-top: 50px;">
                    </div>
                    <br>
                    <div id="contactform" class="rounded">
                        <div id="papanpanel2">
                            <h3>Detail Member</h3>
                        </div>

                        <div id="tickets">
                            <div style="padding: 20px;">
                                <h1 style="color: red;"><b><?= $kuota ?></b></h1>
                                <span style="color: #000000;"><i>Silahkan Hubungi Admin</i></span>
                            </div>
                        </div>
                    </div>
                    <br></br>
                    <a class="button button-blue" href="scan_kartu.php">Oke</a>
                </center>
            <?php  } ?>
        <?php  } else { ?>
            <center>
                <div style="padding-top: 50px;">
                    <span style="font-size: 60px;"><b>PANDAWA GYM</b></span>
                </div>
                <div style="padding-top: 50px;">
                </div>
                <br>
                <div id="contactform" class="rounded">
                    <div id="papanpanel2">
                        <h3>Detail Member</h3>
                    </div>

                    <div id="tickets">
                        <div style="padding: 20px;">
                            <h1 style="color: red;"><b><?= $kuota ?></b></h1>
                            <span style="color: #000000;"><i>Silahkan Hubungi Admin</i></span>
                        </div>
                    </div>
                </div>
                <br></br>
                <a class="button button-blue" href="scan_kartu.php">Oke</a>
            </center>
        <?php  } ?>
    </div>

</body>

</html>