 <?php
  require 'loggedcontrol.php';
  session_start();
  include("./db.php");
  if (isset($_POST['addTodo'])) {
    if (isset($_POST["todo"]) && isset($_SESSION["username"])) {
      $todo = $_POST["todo"];
      $id = $_SESSION["username"];
      $query = $DB->prepare("INSERT INTO todo (userid, content) VALUES('$id','$todo');");
      $query->execute([$id, $todo]);
      header("Location: index.php");
      exit();
    }
  }




  ?>