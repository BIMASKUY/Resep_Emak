<?php
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Poppins'>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Dokdo'>
    <link rel="stylesheet" href='https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans'>
    <link rel="stylesheet" href="globals.css" />
    <link rel="stylesheet" href="styleguide.css" />
    <link rel="stylesheet" href="styleIdx.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

  </head>
  <body>
    <div class="HOMEPAGE">
      <div class="overlap-wrapper">
        <div class="overlap">
          <div class="desktop">
            <div class="overlap-group">
              <div class="div">
                <div class="overlap-2">
                  <H1 class="text-wrapper">RESEP EMAK</H1>
                  <p class="p">Cita Rasa Warisan Indonesia di Setiap Resep Emak</p>
                </div>
              </div>
              <div class="search"><div class="text-wrapper-2"> <a href="listRecipe.php" class="akun-1"> Discover More Recipes</a></div></div>
              <div class="overlap-3">
                <img class="download" src="index1.jpg" />
                <div class="create-recipes-wrapper">
                  <div class="text-wrapper-3"> <a href="createRecipes.php" class="akun"> CREATE <br /> RECIPES</a></div>
                </div>
                <div class="MY-recipes-wrapper">
                  <div class="text-wrapper-3"> <a href="myRecipe.php" class="akun"> MY <br />RECIPES</a></div>
                </div>
              </div>
            </div>
            <div class="overlap-5">
              <div class="text-wrapper-5">RESEP EMAK</div>
              <div class="text-wrapper-6"> <a href="index.php" class="akun"> Home</a></div>
              <div class="text-wrapper-7"> <a href="index.php#scrollToBottom" class="akun" id="aboutUsLink"> About Us</a></div>
              <div class="search-2">
                <div class="text-wrapper-9"> <a href="prosesLogout.php" class="akun" >Sign Out </a></div>
              </div>
            </div>
          </div>
          <div class="rectangle-2">
          <div class="footer">
            <h3>Our Team <br></h3>
            <p><a href="https://www.instagram.com/aszrieltm/">Aszrieltm</a></p>
            <p><a href="https://www.instagram.com/bimarizqyramadhan/">Bimarizqyramadhan</a></p>
            <p><a href="https://www.instagram.com/n.ajlaaa/">N.ajlaaa</a></p>
            <p><a href="https://www.instagram.com/qurroqur_/">Qurroqur_</a></p>
          </div>
          <div class="footer">
            <form action="prosesFeedback.php" method="post">
                <h3>
                  <label class="form-saran" for="kotak saran">Masukan Saran <br></label>
                  <input class="input-saran" type="text" name="saran" autocomplete="off" required>
                  <button class="button" type="submit" name="Submit" id="feedback">Submit</button>
                </h3>
            </form>
          </div>
          <div class="footer">
            <h3>Deskripsi</h3>
            <p class="desk">"Resep Emak adalah sebuah platform daring yang dirancang untuk mempermudah pengguna dalam mencari dan membuat berbagai resep makanan.Dengan tampilan yang bersih dan user-friendly, pengguna dapat dengan mudah menemukan inspirasi kuliner.”
            </p>
          </div>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>

<script>

document.addEventListener("DOMContentLoaded", function () {
    <?php if (isset($_SESSION["login"])) : ?>
      // Code for when the session variable is NOT set
      if (window.location.hash === "#scrollToBottom") {
        // Function to scroll to the bottom of the page
        function scrollToBottom() {
          const footer = document.querySelector(".rectangle-2"); // Replace with your footer selector
          if (footer) {
            window.scrollTo({
              top: footer.offsetTop,
              behavior: "smooth",
            });
          }
        }

        // Scroll to the bottom of the page
        scrollToBottom();
      }
    <?php endif; ?>
  });

    document.getElementById('feedback').addEventListener('click', function() {
        <?php if(!isset($_SESSION["login"])) { ?>
            window.location.href = 'login.php';
        <?php } ?>
    });
</script>