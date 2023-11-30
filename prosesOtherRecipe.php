<?php
session_start();
include("config.php");

if(isset($_POST["rating_data"])) {
    $id_recipe = $_SESSION["selected_id_menu"];
    $user_name = $_SESSION["username_now"];
    $user_rating = $_POST["rating_data"];
    $user_review = $_POST["user_review"];
    $datetime = time() + 6*3600;

    $result_check = pg_query($db, "SELECT COUNT(*) FROM review_table WHERE id_recipe = $id_recipe AND user_name = '$user_name';");
    
    if ($result_check) {
        $count = pg_fetch_result($result_check, 0, 0); // Fetch the count value

        if($count > 0) {
            $result = pg_query($db, "UPDATE review_table 
                                    SET user_rating = '$user_rating', 
                                        user_review = '$user_review', 
                                        datetime = $datetime
                                    WHERE id_recipe = $id_recipe AND user_name = '$user_name';");

            echo "Your Review & Rating Has Been Updated";
        } 
        else {
            $result = pg_query($db, "INSERT INTO review_table (id_recipe, user_name, user_rating, user_review, datetime) VALUES ($id_recipe, '$user_name', '$user_rating', '$user_review', $datetime);");
            echo "Your Review & Rating Successfully Submitted";
        }
    } 

else echo "prosesOtherRecipe.php error coks";
}

?>