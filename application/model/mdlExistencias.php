<?php

/**
*
*/
class mdlExistencias
{

	private $db;
  private $fecha_salida;
  private $tipo_baja;
  private $id_bajas;
	private $fechainicial;
	private $fechafinal;
	private $id_persona;

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


   public function listarpro(){

		  $sql="CALL SP_listar_producto()";

		  try {
		   $ca= $this->db->prepare($sql);
		  $ca->execute();
		   return $ca->fetchAll(PDO::FETCH_ASSOC);
		  } catch (Exception $e) {

		  }

  }


 // public function totalPorFecha()
 // {
 //  $sql="CALL  SP_Total_Bajas_Fecha(?,?)";
 //  try {
 // 	$ca = $this->db->prepare($sql);
 // 	$ca->bindParam(1,$this->fechainicial);
 // 	$ca->bindParam(2,$this->fechafinal);
 //  $ca->execute();
 // 	return $ca->fetchAll(PDO::FETCH_ASSOC);
 //  } catch (Exception $e) {
 //
 //  }
 //
 // }


	public function getDb(){
		return $this->db;
	}


  public function insertarBaja(){
    $sql = "CALL SP_InsertarBaja(?)";
    try {

    $stm = $this->db->prepare($sql);
		$stm->bindParam(1, $this->id_persona);
    return $stm->execute();

    } catch (Exception $e) {

    }
  }


  public function ultimaBaja(){
		$sql = "CALL SP_UltimaBaja";
		try {
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$r = $stm->fetch(2);
			return $r['ultimo_id'];
		} catch (Exception $e) {

		}

  }


    public function insertarDetalleBaja($idbaja, $Tbl_Productos_id_productos,$cant,$tipo){
    $sql = "CALL SP_DetalleBaja(?,?,?,?)";
		try {
			$stm = $this->db->prepare($sql);
			$stm->bindParam(1, $idbaja);
			$stm->bindParam(2, $Tbl_Productos_id_productos);
			$stm->bindParam(3, $cant);
			$stm->bindParam(4, $tipo);
			return $stm->execute();
		} catch (Exception $e) {

		}

  }


	public function listarBajas()
	{
		$sql = "CALL SP_ListarBajas()";
		try {
			$stm=$this->db->prepare($sql);
			$stm->execute();
	  return $stm->fetchAll(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
		}
	}


	public function pdfBajas()
	{
		$sql = "CALL SP_Informe_Bajas()";
		try {
			$stm=$this->db->prepare($sql);
			$stm->execute();
	  return $stm->fetchAll(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
		}
	}


	public function cambiarEstado($codigo, $estado){
    $sql = "CALL SP_AnularBaja(?, ?)";

    $this->db->beginTransaction();

    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigo);
    $stm->bindParam(2, $estado);
    $respuesta =  $stm->execute();

    if($respuesta == true && $this->devolverProductos($codigo)){
      # confirmamos los cambios
      $this->db->commit();
    } else {
      # hubo error, entonces devolvemos los cambios realizados
      $this->db->rollback();
    }
    return $respuesta;
}


		public function devolverProductos($codigo){
		  # listamos los detalles
		  $detalles = $this->getDetallesBajas($codigo);
		  $ok = true;
		  # recorremos los detalles
		  foreach($detalles AS $detalle){
		    $r = $this->devolverProducto($detalle['Cantidad'], $detalle['Tbl_Productos_id_productos']);
		    # si ocurrió un error al devolver el producto cancelamos todo
		    if($r == false){
		      $ok = false;
		      break;
		    }
		  }
		  return $ok;
		}


		public function devolverProducto($cantidad, $producto){
		  $sql = "CALL SP_Actualizar_Exitencia_Bajas(?, ?)";
		  $stm = $this->db->prepare($sql);
		  $stm->bindParam(1, $cantidad);
		  $stm->bindParam(2, $producto);
		  return $stm->execute();
		}


		public function getDetallesBajas($idBaja){
			$sql = "CALL SP_DetallesBajas(?)";
			$stm = $this->db->prepare($sql);
			$stm->bindParam(1, $idBaja);
			$stm->execute();
			return $stm->fetchAll(2);
		}


		public function validarFechaBaja()
		{
		 $sql="CALL  SP_Validar_Fecha_Baja(?)";
		 try {
			$ca = $this->db->prepare($sql);
			$ca->bindParam(1,$this->fechainicial);
			$ca->execute();
			return $ca->fetch(PDO::FETCH_ASSOC);
		 } catch (Exception $e) {

		 }

		}


		public function listarpdf()
	 {
	   $sql="CALL  SP_Informe_Bajas_Por_fecha(?,?)";
	   try {
	    $ca = $this->db->prepare($sql);
	    $ca->bindParam(1,$this->fechainicial);
	    $ca->bindParam(2,$this->fechafinal);
	   $ca->execute();
	    return $ca->fetchAll(PDO::FETCH_ASSOC);
	   } catch (Exception $e) {

	   }

	 }

}


 ?>
