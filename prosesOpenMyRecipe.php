<?php
session_start();
include("config.php");

$id_now = $_SESSION["edited_ID_Recipe"]; 

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['update'])){

	// ambil data dari formulir
	$recipe_title = $_POST['title'];
	$ingredients = $_POST['Ingredients'];
	$directions = $_POST['directions'];
	$tags = $_POST['tags'];
    
	// buat query
  	$query = pg_query($db, "UPDATE listrecipe 
                                SET recipe_title = '$recipe_title', 
                                    ingredients = '$ingredients', 
                                    directions = '$directions', 
                                    tags = '$tags' 
                                WHERE id = $id_now;");
    
	// apakah query simpan berhasil?
	if($query) header('Location: myRecipe.php?status=sukses');
	else{
        $error_message = pg_last_error($db); // $connection is your PostgreSQL connection
        echo "Update failed: $error_message";
    }
}

else if(isset($_POST['delete'])){
  	$query = pg_query($db, "DELETE FROM listrecipe WHERE id = $id_now;");

	if($query) header('Location: myRecipe.php?status=sukses');
	else{
	  $error_message = pg_last_error($db); // $connection is your PostgreSQL connection
	  echo "Update failed: $error_message";
	}
}

else die("prosesOpenMyCreateRecipes error coks...");
?>