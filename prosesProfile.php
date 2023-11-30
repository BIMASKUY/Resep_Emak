<?php
include("config.php");

session_start();

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['update'])){

	// ambil data dari formulir
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$pass = $_POST['password'];
    $user_now = $_SESSION["username_now"];
    $url_tmp = $_FILES['url_foto']['tmp_name'];
    $url_nama = $_FILES['url_foto']['name'];
    move_uploaded_file($url_tmp, 'listFotoProfile/' . $url_nama);

	// buat query
  	$query = pg_query($db, "UPDATE akun 
                                SET nama = '$nama', 
                                    email = '$email', 
                                    jenis_kelamin = '$jenis_kelamin', 
                                    pass = '$pass', 
                                    url_foto = '$url_nama'
                                WHERE username = '$user_now';");
    
	// apakah query simpan berhasil?
	if($query){
        header('Location: indexLogin.php?status=sukses');
        $_SESSION["url_foto_now"] = $url_nama;
    }
	else{
        $error_message = pg_last_error($db); // $connection is your PostgreSQL connection
        echo "Update failed: $error_message";
    }
}

else die("prosesProfile.php error coks...");
?>