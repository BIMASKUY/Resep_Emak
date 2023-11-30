<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
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
    <title>Create Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="createrecipes.css" rel="stylesheet">
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
                    <div class="hero">
                        <span class="nohighlight">SUBMIT</span>
                        <span class="nohighlight">YOUR</span>
                        <span class="nohighlight">RECIPE</span>
                        <span class="nohighlight">TO </span>
                        <span class="highlight">RESEP EMAK.</span>
                    </div>
                </div>
                <form action="prosesCreateRecipe.php" method="post" enctype="multipart/form-data">
                    <fieldset class="">
                        <p>
                            <label for="username">Recipe Title  </label><br>
                            <input class="form-control" type="text" name="recipe_title" id="username" required autocomplete="off">
                        </p>
                        <p>
                            <label for="nama">Ingredients  </label><br>
                            <textarea class="form-control" type="text" name="ingredients" id="nama" required autocomplete="off"></textarea>
                        </p>
                        <p>
                            <label for="email">Directions  </label><br>
                            <textarea class="form-control" type="text" name="directions" id="email" required autocomplete="off"></textarea>
                        </p>
                        <p>
                            <label for="email">Tags  </label><br>
                            <input class="form-control" type="text" name="tags" id="email" required autocomplete="off">
                        </p>
                        <p>
                            <label for="email">Upload the photo you took of the dish  </label><br>
                            <input class="form-control" type="file" name="url_foto" id="email" required>
                        </p>
                        <p>
                            <div class="button-container">
                                <div class="d-grid gap-2">
                                    <button class="button1" type="submit" name="submit_recipe">Submit Your Recipe</button>
                                </div>
                            </div>
                        </p>
                        
                    </fieldset>
                </form>
                
            </div>
        </div>
    </body>
</html>