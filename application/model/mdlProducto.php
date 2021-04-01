<?php


class mdlProducto
{
  private $codigo;
  private $nombre;
  private $precio;
  private $cantidad;
  private $id_producto;
  private $nombre_producto;
  private $Tbl_Categoria_idcategoria;
  private $Talla;
  private $Tamano;
  private $precio_unitario;
  private $precio_detal;
  private $precio_por_mayor;
  private $id_categoria;
  private $stock;
  private $id_baja;
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

 public function listarpdf()
  {
    $sql="CALL  SP_Informe_existencia(?,?)";
    try {
     $ca= $this->db->prepare($sql);
     $ca->bindParam(1,$this->fechainicial);
     $ca->bindParam(2,$this->fechafinal);
    $ca->execute();
     return $ca->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {

    }

  }



  public function validarNombreCategoria(){
    $sql = "CALL 	SP_Validar_Nombre_Categoria(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->id_categoria);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function validarNombreCategoria2(){
    $sql = "CALL 	SP_Validar_Nombre_Categoria2(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombre);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function validarCodigo(){
    $sql = "CALL 	SP_Validar_Codigo(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->id_producto);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
}


  public function validarNombre(){
    $sql = "CALL 	SP_Validar_Nombre_Producto(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombre_producto);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function validarNombre2(){
    $sql = "CALL 	SP_Validar_Nombre_Producto2(?, ?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->nombre_producto);
    $stm->bindParam(2, $this->nombre);
    $stm->bindParam(3, $this->Talla);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }



  public function listarpdfp(){
     $sql="CALL  SP_Listar_informe()";
    try {
      $ca=$this->db->prepare($sql);
      $ca->execute();
      return $ca->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {

    }
  }


public function validarCantidad(){
  $sql = "CALL SP_Validar_Cantidad_Producto(?)";
  $stm = $this->db->prepare($sql);
  $stm->bindParam(1, $this->id_producto);
  //$stm->bindParam(2, $this->cantidad);
  $stm->execute();
  return $stm->fetch(PDO::FETCH_ASSOC);
}



  public function Guardar(){
    $sql= "CALL SP_Registrar_producto(?,?,?,?,?,?,?)";

   try {

     $ca=  $this->db->prepare($sql);
     $ca->bindParam(1,$this->nombre_producto);
     $ca->bindParam(2,$this->precio_detal);
     $ca->bindParam(3,$this->precio_por_mayor);
     $ca->bindParam(4,$this->precio_unitario);
     $ca->bindParam(5,$this->Tbl_Categoria_idcategoria);
     $ca->bindParam(6,$this->Tamano);
     $ca->bindParam(7,$this->stock);
      return $ca->execute();
    } catch (PDOException $ex) {
           echo  $ex->getMessage();
       }

  }

  public function Guardarca(){
  $sql=" CALL SP_Registrar_Categoria(?)";
  try {
    $ca=$this->db->prepare($sql);
   $ca->bindParam(1,$this->nombre);
    return $ca->execute();

  } catch (Exception $e) {

  }

}

  public function listar(){
  $sql="CALL SP_listar_producto()";
  try {
   $ca= $this->db->prepare($sql);
  $ca->execute();
   return $ca->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {

  }

  }

   public function actualizarProducto(){
  $sql="CALL SP_Modificar_producto(?,?,?,?,?,?,?,?) ";
  try {
    $ca = $this->db->prepare($sql);
    $ca->bindParam(1,$this->id_producto);
    $ca->bindParam(2,$this->nombre_producto);
    $ca->bindParam(3,$this->precio_detal);
    $ca->bindParam(4,$this->precio_por_mayor);
    $ca->bindParam(5,$this->precio_unitario);
    $ca->bindParam(6,$this->Tbl_Categoria_idcategoria);
    $ca->bindParam(7,$this->Tamano);
    $ca->bindParam(8,$this->stock);
     return $ca->execute();
  } catch (Exception $e) {

  }
  }


  public function traerPorReferencia($id){
    $sql="CALL SP_Traer_idproducto(?)";
    try {
      $ca= $this->db->prepare($sql);
      $ca->bindParam(1, $id);
      $ca->execute();
        return $ca->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {

    }
  }

  public function traerporcodigo($id){
    $sql="CALL SP_Traer_idcategoria(?)";
    try {
      $ca=$this->db->prepare($sql);
      $ca->bindParam(1,$id);
      $ca->execute();
      return $ca->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {

    }
  }

  public function listarca(){
    $sql="CALL SP_Listar_categoria()";

    try {
      $ca=$this->db->prepare($sql);
      $ca->execute();
      return $ca->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {

    }

   }


     public function listarstock(){
       $sql="CALL SP_Listar_stockMinimo()";

       try {
         $ca=$this->db->prepare($sql);
         $ca->execute();
         return $ca->fetchAll(PDO::FETCH_ASSOC);
       } catch (Exception $e) {

       }

      }


      public function consultarConfiguracionVentas(){
        $sql="CALL SP_Consultar_Configuracion";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
      }



  public function Modificar(){
    $sql="CALL SP_Modificar_producto(?,?,?,?,?,?,?,?) ";
    try {
      $ca = $this->db->prepare($sql);
      $ca->bindParam(1,$this->id_producto);
      $ca->bindParam(2,$this->nombre_producto);
      $ca->bindParam(3,$this->precio_detal);
      $ca->bindParam(4,$this->precio_por_mayor);
      $ca->bindParam(5,$this->precio_compra);
      $ca->bindParam(6,$this->Tbl_Categoria_idcategoria);
      $ca->bindParam(7,$this->Talla);
      $ca->bindParam(8,$this->Tamano);
      $ca->bindParam(9,$this->stock_minimo);
       return $ca->execute();
    } catch (Exception $e) {

    }

  }



    public function ModificarCategoria(){
    $sql="CALL SP_Modificar_categoria(?,?)";
    try {
      $ca = $this->db->prepare($sql);
      $ca->bindParam(1,$this->id_categoria);
      $ca->bindParam(2,$this->nombre);
      return $ca->execute();
    } catch (Exception $e) {

    }

  }



  public function ModificarEstado($id){
    $sql="CALL SP_Cambiar_Estado(?) ";
    try {
      $ca = $this->db->prepare($sql);
      $ca->bindParam(1,$id);
       return $ca->execute();
    } catch (Exception $e) {

    }
  }



  public function getDetallesProducto($idproducto){
    $sql = "CALL SP_Detallesproducto(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $idproducto);
    $stm->execute();
    return $stm->fetchAll(2);
  }


  public function getDetallesBajas($idBaja){
      $sql = "CALL SP_Detalles_Bajas(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $idBaja);
      $stm->execute();
      return $stm->fetchAll(2);
    }


    public function getInfoProducto($idproducto){
      $sql = "CALL SP_Info_Producto(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $idproducto);
      $stm->execute();
      return $stm->fetch();
    }


  public function getInfoBaja($codigo){
    $sql = "CALL SP_Info_Baja(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $codigo);
    $stm->execute();
    return $stm->fetch(2);
  }


  public function validarModNombre(){
    $sql = "CALL SP_Validar_Modificacion_Nombre_Producto(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->id_producto);
    $stm->bindParam(2, $this->nombre_producto);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function validarModCategoria(){
    $sql = "CALL SP_Validar_Modificacion_Nombre_Categoria(?, ?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->id_categoria);
    $stm->bindParam(2, $this->nombre);
    $stm->execute();
    return $stm->fetch(PDO::FETCH_ASSOC);
  }


  public function consultarProductos(){
    $sql = "CALL SP_Consultar_Nombre_Productos()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


  public function consultarCategorias(){
    $sql = "CALL SP_Consultar_Nombres_Categorias()";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


  public function ModNombreProd(){
    $sql = "CALL SP_Validar_Nombre_Productos(?)";
    $stm = $this->db->prepare($sql);
    $stm->bindParam(1, $this->id_producto);
    $stm->execute();
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }


    public function ModNombreCateg(){
      $sql = "CALL SP_Validar_Nombres_Categorias(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->id_categoria);
      $stm->execute();
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }


    public function ultimoId(){
        return $this->db->lastInsertId();
    }

    public function ultimoIdProducto(){
      $sql = "CALL SP_Traer_Ultimo_producto()";
      $stm = $this->db->prepare($sql);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
    }


    public function IdProdModificado(){
      $sql = "CALL SP_Traer_Producto_Modificado(?)";
      $stm = $this->db->prepare($sql);
      $stm->bindParam(1, $this->id_producto);
      $stm->execute();
      return $stm->fetch(PDO::FETCH_ASSOC);
    }

}

 ?>
