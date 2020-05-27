<?php
session_start();
  include '../database_handler/bdd.php';
  if(isset($_POST['id_rss']) and isset($_SESSION['ident'])){
    $id_rss = $_POST['id_rss'];
    $ident = $_SESSION['ident'];
    
    echo remove_rss($id_rss, $ident);
  } else {
    echo 'false';
  }

?>
