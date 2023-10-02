<?php
require 'loggedcontrol.php';

require_once('db.php');

if (isset($_GET['id'])) {

  $status = 'true';

  $id = $_GET['id'];

  $sql = "UPDATE todo SET status = :status  WHERE id = :id";
  $SORGU = $DB->prepare($sql);

  $SORGU->bindParam(':status', $status);

  $SORGU->bindParam(':id', $id);


  $SORGU->execute();
  echo "TODO yapıldı.";
  header("location: index.php");
  die();
}
