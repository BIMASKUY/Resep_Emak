<?php

session_start();
include("config.php");

if(isset($_POST["action"]))
{
    $id_recipe_now = $_SESSION["selected_id_menu"];
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();

    $result = pg_query($db, "SELECT * FROM review_table WHERE id_recipe = $id_recipe_now ORDER BY datetime DESC;");

    while ($row = pg_fetch_assoc($result)) {
        $review_content[] = array(
            "user_name" => $row["user_name"],
            "user_review" => $row["user_review"],
            "rating" => $row["user_rating"],
            "datetime" => date('l jS, F Y h:i:s A', $row["datetime"])
        );
    
        // Increment star ratings and total review count
        switch ($row["user_rating"]) {
            case '5':
                $five_star_review++;
                break;
            case '4':
                $four_star_review++;
                break;
            case '3':
                $three_star_review++;
                break;
            case '2':
                $two_star_review++;
                break;
            case '1':
                $one_star_review++;
                break;
        }
    
        $total_review++;
        $total_user_rating += $row["user_rating"];
    }
    

	$average_rating = $total_user_rating / $total_review;

    $output = array(
        "average_rating" => number_format($average_rating, 1),
        "total_review" => $total_review,
        "five_star_review" => $five_star_review,
        "four_star_review" => $four_star_review,
        "three_star_review" => $three_star_review,
        "two_star_review" => $two_star_review,
        "one_star_review" => $one_star_review,
        "review_data" => $review_content // Assuming $review_content is an array fetched from PostgreSQL
    );
    
    echo json_encode($output);
    
}

?>