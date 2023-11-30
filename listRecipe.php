<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST["searchbar"];

    // Fetch recipes from the database based on the search term
    $query = "SELECT id, recipe_title, url_foto, created_user FROM listrecipe WHERE recipe_title ILIKE '%$searchTerm%'";
    $result = pg_query($db, $query);

    if (!$result) echo "Query execution failed.\n";

} else {
    // Default query to fetch all recipes
    $query = "SELECT id, recipe_title, url_foto, created_user FROM listrecipe";
    $result = pg_query($db, $query);

    if (!$result) echo "Query execution failed.\n";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins'>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Dokdo'>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/ebc3bded83.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="listRecipe.css" rel="stylesheet">
</head>
    <body>
        <div class="container"> <!-- HEADER CONTAINER -->
            <div class="header">
                <nav class="navbar">

                    <div class="logo">
                        <div class="logo-text">RESEP EMAK</div>
                        <div class="menu">
                            <div class="menu-item"><a href="index.php">Home</a></div> 
                            <div class="menu-item"><a href="index.php#scrollToBottom">About Us</a></div> 
                        </div>
                    </div>
                    
                    <div class="fotoprofile">
                        <a href="savedrecipe.php">
                            <i class="fa-solid fa-heart"></i>
                        </a>
                        <a href="profile.php">
                            <div class="logo-image">
                            <img src="listFotoProfile/<?php echo $_SESSION["url_foto_now"]; ?>" alt="profile">
                            </div>
                        </a>
                        
                    </div>
                </nav>
                    
                <div class="hero">
                    <span class="nohighlight">RESEP EMAK WILL HELP YOU</span>
                    <span class="nohighlight">DISCOVER NEW <span class="highlight">TASTES.</span></span>
                </div>

            </div>

            
            <div class="container2"><!-- ISI KONTEN -->

                <div class="container3"> <!-- SEARCHBAR + CREATE RECIPES(BUTTON) CONTAINER -->
                    <form action="" method="post">
                        <input class="searchbar" type="text" name="searchbar" id="searchbar" autofocus autocomplete="off">
                        <button class="button1" type="submit">Search</button>
                        <button class="button2" ><a href="createRecipes.php" class="createrecipes">Create Recipes</a></button>
                    </form>
                </div>

                <div class="container4"> <!-- RECIPES CONTAINER -->
                <?php
                    // Fetch recipes from the database
                        while ($row = pg_fetch_assoc($result)) {
                            echo '<a href="otherRecipe.php?recipe_id=' . urlencode($row["id"]) . '">
                                    <div class="recipes">
                                        <div class="recipespic"><img src="listRecipe/' . $row["url_foto"] . '" alt="' . $row["recipe_title"] . '"></div>
                                        <span class="foodname">' . $row["recipe_title"] . '</span><span>' . $row["created_user"] . '</span>
                                    </div>
                                </a>';
                        }                        
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>