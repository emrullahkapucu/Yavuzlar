<?php
require 'loggedcontrol.php';

require_once('db.php');

if (isset($_POST['todo_form'])) {

  $todo  = $_POST['todo_form'];

  $id    = $_GET['id'];

  $sql = "UPDATE todo SET content = :todo_form  WHERE id = :id";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':todo_form',  $todo);

  $SORGU->bindParam(':id',    $id);
  $SORGU->execute();

  echo "TODO güncellendi";
  header("location: index.php");
  die();
}

$id    = $_GET['id'];

$sql = "SELECT * FROM todo WHERE id = :id";
$SORGU = $DB->prepare($sql);

$SORGU->bindParam(':id', $id);

$SORGU->execute();

$todo = $SORGU->fetchAll(PDO::FETCH_ASSOC);



?>


<<!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YavuzlarToDo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>


  <body class="bg-secondary">

    <form method="POST">
      <div class="container">
        <div class="row justify-content-center m-auto shadow bg-white mt-3 py-3 col-md-6">
          <h3 class="text-center text-dark font-monospace">TODO Güncelleme</h3>
          <div class="col-8">
            <input type="text" name="todo_form" class="form-control">
          </div>
          <div class="col-2">
            <button class="btn btn-outline-dark">Güncelle</button>
          </div>
        </div>
      </div>
    </form>
    <div class="container">
      <div class="col-8 bg-white m-auto mt-3">

        <table class="table">
          <tbody>

          </tbody>

        </table>
      </div>
    </div>
  </body>

  </html>