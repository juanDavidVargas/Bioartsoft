
  <div class="row">
    <br>
        <button type="button" class="btn btn-primary btn-circle btn-md pull-right" data-toggle="modal" data-target="#mod_ayuda_aterrizaje">
          <i class="fa fa-question" aria-hidden="true" title="Ayuda"></i>
        </button>
        <center>
        <div class="col-lg-12">
            <h1 class="page-header" style="font-family: fantasy; text-align:center; color: #337BA7">BIOARTSOFT</h1>
        </div>
      </center>
    </div>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 col-md-3 col-lg-3">
                          <?php foreach ($ventasDia AS $valor): ?>
                              <i class="fa fa-usd fa-4x">&nbsp;<span><?= number_format($valor, "0", ".", ".") ?></span></i>
                              <p>Ventas Día</p>
                          <?php endforeach; ?>
                        </div>
                        <div class="col-xs-9 text-right">
                          <?php foreach ($ventasMes as $ventasMes): ?>
                              <div class="huge"></div>
                              <p>Ventas Mes</p>
                              <?php $pesos = "$"; ?>
                              <span class="ventas"><?= $pesos ?><?= $ventasMes ?></span>
                          <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="panel panel" style="background-color: #3CB371">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 col-md-3 col-lg-3">
                          <?php foreach ($creditos as $value): ?>

                            <i class="fa fa-credit-card fa-4x" style="color: #fff">&nbsp;<?= $value?></i>
                            <p>&nbsp;</p>
                          <?php endforeach; ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <p style="color: #fff">Créditos</p>
                              <?php foreach ($creditos as $value): ?>
                                <span style="color: #fff"><?= $value?></span>
                              <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                    </div>
                </a>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="panel panel" style="background-color: #3CB371">
                <div class="panel-heading">
                    <div class="row">
                          <div class="col-xs-12 col-md-3 col-lg-3">
                            <?php foreach ($comprasDia as $compras): ?>
                                <i class="fa fa-shopping-cart fa-4x" style="color: #fff">&nbsp;<span><?= number_format($compras, "0", ".", ".") ?></span></i>
                                <p style="color: #fff">Entradas Día</p>
                              <?php endforeach; ?>
                          </div>
                          <div class="col-xs-9 text-right">
                            <?php foreach ($comprasMes as $CompraMes): ?>
                                <div class="huge"></div>
                                <p style="color: #fff">Entradas Mes</p>
                                <span class="compras" style="color: #fff"><?= $pesos ?><?= $CompraMes ?></span>
                            <?php endforeach; ?>
                          </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12 col-md-3 col-lg-3">
                          <?php foreach ($prestamos as $val): ?>
                              <i class="fa fa-money fa-4x">&nbsp;<?= $val?></i>
                              <p>&nbsp;</p>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <p>Préstamos</p>
                            <?php foreach ($prestamos as $val): ?>
                              <?= $val?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                    </div>
                </a>
            </div>
        </div>
    </div>
  <!-- </div> -->

  <div class="modal fade" id="mod_ayuda_aterrizaje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static">
                    <div class="modal-dialog" role="document" style="width: 50%">
                      <div class="modal-content">
                        <div class="modal-body">
                   <div class="row">
                     <div class="col-xs-12 col-md-6 col-lg-12">
                       <div class="panel panel-primary">
                         <div class="panel-heading" stlyle="height: 70px; width: 100px">
                               <center><span class="modal-title" id="myModalLabel" style="color: #FFF; font-size: 18px"><strong>Página de Aterrizaje</strong></span></center>
                         </div>
                         <div class="panel-body">
                             <p>En esta página se pueden observar paneles de diferente color, varios de color verde y varios de color
                               azul.</p>
                             <ul>
                               <li>En el primero de ellos podemos observar el total de ventas del día y el total de ventas del mes.</li>
                               <li>En el segundo a su derecha podemos observar el total de créditos en estado pendiente o sin cancelar.</li>
                               <li>En el tercer panel, a la izquierda debajo del panel de color azul, se puede observar el total
                               de compras del día y el total de compras del mes.</li>
                               <li>En el último panel, se puede observar el total de préstamos en estado pendiente o sin cancelar.</li>
                             </ul>
                             <p>Todos los datos allí contenidos sirven unicamente de información, no se pueden modificar,
                             alterar, ni borrar sin realizar el debido proceso que conlleva cada uno de ellos.</p>
                         </div>
                         <br>
                       </div>
                     </div>
                   </div>
          <div class="row">
            <div class="col-md-6 col-xs-12 col-lg-12">
               <button type="button" class="btn btn-primary btn-md active pull-right"  data-dismiss="modal"><i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i></button>
             </div>
        </div>
    </div>
  </div>
</div>
</div>

  <script type="text/javascript">
    $(document).ready(function(){
      $(".ventas").priceFormat({centsLimit: 3, prefix: '$ '});
      $(".compras").priceFormat({centsLimit: 3, prefix: '$ '});
    });
  </script>
