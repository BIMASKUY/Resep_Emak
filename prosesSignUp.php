<?php
include("config.php");
// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['signUp'])){

	// ambil data dari formulir
	$username = $_POST['username'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$pass = $_POST['password'];

	// buat query
  	$query = pg_query($db, "INSERT INTO akun (username, nama, email, jenis_kelamin, pass) VALUES ('$username', '$nama', '$email', '$jenis_kelamin', '$pass')");

	// apakah query simpan berhasil?
	if($query) header('Location: login.php?status=sukses');
	else{
        $error_message = pg_last_error($db); // $connection is your PostgreSQL connection
        echo "Update failed: $error_message";
    }
}

else die("prosesSignUp.php error coks...");
?>