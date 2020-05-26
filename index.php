<?php
session_start();
if(!isset($_SESSION['connected'])){
  $_SESSION['connected'] = false;
}

include_once "database_handler/bdd.php";
bdd();

if (!$_SESSION['connected']) {
  if (!isset($_POST['username_text']) or !isset($_POST['password_text'])) {
    include 'login.php';
  } else if (($user = connect_user($_POST['username_text'], $_POST['password_text'])) != false) {
    $_SESSION['connected'] = true;
    $_SESSION['ident'] = $user['ident'];
    $_SESSION['nom'] = $user['nom'];
    $_SESSION['prenom'] = $user['prenom'];
    $_SESSION['image_perso'] = $user['image'];
  } else {
    include 'login.php';
  }
}

if ($_SESSION['connected']) {
  $user = $_SESSION['ident'];
  include 'main.php';
}


?>
