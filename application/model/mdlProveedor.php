<?php


class mdlProveedor
{

  private $nitEmpresa;
  private $nombreEmpresa;
  private $telefonoEmpresa;
  private $idPersonaJuridica;
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



  public function registrarProveedor(){
    $sql= "CALL	SP_Registrar_Proveedor(?, ?, ?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nitEmpresa);
    $stm->bindParam(2, $this->nombreEmpresa);
    $stm->bindParam(3, $this->telefonoEmpresa);
    $stm->bindParam(4, $this->idPersona);
  }



  public function listar(){
    $sql = "CALL SP_ListarProveedor()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }



  public function listarNatural(){
    $sql = "CALL SP_listarProveedorNatural()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


  public function listarJuridico(){
    $sql = "CALL SP_listarProveedorJuridico()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }
}

 ?>
