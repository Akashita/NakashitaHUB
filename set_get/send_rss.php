<?php
session_start();
  include '../database_handler/bdd.php';
  if(isset($_POST['rss_url']) and isset($_POST['rss_title']) and isset($_POST['rss_quantity']) and isset($_SESSION['ident'])){
    $rss_url = $_POST['rss_url'];
    $rss_title = $_POST['rss_title'];
    $rss_quantity = $_POST['rss_quantity'];
    $ident = $_SESSION['ident'];

    echo add_rss($rss_url, $rss_title, $rss_quantity, $ident);
  } else {
    echo 'false';
  }

?>
