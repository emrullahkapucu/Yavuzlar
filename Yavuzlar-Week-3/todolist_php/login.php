<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-secondary">


  <section id="login">
    <div class="container">
      <div class="login-form">
        <form action="#" method="POST">
          <div class="row justify-content-center m-auto shadow bg-white mt-3 py-3 col-md-6">
            <div class='row text-center'>
              <h1 class='alert alert-dark'>LOGIN</h1>
            </div>

            <input name="username" type="text" class="form-control" placeholder="Username" autocomplete="off" required />
            <br />
            <input name="password" type="password" class="form-control" placeholder="Password" required />
            <br />
            <input type="submit" class="form-control submit" value="Log In" style="color: rgb(14, 15, 18)" />
            <br />
            <?php
            session_start();
            include("./db.php");

            if (isset($_POST["username"]) && isset($_POST["password"])) {
              if (!isset($_POST["username"]) || trim($_POST["username"]) == "" || !isset($_POST["password"]) || trim($_POST["password"]) == "") {
                echo "please fill all the inputs!";
              }
              $username = $_POST["username"];
              $password = $_POST["password"];
              $q = $DB->prepare("SELECT * FROM kullanicilar WHERE eposta = '" . $_POST["username"] . "' AND parola = '" . $_POST["password"] . "' ");

              $q->execute([$username, $password]);

              $results = $q->fetch();

              if (isset($results[2]) && isset($results[3])) {

                $_SESSION["logged"] = TRUE;
                $_SESSION["username"] = $results[0];
                header("location: index.php");
                exit();
              } else {
                echo "Hatalı eposta veya parola! Lütfen tekrar deneyin.";
                header("refresh:2;url=logout.php");
                die();
              }
            }
            ?>

        </form>
        <p>New to <b>Yavuzlar?</b> <a href="./register.php" class="btn btn-outline-dark">Create Account</a></p>
      </div>
    </div>
    </div>
  </section>
</body>

</html>