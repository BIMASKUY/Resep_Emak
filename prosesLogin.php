<?php
session_start();
include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['login'])){

	// ambil data dari formulir
	$username = $_POST['username'];
	$pass = $_POST['password'];

    $query = "SELECT * FROM akun WHERE username = '$username' AND pass = '$pass'";
    $result = pg_query($db, $query);

    if ($result && pg_num_rows($result) > 0){
		$row = pg_fetch_assoc($result);
		$_SESSION["login"] = true;
		$_SESSION["username_now"] = $row['username'];
		$_SESSION["url_foto_now"] = $row['url_foto'];
		header("Location: indexLogin.php");
	}
	else header("Location: index.php?error=1");
}

else die("prosesLogin.php error coks...");
?>