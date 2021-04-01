<?php


class mdlCompras
{

  private $id_compra;
  private $Codigo_producto;
  private $codigo_proveedor;
  private $cantidad;
  private $valor_total;
  private $estado;
  private $empleado;
  private $fechainicial;
  private $fechafinal;
  private $precio_unitario;
  private $precio_por_mayor;
  private $precio_detal;
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
    } catch (PDOException $e) {
      exit("No se pudo establecer conexión con la base de datos");
    }
  }


  public function listarpdf()
 {
   $sql="CALL  SP_Informe_Compras(?,?)";
   try {
    $ca = $this->db->prepare($sql);
    $ca->bindParam(1,$this->fechainicial);
    $ca->bindParam(2,$this->fechafinal);
   $ca->execute();
    return $ca->fetchAll(PDO::FETCH_ASSOC);
   } catch (Exception $e) {

   }

 }


 public function totalPorFecha()
{
  $sql="CALL  SP_Total_Compras_Fecha(?,?)";
  try {
   $ca = $this->db->prepare($sql);
   $ca->bindParam(1,$this->fechainicial);
   $ca->bindParam(2,$this->fechafinal);
  $ca->execute();
   return $ca->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {

  }

}


 public function validarFechaCompra()
{
  $sql="CALL  SP_Validar_Fecha(?)";
  try {
   $ca = $this->db->prepare($sql);
   $ca->bindParam(1,$this->fechainicial);
   $ca->execute();
   return $ca->fetch(PDO::FETCH_ASSOC);
  } catch (Exception $e) {

  }

}


  public function insertarCompra(){
    try{
    $sql = "CALL 	SP_insertarCompra(?, ?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->valor_total);
    $stm->bindParam(2, $this->codigo_proveedor);
    $stm->bindParam(3, $this->empleado);
    $resultado = $stm->execute();
    $this->id_compra  = $this->ultimaCompra()["ultima"];
    return $resultado;
  }catch(PDOException $e){
    echo $e->getMessage("Error");
  }
  }

  public function insertarDetalleCompra($codigoProd, $cant, $precio){
    $sql = "CALL 	SP_insertarDetalleCompra(?,?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigoProd);
    $stm->bindParam(2, $this->id_compra);
    $stm->bindParam(3, $cant);
    $stm->bindParam(4, $precio);
    return $stm->execute();
  }


    public function modificarPrecios(){
      $sql = "CALL SP_Modificar_Precios(?, ?, ?, ?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->precio_unitario);
      $stm->bindParam(2, $this->precio_detal);
      $stm->bindParam(3, $this->precio_por_mayor);
      $stm->bindParam(4, $this->Codigo_producto);
      return $stm->execute();
    }


  public function ValidarCantidadporEstado($codigoProd, $cant){
    $sql = "CALL 	SP_Actualizar_Existencia_por_Estado(?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigoProd);
    $stm->bindParam(2, $this->id_compra);
    $stm->bindParam(3, $cant);
    return $stm->execute();
  }



  public function ultimaCompra(){
    $sql = "CALL 	SP_UltimaCompra()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetch();
  }



  public function listarCompras(){
    $sql = "CALL SP_ListarCompras()";
    $stm = $this->db->prepare($sql);
    $stm ->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }



  public function cambiarEstado($codigo, $estado){
    $sql = "CALL SP_AnularCompra(?, ?)";

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
  $detalles = $this->getDetallesCompra($codigo);
  $ok = true;
  # recorremos los detalles
  foreach($detalles AS $detalle){
    $r = $this->devolverProducto($detalle['cantidad'], $detalle['id_producto']);
    # si ocurrió un error al devolver el producto cancelamos todo
    if($r == false){
      $ok = false;
      break;
    }
  }
  return $ok;
}


public function devolverProducto($cantidad, $producto){
  $sql = "CALL SP_Actualizar_Existencia_compra(?, ?)";
  $stm = $this->db->prepare($sql);
  $stm->bindParam(1, $cantidad);
  $stm->bindParam(2, $producto);
  return $stm->execute();
}


  public function getDetallesCompra($idCompra){
    $sql = "CALL SP_DetallesCompra(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $idCompra);
    $stm->execute();
    return $stm->fetchAll(2);

  }

  public function pdfDetallesCompra($idCompra){
    $sql = "CALL SP_Pdf_DetallesCompra(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $idCompra);
    $stm->execute();
    return $stm->fetchAll(2);

  }


  public function getInfoCompra($codigo){
    $sql = "CALL SP_InfoCompra(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigo);
    $stm->execute();
    return $stm->fetch(2);
  }

}

?>
