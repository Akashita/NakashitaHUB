
<?php
session_start();
  include '../database_handler/bdd.php';
  if(isset($_POST['shortcut_name']) and isset($_POST['shortcut_description']) and isset($_POST['shortcut_url']) and isset($_POST['shortcut_keymap']) and isset($_SESSION['ident']) and isset($_POST['shortcut_id'])){
    $shortcut_name = $_POST['shortcut_name'];
    $shortcut_description = $_POST['shortcut_description'];
    $shortcut_url = $_POST['shortcut_url'];
    $shortcut_image = $_POST['shortcut_image'];
    $shortcut_keymap = $_POST['shortcut_keymap'];
    $ident = $_SESSION['ident'];
    $id = $_POST['shortcut_id'];

    echo edit_shortcut($id, $shortcut_keymap, $shortcut_name, $shortcut_description, $shortcut_image, $shortcut_url, $ident);
  } else {
    echo 'false';
  }

?>
