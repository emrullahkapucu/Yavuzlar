<?php
require 'loggedcontrol.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>REGıSTER</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-secondary">
  <?php
  session_start();
  include("./db.php");
  if (isset($_POST["username"]) && isset($_POST["eposta"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $eposta = $_POST["eposta"];
    $password = $_POST["password"];
    $query = $DB->prepare("INSERT INTO kullanicilar (adsoyad, eposta,parola) VALUES('$username','$eposta','$password');");
    $query->execute([$username, $eposta, $password]);
    header("Location: login.php");
    exit();
  }

  ?>

  <section id="login">
    <div class="container">
      <div class="login-form">
        <form action="#" method="POST">

          <div class="row justify-content-center m-auto shadow bg-white mt-3 py-3 col-md-6">
            <div class='row text-center'>
              <h1 class='alert alert-dark'>REGISTER</h1>
            </div>

            <input name="username" type="text" class="form-control" placeholder="Name" autocomplete="off" required />
            <br />
            <input name="eposta" type="email" class="form-control" placeholder="Email" required />
            <br />
            <input name="password" type="password" class="form-control" placeholder="Password" required />
            <input type="submit" class="form-control submit" value="Register" style="color: rgb(14, 15, 18)" />
            <br />

        </form>
        <p>Already a member? <a href="./login.php" class="btn btn-outline-dark">Log In</a></p>
      </div>
    </div>
    </div>
  </section>
</body>

</html>