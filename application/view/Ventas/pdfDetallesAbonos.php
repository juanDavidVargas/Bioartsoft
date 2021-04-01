<html>
<head>
<style media="screen">
  table{
    width: 100%;
  }
</style>
  <link href="<?php echo URL?>css/Estilos.css" rel="stylesheet">
  <link href="<?php echo URL?>css/bootstrap.min.css" rel="stylesheet">
  <title>Recibo de abono Crédito</title>
</head>
<body>
  <h2 style="text-align: center">BIOARTES</h2>
  <div id="reciboAbonoCredito">
    <p>Nit: </p>
    <p>Centro Comercial Cisneros</p>
    <p>Teléfono: 513-10-12</p>
    <p>Cra. 51 N° 44 – 69, Local 144 B - Medellín</p>
  </div>
  Recibo de abono número: <strong><?= $val['idabono'] ?></strong><br>
  Fecha: <?= $val['fechaAbono'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?= date("H:i:s"); ?>
  <br><br>
  Atendido por: <strong><?= ucwords($_SESSION['USUARIO'])." ".ucwords($_SESSION['USUARIO-APE']) ?></strong><br>
  Cliente: <strong><?= ucwords($val['cliente']) ?></strong><br>
  Tipo de Documento: <strong><?= ucwords($val['tipo_documento']) ?></strong><br>
  Identificación: <strong><?= $val['id_persona'] ?></strong><br>
  <br>
  --------------------------------------------------------------------<br>
  --------------------------------------------------------------------<br><br>
  <center><legend><h3>RECIBO DE ABONO</h3></legend></center>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Total Crédito</th>
        <th>Valor Abono</th>
        <th>Total Abonado</th>
        <th>Pendiente</th>
      </tr>
    </thead>
    <tbody>
      <?= $tabla2 ?>
    </tbody>
  </table>
  <br><br>
  --------------------------------------------------------------------<br>
  --------------------------------------------------------------------<br><br>
  <p>Recuerde cancelar antes del: <?= $val['fecha_limite_credito'] ?></p>
  <br><br>
  <p style="text-align: center"><strong>Gracias por su visita</strong></p>
  <script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
