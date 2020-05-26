<?php
  function create_calendar(){
    return bdd()->query("CREATE TABLE IF NOT EXISTS calendar
      (
        id_calendar INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        website TEXT(1000),

        ident_user VARCHAR(50),
        CONSTRAINT fk_calendar_user FOREIGN KEY (ident_user) REFERENCES user(ident)
      );
    ");
  }


  function add_calendar($url, $ident_user){
    $stmt = bdd()->prepare("INSERT INTO calendar (website, ident_user) VALUES (?, ?)");
    return $stmt->execute([$url, $ident_user]);
  }

  function get_calendar($ident_user){
    $stmt = bdd()->prepare("SELECT c.* FROM calendar c JOIN user u ON c.ident_user = u.ident WHERE c.ident_user = ?");
    $executed = $stmt->execute([$ident_user]);

    $tab_calendar = array();
    if($executed){
      while ($calendar = $stmt->fetch()) {
        array_push($tab_calendar, $calendar);
      }
      return $tab_calendar;
    } else {
      return false;
    }
  }

  function remove_calendar($id_calendar){
    $stmt = bdd()->prepare("DELETE FROM calendar WHERE id_calendar = ?");
    return $stmt->execute([$id_calendar]);
  }

?>
