<?php
session_start();
include("config.php");
// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['submit_recipe'])){

	// ambil data dari formulir
	$recipe_title = $_POST['recipe_title'];
	$ingredients = $_POST['ingredients'];
	$directions = $_POST['directions'];
	$tags = $_POST['tags'];
	$url_tmp = $_FILES['url_foto']['tmp_name'];
    $url_nama = $_FILES['url_foto']['name'];
	$created_user = $_SESSION["username_now"];
    move_uploaded_file($url_tmp, 'listRecipe/' . $url_nama);
    
	// buat query
  	$query = pg_query($db, "INSERT INTO listrecipe (recipe_title, ingredients, directions, tags, url_foto, created_user) VALUES ('$recipe_title', '$ingredients', '$directions', '$tags', '$url_nama', '$created_user')");

	// apakah query simpan berhasil?
	if($query) header('Location: listRecipe.php?status=sukses');
	else header('Location: listRecipe.php?status=gagal');
}

else die("prosesCreateRecipes error coks...");
?>