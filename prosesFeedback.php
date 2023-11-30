<?php
session_start();
include("config.php");
// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['Submit'])){

	// ambil data dari formulir
	$teks = $_POST['saran'];
	$username = $_SESSION["username_now"];
    
	// buat query
  	$query = pg_query($db, "INSERT INTO feedback (username, teks) VALUES ('$username', '$teks')");

	// apakah query simpan berhasil?
	if($query) header('Location: indexLogin.php?status=sukses');
	else header('Location: indexLogin.php?status=gagal');
}

else die("prosesFeedback.php error coks...");
?>