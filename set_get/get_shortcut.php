<?php
session_start();
include '../database_handler/bdd.php';
if(isset($_SESSION['ident'])){
  $ident = $_SESSION['ident'];

  $shortcuts = get_shortcut($ident);
  if($shortcuts != false){
    foreach ($shortcuts as $shortcut) {
      ?>
      <div class="shortcut" id="shortcut_<?php echo $shortcut['id_shortcut']?>">
        <a href="<?php echo $shortcut['website'];?>">
          <div class="shortcut_img" style="background-image: url(<?php echo $shortcut['image']; ?>);"></div>
        </a>
        <div class="shortcut_gradient"></div>
        <div class="shortcut_content">
          <div class="shortcut_letter"><?php echo $shortcut['letter']; ?></div>
          <div class="shortcut_name"><?php echo $shortcut['nom']; ?></div>
          <div class="shortcut_text">
            <?php echo $shortcut['description']; ?>
          </div>
          <div class="action_container action_shortcut">
            <div class="action_logo action"></div>
            <div class="delete_shortcut action"></div>
            <div class="edit_shortcut action"></div>
          </div>
        </div>
      </div>
      <?php
    }
  }
}

?>
