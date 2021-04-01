<?php


class mdlCliente
{

  private $documento;
  private $nombres;
  private $apellidos;
  private $telefono;
  private $direccion;
  private $db;

  public function __SET($attr, $valor){
    $this->$attr = $valor;
  }


  public function __GET($attr){
    return $this->$attr;
  }


  function __construct($db)
  {
    try {
      $this->db = $db;
    } catch (Exception $e) {
      exit('Database connection could not be estabilished');
    }
  }


  public function listar(){
    $sql = "CALL  SP_ListarClientesVenta()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }
}

 ?>
