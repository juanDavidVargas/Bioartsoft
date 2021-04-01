<?php

  class mdlTipoPersona
  {
    private $idTipoPersona;
    Private $nombreTipoPersona;
    Private $db;

    public function __SET($parametros, $valor){
      $this->$parametros= $valor;
    }

    public function __GET($parametros){
      return $this->$parametros;
    }

  function __construct($db)
  {
    try {
        $this->db = $db;
    } catch (PDOException $e) {
        exit('Database connection could not be established.');
    }
  }



  public function listarTipoPersonas(){
      $sql="CALL SP_Listar_tipo_persona()";
      $stm=$this->db->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function listarTipoClientes(){
      $sql = "CALL SP_Listar_Tipo_Clientes()";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }



    public function listarTipoPerVendedor(){
        $sql="CALL SP_Listar_TipoPersona_Vendedor";
        $stm=$this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      }
  }

 ?>
