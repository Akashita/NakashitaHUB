<?php
session_start();
include "../database_handler/bdd.php";
if(isset($_SESSION["ident"]) and isset($_POST["id_rss"])){
  $ident = $_SESSION["ident"];
  $id = $_POST["id_rss"];
  $feed = get_rss_by_id($ident, $id);
  if($feed != false){
    $json = array(
        "id_rss" => $feed["id_rss"],
        "title" => $feed["title"],
        "howmany" => $feed["howmany"],
        "website" => $feed["website"]
    );
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
}

?>
