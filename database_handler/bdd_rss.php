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

  function get_rss($ident_user){
    $stmt = bdd()->prepare("SELECT r.* FROM rss r JOIN user u ON r.ident_user = u.ident WHERE r.ident_user = ?");
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

  function remove_rss($id_rss){
    $stmt = bdd()->prepare("DELETE FROM rss WHERE id_rss = ?");
    return $stmt->execute([$id_rss]);
  }
?>
