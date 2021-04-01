<?php

class Menu{
  private $db;
  public function __construct(){
    $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
    $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
  }


  public function getMenu(){
    $sql = "CALL SP_Menu(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $_SESSION['ROL']);
    $stm->execute();
    return  $stm->fetchAll(PDO::FETCH_ASSOC);
  }



  public function getPermisos($url){
    if(!isset($_SESSION['ROL'])){
      return false;
    }
    $rol = $_SESSION['ROL'];

   $sql = "CALL SP_Paginas(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $rol);
    $stm->bindParam(2, $url);
    $stm->execute();
    $resultados =  $stm->fetchAll(PDO::FETCH_ASSOC);
    return count($resultados) > 0;
    }

}

 ?>
