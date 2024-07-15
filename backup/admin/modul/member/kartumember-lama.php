<?php
define('FPDF_FONTPATH','font/');
require('../../plugin/fpdf/fpdf.php');
include "../../koneksi/koneksi.php";
class PDF extends FPDF
{

//Page header
function Header()
{
    $this->SetFont('Arial','B',10);
    $this->Cell(100);
    $this->Cell(1,10,'Kartu Member',0,0,'C');
	$this->SetFont('Arial','I',10);
    $this->Ln(20);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
	//$this->Ln(10);
    $this->SetY(-25);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Halaman '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Instanciation of inherited class
$pdf=new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',7);
$sql=mysqli_query($conn,"select * from tbl_member where id_member = '$_GET[no]'");
//$sql2=mysqli_query($conn,"select count(*) as jumlah from kamar,jenis where jenis.no_jenis = kamar.no_jenis order by status");

//$data2 = mysqli_fetch_array($sql2);
//$jumlah = $data2['jumlah'];
$i=25;
$h=0;
$pdf->SetY(25);
$pdf->SetX(5);
while ($data = mysqli_fetch_array($sql)){ 
$pdf->setFillColor(255,255,255);
$pdf->SetX(3);
$pdf->CELL(95,60,'',1,0,'C',1);
$pdf->CELL(95,60,'',1,0,'C',1);
$pdf->Ln(1);
$pdf->SetX(35);
$pdf->SetFont('Arial','B',10);
$pdf->cell(28,3,'KARTU MEMBER',0,1,'L',1);
$pdf->Ln(1);
$pdf->SetFont('Arial','',7);

$pdf->SetX(5);
$pdf->CELL(30,4,'ID MEMBER',0,0,'L',1);
$pdf->SetX(35);
$pdf->cell(28,4,': ',0,0,'L',1);
$pdf->SetX(37);
$pdf->cell(28,4,$data['id_member'],0,1,'L',1);

$pdf->SetX(5);
$pdf->CELL(30,4,'Nama',0,0,'L',1);
$pdf->SetX(35);
$pdf->cell(28,4,': ',0,0,'L',1);
$pdf->SetX(37);
$pdf->cell(28,4,$data['nama'],0,0,'L',1);
$pdf->SetX(132);
$pdf->cell(28,4,'Kartu Member Digunakan Sebagai Pegangan Member,',0,1,'C',1);
$pdf->SetX(5);
$pdf->CELL(30,4,'Jenis Kelamin',0,0,'L',1);
$pdf->SetX(35);
$pdf->cell(28,4,': ',0,0,'L',1);
$pdf->SetX(37);
$pdf->cell(28,4,$data['jenis_kelamin'],0,0,'L',1);
$pdf->SetX(132);
$pdf->cell(28,4,'Kartu Jangan Sampai Hilang Atau Rusak',0,1,'C',1);
$pdf->SetX(5);
$pdf->CELL(30,4,'Alamat',0,0,'L',1);
$pdf->SetX(35);
$pdf->cell(5,4,': ',0,0,'L',1);
$pdf->SetX(37);
$pdf->multicell(60,4,$data['alamat'],0,1,'L',1);

$pecah1 = explode("-", $data['tanggal_lahir']);
$date1 = $pecah1[2];
$month1 = $pecah1[1];
$year1 = $pecah1[0];
switch($month1){
case '01':
$bln = 'Januari';
break;
case '02':
$bln = 'Februari';
break;
case '03':
$bln = 'Maret';
break;
case '04':
$bln = 'April';
break;
case '05':
$bln = 'Mei';
break;
case '06':
$bln = 'Juni';
break;
case '07':
$bln = 'Juli';
break;
case '08':
$bln = 'Agustus';
break;
case '09':
$bln = 'September';
break;
case '10':
$bln = 'Oktober';
break;
case '11':
$bln = 'November';
break;
case '12':
$bln = 'Desember';
break;
}

$pdf->SetX(5);
$pdf->CELL(30,4,'Tanggal Lahir',0,0,'L',1);
$pdf->SetX(35);
$pdf->cell(28,4,": ",0,0,'L',1);
$pdf->SetX(37);
$pdf->cell(28,4,"$date1 $bln $year1",0,1,'L',1);


$pecah2 = explode("-", $data['tanggal_daftar']);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
switch($month2){
case '01':
$bln1 = 'Januari';
break;
case '02':
$bln1 = 'Februari';
break;
case '03':
$bln1 = 'Maret';
break;
case '04':
$bln1 = 'April';
break;
case '05':
$bln1 = 'Mei';
break;
case '06':
$bln1 = 'Juni';
break;
case '07':
$bln1 = 'Juli';
break;
case '08':
$bln1 = 'Agustus';
break;
case '09':
$bln1 = 'September';
break;
case '10':
$bln1 = 'Oktober';
break;
case '11':
$bln1 = 'November';
break;
case '12':
$bln1 = 'Desember';
break;
}

$pdf->SetX(5);
$pdf->CELL(30,4,'Tanggal Daftar',0,0,'L',1);
$pdf->SetX(35);
$pdf->cell(28,4,": ",0,0,'L',1);
$pdf->SetX(37);
$pdf->cell(28,4,"$date2 $bln1 $year2",0,1,'L',1);
$pdf->SetFont('Arial','',7);


date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$bulansekarang = date("m", $tanggal);
$tanggalsekarang = date("d", $tanggal);
$tahunsekarang = date("Y", $tanggal);
switch($bulansekarang){
case '01':
$bulan = 'Januari';
break;
case '02':
$bulan = 'Februari';
break;
case '03':
$bulan = 'Maret';
break;
case '04':
$bulan = 'April';
break;
case '05':
$bulan = 'Mei';
break;
case '06':
$bulan = 'Juni';
break;
case '07':
$bulan = 'Juli';
break;
case '08':
$bulan = 'Agustus';
break;
case '09':
$bulan = 'September';
break;
case '10':
$bulan = 'Oktober';
break;
case '11':
$bulan = 'November';
break;
case '12':
$bulan = 'Desember';
break;
}
$pdf->Ln(4);
$pdf->SetX(40);
$pdf->cell(28,3,"___________, $tanggalsekarang $bulan $tahunsekarang",0,0,'L',1);
$pdf->SetX(132);
$pdf->cell(28,4,'Jika Kartu Hilang, Segera Hubungi Petugas Klub Kesehatan',0,1,'C',1);
$pdf->SetX(40);
$pdf->cell(28,3,'Star Tekno Gym,',0,1,'L',1);
$pdf->SetX(40);
$pdf->cell(28,3,'',0,1,'L',1);
$pdf->SetX(40);
$pdf->cell(28,3,'',0,1,'L',1);
$pdf->SetX(40);
$pdf->cell(28,3,'',0,1,'L',1);
$pdf->SetX(40);
//$tampilkepala = mysqli_fetch_array(mysqli_query($conn,"select * from kepala_perpustakaan where id=1"));
$pdf->cell(28,3,'(            )',0,1,'L',1);
$pdf->SetX(10);
$i++;
$pdf->Ln(10);
$pdf->SetFont('Arial','',7);
}
/*$pdf->Cell(20,5,$data['no_jenis'],$i,0,1);
$pdf->Cell(58,5,$data['jns_kamar'],$i,0,1);
$pdf->Cell(45,5,$data['status'],$i,0,1);*/


//for($i=1;$i<=40;$i++)
$pdf->Output();
?>