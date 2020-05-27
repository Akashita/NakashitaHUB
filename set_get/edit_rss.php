<?php
session_start();
  include '../database_handler/bdd.php';
  if(isset($_POST['rss_id']) and isset($_POST['rss_title']) and isset($_POST['rss_link']) and isset($_POST['rss_quantity']) and isset($_SESSION['ident'])){
    $rss_id = $_POST['rss_id'];
    $rss_title = $_POST['rss_title'];
    $rss_link = $_POST['rss_link'];
    $rss_quantity = $_POST['rss_quantity'];
    $ident = $_SESSION['ident'];

    echo edit_rss($rss_id, $ident, $rss_title, $rss_link, $rss_quantity);
  } else {
    echo 'false';
  }

?>
