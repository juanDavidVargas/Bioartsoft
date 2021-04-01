<div class="row">
  <br><br>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading" stlyle="height: 70px; width: 100px">
                <center><span style="text-align:center; color: #fff; margin-top:10px; margin-bottom: 10px; font-size: 18px"><strong>Productos en Stock Mínimo</strong></span></center>
            </div>
      <div class="panel-body">
        <div class="dataTable_wrapper">
          <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
     <tr>
       <th>Código</th>
       <th>Nombre Producto</th>
       <th>Categoría</th>
       <th>Descripción</th>
       <th>Cantidad </th>
      <th>Stock Mínimo</th>
     </tr>
   </thead>

   <tbody>
     <?php foreach ($stock as $val) :  ?>
     <tr>
       <td><?= $val["id_producto"]  ?></td>
       <td><?= $val["nombre_producto"]?></td>
       <td><?= $val["nombre"] ?></td>
       <td><?= $val["tamano"] ?></td>
      <td><?= $val["cantidad"] ?></td>
      <td><?= $val["stock_minimo"] ?></td>
 </tr>

  <?php endforeach ?>

 </tbody>
  </table>
</div>
<?php if($_SESSION['ROL'] == 1 || $_SESSION['ROL'] == 3): ?>
<?php if(count($stock) > 0): ?>
  <div class="col-sm-12">
      <center>
      <a href="<?= URL ?>producto/informestock" target="_blank">
        <button class="btn btn-primary"><i class="fa fa-file-pdf-o" aria-hidden="true">   Reporte PDF de Stock Mínimo</i></button>
      </a>
    </center>
    </div>
<?php endif; ?>
<?php endif; ?>
</form>
</div>
</div>
</div>
</div>
</div>
