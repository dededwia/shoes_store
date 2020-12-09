<?php
session_start();
include "koneksi.php";
unset($_SESSION['id']); 
session_unset();
session_destroy();
header("Location:../index.php");
?>