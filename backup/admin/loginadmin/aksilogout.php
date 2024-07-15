<?php
session_start();
unset($_SESSION['adminmembership']);
unset($_SESSION['passwordmembership']);
unset($_SESSION['levelmembership']);
unset($_SESSION['usermembership']);
header("Location: ../index.php");
?>