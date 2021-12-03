<?php
	$servername = "localhost";
	$username = "root";
	$password = "zxayn123";
	$database = "db_smkti";
	 
	// membuat koneksi ke database
	$conn = mysqli_connect($servername, $username, $password,$database);
	 
	// cek apakah koneksi berhasil
	if (!$conn) {
	    die("Koneksi Error: " . mysqli_connect_error());
	}
	echo "";
	 
?>