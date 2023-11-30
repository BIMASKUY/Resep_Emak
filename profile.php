<?php
session_start();
include("config.php");

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

$user_now = $_SESSION["username_now"];
$result = pg_query($db, "SELECT * FROM akun WHERE username = '$user_now'");
if(!$result) echo "Result error bos";

while ($row = pg_fetch_assoc($result)) {
    $nama = $row["nama"];
    $email = $row["email"];
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
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="profile.css" rel="stylesheet">
</head>
    <body>
        <div class="container"> <!-- HEADER CONTAINER -->
            <div class="header">
                <div class="fotoprofile">
                        <div class="logo-image">
                        <img src="listFotoProfile/<?php echo $_SESSION["url_foto_now"]; ?>" alt="Profile">
                        </div>
                </div>
            </div>

            
            <div class="container2"><!-- ISI KONTEN -->
                <form action="prosesProfile.php" method="post" enctype="multipart/form-data">
                    <fieldset class="">
                        <p>
                            <label for="email">Profile Picture  </label><br>
                            <input class="form-control" type="file" name="url_foto" id="email" required autocomplete="off">
                        </p>
                        <p>
                            <label for="nama">Nama  </label><br>
                            <input class="form-control" type="text" name="nama" id="nama" value="<?php echo $nama; ?>" required autocomplete="off">
                        </p>
                        <p>
                            <label for="email">Email  </label><br>
                            <input class="form-control" type="text" name="email" id="email" value="<?php echo $email; ?>" required autocomplete="off">
                        </p>
                        <p>
                            <label for="jenis_kelamin">Jenis Kelamin  </label><br>
                            <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="L"  required>Laki-laki</label>
                            <label><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P"  required>Perempuan</label>
                        </p>
                        <p>
                            <label for="password">Password  </label><br>
                            <input class="form-control" type="password" name="password" id="password" required><br>
                        </p>
                        <p>
                            <div class="button-container">
                                    <button class="button1" type="submit" name="update">Update</button>
                                    <button class="button2" ><a href="listRecipe.php" class="akun">Back</a></button>
                            </div>
                        </p>
                        
                    </fieldset>
                </form>
                
            </div>
        </div>
    </body>
</html>