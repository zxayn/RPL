<?php
//buat session
if(!isset($_SESSION)) {
    session_start();
}
 
//hapus data yang login di session
$_SESSION['username']=NULL;
unset($_SESSION['username']);
 
//hancurkan data session
session_destroy();
 
//kembali ke login
header("location: index.php");
 
?>
<!-- Akhir Log Out -->