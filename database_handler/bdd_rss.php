<?php
  function create_rss(){
    return bdd()->query("CREATE TABLE IF NOT EXISTS rss
      (
        id_rss INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(50),
        howmany int(2),
        website TEXT(1000),

        ident_user VARCHAR(50),
        CONSTRAINT fk_rss_user FOREIGN KEY (ident_user) REFERENCES user(ident)
      );
    ");
  }

  function add_rss($url, $title, $howmany, $ident_user){
    $stmt = bdd()->prepare("INSERT INTO rss (website, title, howmany, ident_user) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$url, $title, $howmany, $ident_user]);
  }

  function edit_rss($id, $ident_user, $title, $link, $quantity){
    $stmt = bdd()->prepare("UPDATE rss SET website = ?, title = ?, howmany = ? WHERE ident_user = ? and id_rss = ?");
    return $stmt->execute([$link, $title, $quantity, $ident_user, $id]);
  }

  function get_rss($ident_user){
    $stmt = bdd()->prepare("SELECT * FROM rss WHERE ident_user = ?");
    $executed = $stmt->execute([$ident_user]);
    $tab_rss = array();
    if($executed){
      while ($rss = $stmt->fetch()) {
        array_push($tab_rss, $rss);
      }
      return $tab_rss;
    } else {
      return false;
    }
  }

  function get_rss_by_id($ident_user, $id_rss){
    $stmt = bdd()->prepare("SELECT * FROM rss WHERE ident_user = ? AND id_rss = ?");
    $executed = $stmt->execute([$ident_user, $id_rss]);
    if($executed){
      return $stmt->fetch();
    } else {
      return false;
    }
  }

  function remove_rss($id_rss, $ident_user){
    $stmt =  bdd()->prepare("DELETE FROM rss WHERE id_rss = ? AND ident_user = ?");
    return $stmt->execute([$id_rss, $ident_user]);
  }
?>
