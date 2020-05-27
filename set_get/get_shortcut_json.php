<?php
session_start();
include "../database_handler/bdd.php";
if(isset($_SESSION["ident"]) and isset($_POST["id_shortcut"])){
  $ident = $_SESSION["ident"];
  $id = $_POST["id_shortcut"];
  $shortcut = get_shortcut($ident, $id);
  if($shortcut != false){
    $json = array(
        "id_shortcut" => $shortcut["id_shortcut"],
        "nom" => $shortcut["nom"],
        "description" => $shortcut["description"],
        "website" => $shortcut["website"],
        "image" => $shortcut["image"],
        "letter" => $shortcut[0],
    );
    echo json_encode($json, JSON_PRETTY_PRINT);
  }
}

?>
