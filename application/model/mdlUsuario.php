<?php

class mdlUsuario
{

  private $idUsuario;
  private $clave;
  private $estado;
  private $nombreUsuario;
  private $rolId;
  private $correo;
  private $db;

    public function __SET($variable, $valor){
      $this->$variable = $valor;
    }
    public function __GET($variable){
      return $this->$variable;
    }

  function __construct($db)
  {
    $this->db = $db;
  }



  public function guardarUsu(){
    $sql="CALL SP_guardarUsuario(?, ?, ?, ?)";

    try {
    $stm=$this->db->prepare($sql);
    $clave = encrypt($this->clave);
    $stm->bindParam(1, $this->idUsuario);
    $stm->bindParam(2, $clave);
    $stm->bindParam(3, $this->nombreUsuario);
    $stm->bindParam(4, $this->rolId);
    $resultado = $stm->execute();
    return $resultado;
  } catch (Exception $e) {
    exit("No se pudo guardar el registro");
  }
  }



  public function ListarUsuarios()
  {
    $sql = "CALL SP_listar_usuarios()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }



  public function ListarRol(){
    $sql = "CALL SP_listar_rol()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }



  public function ListarPersEmpleadoFijoID($id){
    $sql= "CALL SP_Listar_PersEmpleado_FijoID(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $id);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }



  public function UsuarioPorCodigo($id_usuarios){
      $sql = "CALL SP_Usuario_Por_Codigo(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $id_usuarios);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
      }



  public function modificarUsuario(){
    $sql = "CALL SP_Modificar_Usuarios(?, ?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombreUsuario);
    $stm->bindParam(2, $this->rolId);
    $stm->bindParam(3, $this->idUsuario);
    return $stm->execute();
  }



    public function ModificarEstadoUsu($id){
     $sql="CALL SP_Cambiar_estado_Usuario(?) ";
     try {
       $ca = $this->db->prepare($sql);
       $ca->bindParam(1,$id);
        return $ca->execute();
     } catch (Exception $e) {

     }
    }

    public function ModificarEstadoUsuDesdeLiquidacion($id){
     $sql="CALL SP_Cambiar_estado_Usuario(?) ";
     try {
       $ca = $this->db->prepare($sql);
       $ca->bindParam(1,$id);
        return $ca->execute();
     } catch (Exception $e) {

     }
    }



    public function modificarContrasenia(){
      $sql = "CALL SP_modificar_clave(?, ?)";
      $stm = $this->db->prepare($sql);
      $clave = encrypt($this->clave);
      $stm->bindParam(1, $this->idUsuario);
      $stm->bindParam(2, $clave);
      return $stm->execute();
    }



    public function validarNombreUsu($id){
      $sql = "CALL SP_Validar_nombre_Usu(?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->nombreUsuario);
      $stm->bindParam(2, $id);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function validarNombreUsu2(){
      $sql = "CALL SP_Validar_Usuario2(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->nombreUsuario);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function validarModUsuario($id){
      $sql = "CALL SP_Validar_Modificacion_Usuario(?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $id);
      $stm->bindParam(2, $this->nombreUsuario);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function ValidarModEmail($id){
      $sql = "CALL SP_Validar_Modificacion_Email(?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $id);
      $stm->bindParam(2, $this->correo);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function consultarUsuarios(){
      $sql = "CALL SP_Consultar_Usuarios()";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function consultarEmail($id){
      $sql = "CALL SP_Consultar_Emails(?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->correo);
      $stm->bindParam(2, $id);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function consultarEmailProveedor($id){
      $sql = "CALL SP_Consultar_Email_Proveedor(?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $id);
      $stm->bindParam(2, $this->correo);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function ModNombreUsu($id){
      $sql = "CALL SP_Validar_Nombre_Usuario(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $id);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function ModEmailusuario($id){
      $sql = "CALL SP_Validar_Mod_Email(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $id);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
  }
 ?>
