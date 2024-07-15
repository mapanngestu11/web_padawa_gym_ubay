<?php
error_reporting(E_ALL ^ E_DEPRECATED);

$server   ="localhost:3306" ;
$username ="panf6331_user_pandawagym";
$password ="X9qTGEtH1EMN67";
$database   ="panf6331_pandawagym";

//Koneksi dan memilih database di server

//mysqli_connect ($server,$username,$password) or die ("Koneksi database gagal");
//mysqli_select_db($database) or die ("Database Tidak Tersedia");

$conn = mysqli_connect($server, $username, "$password", $database) or die ("Koneksi Gagal");
