<?php
  function create_shortcut(){
    return bdd()->query("CREATE TABLE IF NOT EXISTS shortcut
      (
        id_shortcut INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        letter CHAR,
        nom VARCHAR(50),
        description TEXT(500),
        image TEXT(1000),
        website TEXT(1000),

        ident_user VARCHAR(50),
        CONSTRAINT fk_shortcut_user FOREIGN KEY (ident_user) REFERENCES user(ident)
      );
    ");
  }

  function add_shortcut($letter, $name, $description, $image, $url, $ident_user){
    $stmt = bdd()->prepare("INSERT INTO shortcut (letter, nom, description, image, website, ident_user) VALUES (?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$letter, $name, $description, $image, $url, $ident_user]);
  }

  function edit_shortcut($id, $letter, $name, $description, $image, $url, $ident_user){
    $stmt = bdd()->prepare("UPDATE shortcut SET letter = ?, nom = ?, description = ?, image = ?, website = ? WHERE id_shortcut = ? AND ident_user = ?");
    return $stmt->execute([$letter, $name, $description, $image, $url, $id, $ident_user]);
  }

  function get_shortcuts($ident_user){
    $stmt = bdd()->prepare("SELECT * FROM shortcut WHERE ident_user = ?");
    $executed = $stmt->execute([$ident_user]);

    $tab_shortcut = array();
    if($executed){
      while ($shortcut = $stmt->fetch()) {
        array_push($tab_shortcut, $shortcut);
      }
      return $tab_shortcut;
    } else {
      return false;
    }
  }

  function get_shortcut($ident_user, $id_shortcut){
    $stmt = bdd()->prepare("SELECT s.* FROM shortcut s JOIN user u ON s.ident_user = u.ident WHERE s.ident_user = ? AND s.id_shortcut = ?");
    $executed = $stmt->execute([$ident_user, $id_shortcut]);

    $tab_shortcut = array();
    if($executed){
      return $stmt->fetch();
    } else {
      return false;
    }
  }

  function remove_shortcut($id_shortcut, $ident_user){
    $stmt =  bdd()->prepare("DELETE FROM shortcut WHERE id_shortcut = ? AND ident_user = ?");
    return $stmt->execute([$id_shortcut, $ident_user]);
  }



?>
