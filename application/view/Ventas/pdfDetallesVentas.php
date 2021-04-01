<html>
<head>
<style media="screen">
  table{
    width: 100%;
  }
</style>
  <link href="<?php echo URL?>css/Estilos.css" rel="stylesheet">
  <link href="<?php echo URL?>css/bootstrap.min.css" rel="stylesheet">
  <title>Recibo de caja</title>
</head>
<body>
  <?php if($value['estado'] == 0): ?>
    <h4>Esta venta fue anulada</h4>
  <?php else: ?>
  <?php endif; ?>
  <h2 style="text-align: center">BIOARTES</h2>
  <div id="reciboVenta">
    <p>Nit: </p>
    <p>Centro Comercial Cisneros</p>
    <p>Teléfono: 513-10-12</p>
    <p>Cra. 51 N° 44 – 69, Local 144 B - Medellín</p>
  </div>
  Recibo de caja número: <strong><?= $info['id_ventas'] ?></strong><br>
  Fecha: <?= $info['fecha_venta'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?= date("H:i:s"); ?>
  <br><br>
  Atendido por: <strong><?= ucwords($info['empleado']);?></strong><br>
  Cliente: <strong><?= ucwords($info['cliente']) ?></strong><br>
  Tipo Documento: <strong><?= ucwords($info['tipo_documento']) ?></strong><br>
  Identificación: <strong><?= $info['id_persona'] ?></strong><br>
  <br>
  -----------------------------------------------------------------------------------------<br>
  -----------------------------------------------------------------------------------------<br><br>
  <center><legend><h3>DETALLES VENTA</h3></legend></center>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Código</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?= $tabla ?>
    </tbody>
  </table>
  <br><br>

  -----------------------------------------------------------------------------------------<br>
  -----------------------------------------------------------------------------------------<br><br>
    <p>Tipo de pago: <strong><?= $info['tipo_de_pago'] == 1? "Crédito" : "Contado";  ?></strong></p>
    <p>Descuento: $ <strong><?= number_format($info['descuento'], "0", ".", "."); ?></p>
    <p>Valor total a pagar: $ <strong><?= number_format($info['total'], "0", ".", "."); ?></p>
    <br><br><br><br>
    <p style="text-align: center"><strong>Gracias por su compra</strong></p>
    <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
