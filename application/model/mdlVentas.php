<?php


class mdlVentas
{

  private $codigo_venta;
  private $descuento;
  private $valor_total;
  private $codigo_cliente;
  private $cantidad;
  private $tipo_Pago;
  private $valor_subtotal;
  private $estado;
  private $_ValSubtotal_Minimo;
  private $_Porcentaje_MinimoD;
  private $_ValSubtotal_Maximo;
  private $_Porcentaje_MaximoD;
  private $codigoEmpleado;
  private $dias_credito;
  private $fechainicial;
  private $fechafinal;
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
   $sql="CALL SP_Informe_Ventas(?,?)";
   try {
    $ca = $this->db->prepare($sql);
    $ca->bindParam(1,$this->fechainicial);
    $ca->bindParam(2,$this->fechafinal);
   $ca->execute();
    return $ca->fetchAll(PDO::FETCH_ASSOC);
   } catch (Exception $e) {

   }

 }



 public function listarTotalFecha()
{
  $sql="CALL SP_Total_Ventas_Por_Fecha(?,?)";
  try {
   $ca = $this->db->prepare($sql);
   $ca->bindParam(1,$this->fechainicial);
   $ca->bindParam(2,$this->fechafinal);
  $ca->execute();
   return $ca->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {

  }

}


public function ultimoAbonoVentas($id)
{
 $sql="CALL SP_ultimo_Abono_Ventas_Recibo(?)";
 try {
  $ca = $this->db->prepare($sql);
  $ca->bindParam(1,$id);
 $ca->execute();
  return $ca->fetch(PDO::FETCH_ASSOC);
 } catch (Exception $e) {

 }

}


    public function ultimoIdAbono(){
        $sql = "SELECT max(idabono) as ultimo_id FROM tbl_abono_ventas WHERE Tbl_Ventas_idventas = ?";
        $stm = $this->db->prepare($sql);
        $stm->bindParam(1, $this->codigo_venta);
        $stm ->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function listarCreditosFecha()
    {
     $sql="CALL SP_listar_Creditos_Fecha(?,?)";
     try {
      $ca = $this->db->prepare($sql);
      $ca->bindParam(1,$this->fechainicial);
      $ca->bindParam(2,$this->fechafinal);
     $ca->execute();
      return $ca->fetchAll(PDO::FETCH_ASSOC);
     } catch (Exception $e) {

     }

    }


     public function listarganancias()
    {
      $sql="CALL SP_Reporte_Ganancias(?,?)";
      try {
       $ca = $this->db->prepare($sql);
       $ca->bindParam(1,$this->fechainicial);
       $ca->bindParam(2,$this->fechafinal);
      $ca->execute();
       return $ca->fetch(PDO::FETCH_ASSOC);
      } catch (Exception $e) {

      }

    }



 public function validarFechaventa()
{
  $sql="CALL  SP_Validar_Fecha_Venta(?)";
  try {
   $ca = $this->db->prepare($sql);
   $ca->bindParam(1,$this->fechainicial);
   $ca->execute();
   return $ca->fetch(PDO::FETCH_ASSOC);
  } catch (Exception $e) {

  }

}


    public function validarFechaGananacia()
    {
     $sql="CALL  SP_Validar_Fecha_Ganancia(?)";
     try {
      $ca = $this->db->prepare($sql);
      $ca->bindParam(1,$this->fechainicial);
      $ca->execute();
      return $ca->fetch(PDO::FETCH_ASSOC);
     } catch (Exception $e) {

     }

    }


  public function insertarVenta(){
    $sql = "CALL 	SP_InsertarVenta(?,?,?,?,?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->valor_subtotal);
    $stm->bindParam(2, $this->descuento);
    $stm->bindParam(3, $this->valor_total);
    $stm->bindParam(4, $this->codigo_cliente);
    $stm->bindParam(5, $this->tipo_Pago);
    $stm->bindParam(6, $this->codigoEmpleado);
    $resultado = $stm->execute();
    $this->codigo_venta  = $this->ultimaVenta()["ultima"];
    return $resultado;
  }


  public function insertarVentaCredito(){
    $sql = "CALL 	SP_Insertar_venta_Credito(?,?,?,?,?, ?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->valor_subtotal);
    $stm->bindParam(2, $this->descuento);
    $stm->bindParam(3, $this->valor_total);
    $stm->bindParam(4, $this->codigo_cliente);
    $stm->bindParam(5, $this->tipo_Pago);
    $stm->bindParam(6, $this->codigoEmpleado);
    $stm->bindParam(7, $this->dias_credito);
    $resultado = $stm->execute();
    $this->codigo_venta  = $this->ultimaVenta()["ultima"];
    return $resultado;
  }




  public function validarCantidad(){
    $sql = "CALL SP_Validar_Cantidad_Producto(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->idProducto);
    //$stm->bindParam(2, $this->cantidad);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


    public function insertarDetalleVenta($codigoProd, $cant, $precioProducto, $precioUnitario){
    $sql = "CALL 	SP_InsertarDetalleVenta(?,?,?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigoProd);
    $stm->bindParam(2, $this->codigo_venta);
    $stm->bindParam(3, $cant);
    $stm->bindParam(4, $precioProducto);
    $stm->bindParam(5, $precioUnitario);
    return $stm->execute();
  }



  public function ultimaVenta(){
    $sql = "CALL 	SP_UltimaVenta()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetch();
  }



  public function listarVentas(){
    $sql = "CALL 	SP_Listar_Ventas()";
    $stm = $this->db->prepare($sql);
    $stm ->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }



  public function cambiarEstado($codigo, $estado){
    $sql = "CALL SP_Anular_Venta(?, ?)";
    # abrimos la transacción
    $this->db->beginTransaction();

    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigo);
    $stm->bindParam(2, $estado);
    $respuesta = $stm->execute();
    # validamos si se ejecutó correctamente
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
    $detalles = $this->getDetallesVenta($codigo);
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
    $sql = "CALL SP_Actualizar_Existencia_venta(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $cantidad);
    $stm->bindParam(2, $producto);
    return $stm->execute();
  }




  public function getDetallesVenta($idVenta){
    $sql = "CALL SP_Detalles_Venta(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $idVenta);
    $stm->execute();
    return $stm->fetchAll(2);

  }


  public function pdfDetallesVenta($idVenta){
    $sql = "CALL SP_Pdf_Detalles_Venta(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $idVenta);
    $stm->execute();
    return $stm->fetchAll(2);
  }


  public function pdfDetallesAbono($id){
    $sql = "CALL SP_Pdf_Detalles_Abono(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $id);
    $stm->execute();
    return $stm->fetchAll(2);
  }


  public function pdfDetallesAbono2($id){
    $sql = "CALL SP_Pdf_Detalles_Abono2(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $id);
    $stm->execute();
    return $stm->fetchAll(2);
  }


  public function getInfoVenta($codigo){
    $sql = "CALL SP_Info_Venta(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigo);
    $stm->execute();
    return $stm->fetch(2);
  }



  public function fechaLimiteCredito()
  {
    $sql = "CALL SP_traerinfoCreditos(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->codigo_venta);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function modificarCredito()
  {
    $sql = "CALL SP_Actualizar_Fecha_Limite(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->codigo_venta);
    $stm->bindParam(2, $this->dias_credito);
    return $stm->execute();
  }


  public function listarConfiguracionVentas()
  {
    $sql = "CALL 	SP_Listar_Configuracion_Venta()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(2);
  }


  public function modificarConfiguracionVentas(){
   $sql ="CALL SP_ModificarConfiguracionVentas(?,?,?,?)";
   $stm = $this->db->prepare($sql);
   $stm->bindParam(1, $this->_ValSubtotal_Minimo);
   $stm->bindParam(2, $this->_Porcentaje_MinimoD);
   $stm->bindParam(3,$this->_ValSubtotal_Maximo);
   $stm->bindParam(4,$this->_Porcentaje_MaximoD);
   return $stm->execute();
  }


  public function listarClientesCreditoV(){
    $sql= "CALL SP_Listar_Cliente_Creditos_Ventas()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(2);
  }

  public function listarCreditosPdf(){
    $sql= "CALL SP_Reporte_Creditos()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(2);
  }


    public function estadoAbono(){
      $sql= "CALL SP_Consultar_Estado_Abono()";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(2);
    }


  public function getDetalleCreditosV($idPersona)
  {
    $sql = "CALL SP_getDetalleCreditosV(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $idPersona);
    $stm->execute();
    return $stm->fetchAll(2);
  }


  public function totalAbono($abono){
    $sql = "CALL SP_Consultar_Total_Abono(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->codigo_venta);
    $stm->bindParam(2, $abono);
    $stm->execute();
    return $stm->fetch(2);
  }


  public function cambiarEstadoCredito($estado){
    $sql = "CALL 	SP_Cambiar_Estado_Credito2(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->codigo_venta);
    $stm->bindParam(2, $estado);
    return $stm->execute();
  }


  public function cambiarEstadoCredito2($estado, $codigo){
    $sql = "CALL SP_Cambiar_Estado_Credito(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $estado);
    $stm->bindParam(2, $codigo);
    return $stm->execute();
  }


  public function getNombreCliente($idCliente)
  {
    $sql = "CALL SP_getNombreCliente(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $idCliente);
    $stm->execute();
    return $stm->fetch(2);
  }


  public function insertarAbonoCreditoVen(){
    $sql = "CALL SP_Insertar_Abono_CreditoVen	(?,?,?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->valorAbonarCreditoV);
    $stm->bindParam(2, $this->codigo_venta);
    $stm->bindParam(3, $this->codigoEmpleado);
    $resultado = $stm->execute();
    return $resultado;
  }



  public function listarAbonosCreditosV($id_ventas)
  {
      $sql = "CALL SP_listarAbonosCreditosV(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $id_ventas);
      $stm->execute();
      return $stm->fetchAll(2);
  }


  public function cambiarestadoAbonos($codigo)
  {
    $sql ="CALL SP_anularAbonoCreditos(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigo);
    return $stm->execute();
  }

  public function getAbonos($idVenta){
    $sql = "CALL SP_get_Abonos(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $idVenta);
    $stm->execute();
    return $stm->fetch(2);
  }

    public function listarNotificacionesCredito(){
      $sql = "CALL SP_Notificacion_Creditos()";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function ultimoId(){
        $sql = "CALL SP_Ultimo_id()";
        $stm = $this->db->prepare($sql);
        $stm ->execute();
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

}

?>
