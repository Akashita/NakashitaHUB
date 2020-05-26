<?php

include 'bdd_user.php';
include 'bdd_shortcut.php';
include 'bdd_calendar.php';
include 'bdd_rss.php';


function bdd(){
  $bdd_name = 'nakashitahub';
  try {
  	$bdd = new PDO('mysql:host=localhost', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->query("CREATE DATABASE IF NOT EXISTS $bdd_name");
    $bdd->query("use $bdd_name");
  } catch (Exception $e) {
          die('Erreur : ' . $e->getMessage());
  }
  return $bdd;
}

create_user();
create_shortcut();
create_calendar();
create_rss();

?>
