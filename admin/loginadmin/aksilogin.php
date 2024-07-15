<?php
session_start();
include "../koneksi/koneksi.php";
if ($_POST['level']!="member"){
$login = mysqli_query($conn,"select * from tbl_login where user = '" . $_POST['username'] . "' and password = '".$_POST['password']."' and level = '".$_POST['level']."'");
}else{
$login = mysqli_query($conn,"select * from tbl_member where user = '" . $_POST['username'] . "' and password = '".$_POST['password']."' and level = '".$_POST['level']."'");
}
$rowcount = mysqli_num_rows($login);
if ($rowcount == 1) {
$_SESSION['adminmembership'] = $_POST['username'];
$_SESSION['passwordmembership'] = $_POST['password'];
$_SESSION['levelmembership'] = $_POST['level'];
if ($_POST['level']=="member"){
$tmplmem = mysqli_fetch_array(mysqli_query($conn,"select * from tbl_member where user = '$_POST[username]'"));
$_SESSION['usermembership'] = $tmplmem['user'];
}
echo '<script>setTimeout(\'location.href="../index.php?login=admin"\' ,0);</script>';
}
else
{
echo '<script>alert(\'Login Gagal. . !\')
	setTimeout(\'location.href="javascript:self.history.back()"\' ,0);</script>';

}

?>