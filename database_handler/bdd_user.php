<?php
  function create_user(){
    return bdd()->query("CREATE TABLE IF NOT EXISTS user
      (
        ident VARCHAR(50) NOT NULL PRIMARY KEY,
        password VARCHAR(50) NOT NULL,
        nom VARCHAR(50),
        prenom VARCHAR(50),
        image TEXT(1000)
      )
    ");
  }

  function add_user($ident, $password, $nom, $prenom, $url){
    $stmt = bdd()->prepare("SELECT * FROM user WHERE ident = ?");
    $executed = $stmt->execute([$ident]);
    $ret = false;
    if ($executed){
      if($stmt->fetch() == NULL){
        $result = bdd()->prepare("INSERT INTO user (ident, password, nom, prenom, image) VALUES (?, ?, ?, ?, ?)");
        $ret = $result->execute([$ident, $password, $nom, $prenom, $url]);
      }
    }
    return $ret;
  }


  function connect_user($ident, $password){
    $stmt = bdd()->prepare("SELECT * FROM user WHERE ident = ? AND password = ?");
    $executed = $stmt->execute([$ident, $password]);
    if($executed){
      return $stmt->fetch();
    } else {
      return false;
    }
  }


  function remove_user($ident){
    $stmt = bdd()->prepare("DELETE FROM user WHERE ident = ?");
    return $stmt->execute([$ident]);
  }


  ?>
