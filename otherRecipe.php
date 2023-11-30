<?php

session_start();
include("config.php");

if (isset($_GET['recipe_id'])) $selected_ID_Menu = $_GET['recipe_id'];

$result_resep = pg_query($db, "SELECT * FROM listrecipe WHERE id = $selected_ID_Menu");
if(!$result_resep) echo "Result error bos";

while ($row = pg_fetch_assoc($result_resep)) {
    $url_foto = $row["url_foto"];
    $recipe_title = $row["recipe_title"];
    $ingredients = $row["ingredients"];
    $directons = $row["directions"];
    $tags = $row["tags"];
    $created_user = $row["created_user"];
}

if(isset($_SESSION["login"])){
    $user_now = $_SESSION["username_now"];
    $result_saved = pg_query($db, "SELECT * FROM savedrecipe WHERE id = $selected_ID_Menu AND username = '$user_now'");
    $row_count = pg_num_rows($result_saved);
}
else $row_count = 0;

$_SESSION["selected_id_menu"] = $selected_ID_Menu;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins'>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Dokdo'>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/ebc3bded83.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>otherRecipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="otherRecipe.css" rel="stylesheet">
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
                <div class="container4">
                    <div class="container3">
                        <div class="recipescontainer">
                            <div class="recipes">
                                <div class="recipespic"> <img src="listRecipe/<?php echo $url_foto; ?>" alt="reseppic"> </div>
                                <span class="foodname"> <?php echo $recipe_title; ?> </span><span> <?php echo $created_user; ?> </span>
                            </div>
                        </div>
                        
                        <div class="saverecipe">
                            <button class="button2" type="submit" name="saverecipe" id="saverecipe"><i class="fa-solid fa-bookmark"></i>  Save Recipe</button>
                        </div>
                    </div>

                    <form>
                        <fieldset class="">
                            <p>
                                <label for="nama">Ingredients  </label><br>
                                <input class="form-control" type="text" name="Ingredients" id="Ingredients" value="<?php echo $ingredients; ?>" readonly="readonly">  </input>
                            </p>
                            <p>
                                <label for="directions">Directions  </label><br>
                                <textarea class="form-control" type="text" name="directions" id="directions" readonly="readonly"> <?php echo $directons; ?> </textarea>
                            </p>
                            <p>
                                <label for="tags">Tags  </label><br>
                                <input class="form-control" type="text" name="tags" id="tags" value="<?php echo $tags; ?>" readonly="readonly"></input>
                            </p>
                        
                            <p>
                                <div class="button-container">
                                    <button class="button1" id="backButton">Back</button>
                                </div>
                            </p>
                        </fieldset>
                    </form>
                </div>

                <div class="container5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                    <h1 class="text-warning mt-4 mb-4">
                                        <b><span id="average_rating">0.0</span> / 5</b>
                                    </h1>
                                    <div class="mb-3">
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                        <i class="fas fa-star star-light mr-1 main_star"></i>
                                    </div>
                                    <h3><span id="total_review">0</span> Review</h3>
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
            
                                        <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                        </div>
                                    </p>
                                    <p>
                                        <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                                        
                                        <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                        </div>               
                                    </p>
                                    <p>
                                        <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                                        
                                        <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                        </div>               
                                    </p>
                                    <p>
                                        <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                                        
                                        <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                        </div>               
                                    </p>
                                    <p>
                                        <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                                        
                                        <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                        </div>               
                                    </p>
                                </div>
                                <div class="col-sm-4 text-center">
                                    <h3 class="mt-4 mb-3">Write Review Here</h3>
                                    <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5" id="review_content"></div>
                </div>
                
            </div>
        </div>
    </body>
</html>

<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Submit Review</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <h4 class="text-center mt-2 mb-4">
                  <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                  <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                  <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                  <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                  <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
              </h4>
              <div class="form-group">
                  <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
              </div>
              <div class="form-group text-center mt-4">
                  <button type="button" class="btn btn-primary" id="save_review">Submit</button>
              </div>
            </div>
      </div>
    </div>
</div>



<style>
        #review_modal .modal-content {
            background: #FFFFEA;
        }
        #review_modal .modal-header .close {
            background: none; /* Remove the background */
            border: none; /* Remove the border */
            color: #7B393C; /* Change the color of the close icon */
        }
        .button_save_recipe {
            background-color: #ffc107 !important;
        }

        .button_save_recipe a{
            color: #2A2829;
            text-decoration: none;
        }

        .button_save_recipe:hover{
            background: #ffcd39!important;
            color: #2A2829;
            padding-bottom: 20px;
            padding-top: 20px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .button_save_recipe:active {
            padding-bottom: 10px;
            padding-top: 10px;
            padding-left: 5px;
            padding-right: 5px;
        }
</style>



<script>

    var rating_data = 0;

    document.getElementById('backButton').addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = 'listRecipe.php';
    });

    document.getElementById('add_review').addEventListener('click', function() {
        <?php if(!isset($_SESSION["login"])) { ?>
            // User is not logged in, redirect to the login page
            window.location.href = 'login.php';
        <?php } else { ?>
            // User is logged in, show the modal
            $('#review_modal').modal('show');
        <?php } ?>
    });

    //button Save Recipe jadi berwarna kalau sudah pernah di bookmarks\

    let row = <?php echo json_encode($row_count); ?>;
    let already_saved_recipe = document.getElementById('saverecipe');
    if(row > 0) already_saved_recipe.classList.add('button_save_recipe'); // Add a CSS class to change the button color
    else already_saved_recipe.classList.remove('button_save_recipe');

    document.getElementById('saverecipe').addEventListener('click', function() {
        <?php if(!isset($_SESSION["login"])) { ?>
            // User is not logged in, redirect to the login page using JavaScript
            window.location.href = 'login.php';
        <?php } else { ?>
            // User is logged in, make an AJAX request to the server
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'prosesSavedRecipe.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                let updatedRow = parseInt(xhr.responseText); // Assuming the response contains the updated 'row' value
                updateButtonAppearance(updatedRow); // Update button appearance based on the received 'row' value
                let row = <?php echo json_encode($row_count); ?>;
                if(row > 0){
                    let already_saved_recipe = document.getElementById('saverecipe');
                    already_saved_recipe.classList.add('button_save_recipe'); // Add a CSS class to change the button color
                    }
                // Handle the response if needed
            };

            let row = '<?php echo $row_count; ?>';
            let selected_ID_Menu = '<?php echo $selected_ID_Menu; ?>';
            let user_now = '<?php echo $user_now; ?>';

            let data = 'row=' + row + '&selected_ID_Menu=' + selected_ID_Menu + '&user_now=' + user_now;
            xhr.send(data);
            window.location.href = '';
        <?php } ?>
    });


    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){

        var user_review = $('#user_review').val();

        if(user_review == '')
        {
            alert("Please Fill The Field");
            return false;
        }
        else
        {
            $.ajax({
                url:"prosesOtherRecipe.php",
                method:"POST",
                data:{rating_data:rating_data, user_review:user_review},
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            })
        }

    });

    load_rating_data();

    function load_rating_data()
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{action:'load_data'},
            dataType:"JSON",
            success:function(data)
            {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);
            
                var count_star = 0;
            
                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });
            
                $('#total_five_star_review').text(data.five_star_review);
            
                $('#total_four_star_review').text(data.four_star_review);
            
                $('#total_three_star_review').text(data.three_star_review);
            
                $('#total_two_star_review').text(data.two_star_review);
            
                $('#total_one_star_review').text(data.one_star_review);
            
                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');
            
                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');
            
                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');
            
                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');
            
                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');
            
                if(data.review_data.length > 0)
                {
                    var html = '';
                
                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';
                    
                        html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';
                    
                        html += '<div class="col-sm-11">';
                    
                        html += '<div class="card">';
                    
                        html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';
                    
                        html += '<div class="card-body">';
                    
                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';
                        
                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }
                        
                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }
                    
                        html += '<br />';
                    
                        html += data.review_data[count].user_review;
                    
                        html += '</div>';
                    
                        html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';
                    
                        html += '</div>';
                    
                        html += '</div>';
                    
                        html += '</div>';
                    }
                
                    $('#review_content').html(html);
                }
            }
        })
    }

</script>