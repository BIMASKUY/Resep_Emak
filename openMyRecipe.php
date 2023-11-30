<?php
session_start();
include("config.php");

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

if (isset($_GET['recipe_id'])) $selected_ID_Menu = $_GET['recipe_id'];

$result = pg_query($db, "SELECT * FROM listrecipe WHERE id = $selected_ID_Menu");
if(!$result) echo "Result error bos";

while ($row = pg_fetch_assoc($result)) {
    $url_foto = $row["url_foto"];
    $recipe_title = $row["recipe_title"];
    $ingredients = $row["ingredients"];
    $directons = $row["directions"];
    $tags = $row["tags"];
    $created_user = $row["created_user"];
    $_SESSION["edited_ID_Recipe"] = $row["id"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins'>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Dokdo'>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="openMyRecipe.css" rel="stylesheet">
</head>
    <body>
        <div class="container"> <!-- HEADER CONTAINER -->
            <div class="header">
                <div class="navbar">

                    <div class="logo">
                        <div class="logo-text">RESEP EMAK</div>
                        <div class="menu">
                            <div class="menu-item"><a href="index.php">Home</a></div> 
                            <div class="menu-item"><a href="index.php#scrollToBottom">About Us</a></div>
                        </div>
                    </div>

                    <div class="fotoprofile">
                        <a href="profile.php">
                            <div class="logo-image">
                            <img src="listFotoProfile/<?php echo $_SESSION["url_foto_now"]; ?>" alt="Profile">
                            </div>
                        </a>
                        
                    </div>
                </div>

            </div>

            
            <div class="container2"><!-- ISI KONTEN -->
                <div class="container3">
                        <div class="recipes">
                            <div class="recipespic"> <img src="listRecipe/<?php echo $url_foto; ?>" alt="recipepic"> </div>
                            <span class="foodname"><?php echo $recipe_title ?> </span><span> <?php echo $created_user; ?> </span>
                        </div>
                </div>
                <form action="prosesOpenMyRecipe.php" method="post">
                    <fieldset class="">
                        <p>
                            <label for="title">Recipe Title  </label><br>
                            <input class="form-control" type="text" name="title" id="title" value="<?php echo $recipe_title; ?>" required autocomplete="off">
                        </p>
                        <p>
                            <label for="nama">Ingredients  </label><br>
                            <textarea class="form-control" type="text" name="Ingredients" id="Ingredients" required autocomplete="off"> <?php echo $ingredients; ?> </textarea>
                        </p>
                        <p>
                            <label for="directions">Directions  </label><br>
                            <textarea class="form-control" type="text" name="directions" id="directions" required autocomplete="off"> <?php echo $directons; ?> </textarea>
                        </p>
                        <p>
                            <label for="tags">Tags  </label><br>
                            <input class="form-control" type="text" name="tags" id="tags" value="<?php echo $tags; ?>" required autocomplete="off">
                        </p>
                        
                        <p>
                            <div class="button-container">
                                    <button class="button1" type="submit" name="update">Edit</button>
                                    <button class="button2" type="submit" name="delete">Delete</button>
                            </div>
                        </p>
                        
                    </fieldset>
                </form>
            </div>
    </body>
</html>