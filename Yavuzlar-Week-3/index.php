<?php
session_start();
require_once 'db.php';
require 'loggedcontrol.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YavuzlarToDo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>


<body class="bg-secondary">

  <?php

  include("./db.php");
  if (isset($_POST["todo"]) && isset($_SESSION["username"])) {
    $todo = $_POST["todo"];
    $id = $_SESSION["username"];
    $query = $DB->prepare("INSERT INTO todo (userid, content) VALUES('$id','$todo');");
    $query->execute([$id, $todo]);
    header("Location: index.php");
    exit();
  }

  ?>
  <?php
  echo '<pre>' . $_SESSION["username"] . '</pre>'
  ?>
  <form action="insert.php" method="POST">
    <p><a href='logout.php' class="btn btn-danger"> Log out </a></p>
    <div class="container">
      <div class="row justify-content-center m-auto shadow bg-white mt-3 py-3 col-md-6">
        <h3 class="text-center text-dark font-monospace">TODO</h3>
        <div class="col-8">

          <input type="text" name="todo" class="form-control">
        </div>
        <div class="col-2 d-flex">
          <button class="btn btn-outline-dark" name="addTodo">ADD</button>
        </div>
      </div>
    </div>
  </form>
  <div class=" d-flex justify-content-center m-auto shadow bg-white mt-3 py-2 col-md-6">
    <form action="#" method="POST">
      <button class="btn btn-outline-dark" style="margin-right: 10px;" name="showall">Show All</button>
    </form>
    <form action="#" method="POST">
      <button class="btn btn-outline-dark" name="hideComplated">Hide Complated</button>
    </form>
  </div>
  <div class="container">
    <div class="col-8 bg-white m-auto mt-3">

      <table class="table">
        <tbody>


          <?php
          $q = $DB->prepare("SELECT * FROM todo WHERE userid = '" . $_SESSION["username"] . "' AND status = 'false'");
          $q->execute(array());
          $results = $q->fetchAll();


          if (isset($_POST['showall'])) {

            $q = $DB->prepare("SELECT * FROM todo WHERE userid = '" . $_SESSION["username"] . "'");
            $q->execute(array());
            $results = $q->fetchAll();
          }
          if (isset($_POST['hideComplated'])) {

            $q = $DB->prepare("SELECT * FROM todo WHERE userid = '" . $_SESSION["username"] . "'AND status = 'false'");
            $q->execute(array());
            $results = $q->fetchAll();
          }


          if (isset($_POST["delete"])) {
            foreach ($results as $result) {
              $delTodo = $_POST["delete"];
              $del = $result["id"];
              if ($delTodo == $del) {
                $delete = $DB->prepare("DELETE FROM todo WHERE id='$delTodo'");
                $delete->execute();
                $results = $delete->fetch();
                header("Location: index.php");
                exit();
              }
            }
          }



          foreach ($results as $result) {
            echo " <div style='display: flex; justify-content:space-between;align-items:center;'>
            <span>{$result['content']}</span>
            <div>
              <form action='#' method='POST'>
              <button class='btn btn-outline-danger' name='delete' value='{$result['id']}'>Delete</button>
              <a href='update.php?id={$result['id']}' class='btn btn-outline-success' name='update'>Update</a>
              <a href='done.php?id={$result['id']}' class='btn btn-outline-danger'>Done</a>
              </form>
            </div>
          </div>

      
";
          }

          ?>


        </tbody>

      </table>
    </div>
  </div>
</body>

</html>