<?php


class mdlPersona
{

  private $idPersona;
  Private $nombres;
  private $apellidos;
  Private $telefono;
  private $celular;
  Private $email;
  private $tipoPersona;
  Private $direccion;
  private $genero;
  Private $tipoDocumento;
  Private $fechaContrato;
  private $fechaTerminacion;
  private $estado;
  private $nitEmpresa;
  private $nombreEmpresa;
  private $telefonoEmpresa;
  private $idPersonaJuridica;
  private $nombreUsuario;
  private $fechainicial;
  private $fechafinal;
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


  public function ListarPrestamos()
  {
    $sql = "CALL SP_Listar_Prestamos(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1,$this->fechainicial);
    $stm->bindParam(2,$this->fechafinal);
    $stm->execute();
    return $stm->fetchAll(2);
  }


  public function listarNotificacionesPrestamos(){
    $sql = "CALL SP_Notificacion_Prestamos_a_Vencer()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


  public function totalPorFecha()
 {
   $sql="CALL  SP_Total_Prestamos_Fecha(?,?)";
   try {
    $ca = $this->db->prepare($sql);
    $ca->bindParam(1,$this->fechainicial);
    $ca->bindParam(2,$this->fechafinal);
   $ca->execute();
    return $ca->fetchAll(PDO::FETCH_ASSOC);
   } catch (Exception $e) {

   }

 }


  public function ListarPrestamos2()
  {
    $sql = "CALL SP_Listar_Prestamos2()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(2);
  }


  public function listarPagosEmp($id)
  {
    $sql = "CALL SP_Informe_Pagos(?)";
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $id);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
  }



    public function ultimoId(){
        return $this->db->lastInsertId();
    }


    public function listarPrestamosEmp()
    {
      $sql = "CALL SP_Informe_Prestamos_Por_Empleado(?)";
            $stm = $this->db->prepare($sql);
            $stm->bindParam(1, $this->idPersona);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


  public function listarPagosPorEmp()
  {
    $sql = "CALL SP_Informe_Pagos2(?)";
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idPersona);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


  public function listarInformePrestamos()
  {
    $sql = "CALL SP_Informe_Prestamos(?, ?)";
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1,$this->fechainicial);
          $stm->bindParam(2,$this->fechafinal);
          $stm->execute();
          return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


  public function guardarPersona()
  {
    $sql="CALL SP_GuardarPersona(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    try {
    $stm=$this->db->prepare($sql);
    $stm->bindParam(1, $this->idPersona);
    $stm->bindParam(2, $this->telefono);
    $stm->bindParam(3, $this->nombres);
    $stm->bindParam(4, $this->email);
    $stm->bindParam(5, $this->direccion);
    $stm->bindParam(6, $this->apellidos);
    $stm->bindParam(7, $this->genero);
    $stm->bindParam(8, $this->tipoDocumento);
    $stm->bindParam(9, $this->tipoPersona);
    $stm->bindParam(10, $this->celular);
    $stm->bindParam(11, $this->fechaContrato);
    $stm->bindParam(12, $this->fechaTerminacion);
    $resultado = $stm->execute();
    $sql = "CALL 	SP_Consultar_Personas";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $resultado;
  } catch (Exception $e) {
    $e->getMessage();
  }

  }


  public function registrarProveedorNatural()
  {
    $sql="CALL SP_GuardarPersona(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    try {
    $stm=$this->db->prepare($sql);
    $stm->bindParam(1, $this->idPersona);
    $stm->bindParam(2, $this->telefono);
    $stm->bindParam(3, $this->nombres);
    $stm->bindParam(4, $this->email);
    $stm->bindParam(5, $this->direccion);
    $stm->bindParam(6, $this->apellidos);
    $stm->bindParam(7, $this->genero);
    $stm->bindParam(8, $this->tipoDocumento);
    $stm->bindParam(9, $this->tipoPersona);
    $stm->bindParam(10, $this->celular);
    $stm->bindParam(11, $this->fechaContrato);
    $resultado = $stm->execute();
    return $resultado;
    } catch (Exception $e) {
      $e->getMessage();
    }

    }


    public function consultarProveedorJ(){
        $sql = "CALL SP_Consultar_Proveedor_Juridico(?)";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->idPersona);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      }


      public function registrarProveedorJuridico(){
        $sql = "CALL SP_Insertar_Proveedor_Juridico(?, ?, ?, ?)";
        try {

        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->nitEmpresa);
        $stm->bindParam(2, $this->nombreEmpresa);
        $stm->bindParam(3, $this->telefonoEmpresa);
        $stm->bindParam(4, $this->idPersona);
        $resultado = $stm->execute();
        return $resultado;
      } catch (Exception $e) {
          $e->getMessage();
      }
      }


      public function actualizarFecha(){
        $sql = "CALL SP_Actualizar_fecha_fin_contrato(?, ?)";
        try {
          $stm = $this->db->prepare($sql);
          $stm->bindParam(1, $this->idPersona);
          $stm->bindParam(2, $this->fechaContrato);
          $resultado = $stm->execute();
          return $resultado;
      } catch (Exception $e) {
          $e->getMessage();
      }
      }


    public function insertarProveedor(){
      $sql = "CALL SP_Insertar_Proveedor(?, ?, ?, ?)";
      try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->nitEmpresa);
      $stm->bindParam(2, $this->nombreEmpresa);
      $stm->bindParam(3, $this->telefonoEmpresa);
      $stm->bindParam(4, $this->idPersona);
      $resultado = $stm->execute();
      return $resultado;
      } catch (Exception $e) {
          $e->getMessage();
      }
    }


    public function borrarProveedor(){

        $sql = "CALL SP_borrar_proveedor(?)";
        try {
            $stm = $this->db->prepare($sql);
            $stm->bindParam(1, $this->idPersona);
            return $stm->execute();

        } catch (Exception $e) {

        }

      }


  public function modificarProveedor($id){
    $sql = "CALL	SP_Modificar_Proveedor(?, ?, ?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nitEmpresa);
    $stm->bindParam(2, $this->nombreEmpresa);
    $stm->bindParam(3, $this->telefonoEmpresa);
    $stm->bindParam(4, $id);
    return $stm->execute();
}


  public function listarRoles(){
    $sql = "CALL SP_Listar_Roles";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}


  public function guardardetallesPersona($idPersona, $idUsuario){
      $sql ="SP_insertar_detalle_usuarios(?,?)";
      $stm = $this->db->prepare($sql);
      $stm = bindParam(1, $idPersona);
      $stm = bindParam(2, $idUsuario);
      return $stm->execute();
}


  public function ListarPersEmpleadoFijo(){
    $sql= "CALL SP_listar_Personas_emp_fijo()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}


    public function ListarPersEmpleadoPdf(){
    $sql= "CALL SP_listar_Personas_emp_fijo2()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


  public function ListarPersEmpleadoFecha(){
    $sql= "CALL SP_TraerPersonaFechaPago()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


  public function ListarPersEmpleado(){
    $sql= "CALL SP_Listar_emple";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


  public function ListarProveedor(){
    $sql= "CALL SP_listar_proveedor()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}


public function ListarProveedorReporte(){
  $sql= "CALL SP_listar_proveedor_reporte()";
  $stm = $this->db->prepare($sql);
  $stm->execute();
  return $stm->fetchAll(PDO::FETCH_ASSOC);
}


  public function ListarProveedorID($id){
    $sql= "CALL SP_Listar_Proveedores_ID(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $id);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);

  }


  public function ListarProveedoresJurID($id){
    $sql= "CALL SP_Listar_Proveedor_Jur_ID(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $id);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
}


  public function tipoPersonaProveedor(){
    $sql= "CALL SP_Listar_tipo_persona_proveedores";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}


public function tipoPersonaEmpleados(){
  $sql= "CALL SP_Listar_tipo_persona_Empleados";
  $stm = $this->db->prepare($sql);
  $stm->execute();
  return $stm->fetchAll(PDO::FETCH_ASSOC);
}


public function tipoPersonaProveedores(){
  $sql= "CALL SP_Listar_TipoPersona_Proveedores";
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


  public function modificarPersona(){
    $sql = "CALL SP_modificar_persona(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombres);
    $stm->bindParam(2, $this->apellidos);
    $stm->bindParam(3, $this->celular);
    $stm->bindParam(4, $this->email);
    $stm->bindParam(5, $this->telefono);
    $stm->bindParam(6, $this->direccion);
    $stm->bindParam(7, $this->fechaContrato);
    $stm->bindParam(8, $this->genero);
    $stm->bindParam(9, $this->tipoPersona);
    $stm->bindParam(10, $this->fechaTerminacion);
    $stm->bindParam(11, $this->idPersona);
    return $stm->execute();
}


  public function validarIdPersona(){
    $sql = "CALL 	SP_Validar_Id_Persona(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->idPersona);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function ValidarEmail(){
    $sql = "CALL 	SP_Validar_Email(?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->email);
    $stm->bindParam(2, $this->idPersona);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function ValidarEmail2(){
    $sql = "CALL SP_validar_email2(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->email);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function validarNombreUsu(){
    $sql = "CALL 	SP_Validar_Usuario(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombreUsuario);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
}


    public function consultarCorreo(){
      $sql = "CALL 	SP_Consultar_Correo(?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->email);
      $stm->bindParam(2, $this->idPersona);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function consultarUsuario(){
      $sql = "CALL 	SP_Consultar_Usuario(?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->nombreUsuario);
      $stm->bindParam(2, $this->idPersona);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


  public function ModificarEstadoProv($id){
   $sql="CALL SP_Cambiar_estado_Proveedor(?) ";
   try {
     $stm = $this->db->prepare($sql);
     $stm->bindParam(1, $id);
      return $stm->execute();
   } catch (Exception $e) {

   }
  }


  public function ModificarEstadoCliente($id){
    $sql = "CALL SP_Cambiar_Estado_Cliente(?)";
    try {
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $id);
       return $stm->execute();
    } catch (Exception $e) {

    }

  }


  public function  ListarPersonasClientesID($id){
   $sql= "CALL SP_Listar_PersClienteID(?)";
   $stm = $this->db->prepare($sql);
   $stm->bindParam(1, $id);
   $stm->execute();
   return $stm->fetch(PDO::FETCH_ASSOC);
 }


 public function tipoPersonaCliente(){
   $sql= "CALL SP_Listar_tipo_persona_Clientes";
   $stm = $this->db->prepare($sql);
   $stm->execute();
   return $stm->fetchAll(PDO::FETCH_ASSOC);
 }


   public function ListarPersClientes(){
     $sql= "CALL SP_listar_Personas_Clientes()";
     $stm = $this->db->prepare($sql);
     $stm->execute();
     return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function ListarPersClientesReporte(){
      $sql= "CALL SP_listar_Personas_Clientes_Reporte()";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
     }

}

 ?>
