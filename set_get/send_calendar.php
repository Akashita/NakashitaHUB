<?php
session_start();
  include '../database_handler/bdd.php';
  if(isset($_POST['calendar_url']) and isset($_SESSION['ident'])){
    $calendar_url = $_POST['calendar_url'];
    $ident = $_SESSION['ident'];

    echo add_calendar($calendar_url, $ident);
  } else {
    echo 'false';
  }

?>
