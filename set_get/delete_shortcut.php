<?php
session_start();
  include '../database_handler/bdd.php';
  if(isset($_POST['id_shortcut']) and isset($_SESSION['ident'])){
    $id_shortcut = $_POST['id_shortcut'];
    $ident = $_SESSION['ident'];

    echo remove_shortcut($id_shortcut, $ident);
  } else {
    echo 'false';
  }

?>
