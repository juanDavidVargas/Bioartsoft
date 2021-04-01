$(function() {

    // just a super-simple JS demo

    var demoHeaderBox;

    // simple demo to show create something via javascript on the page
    if ($('#javascript-header-demo-box').length !== 0) {
    	demoHeaderBox = $('#javascript-header-demo-box');
    	demoHeaderBox
    		.hide()
    		.text('Hello from JavaScript! This line has been added by public/js/application.js')
    		.css('color', 'green')
    		.fadeIn('slow');
    }

    // if #javascript-ajax-button exists
    if ($('#javascript-ajax-button').length !== 0) {

        $('#javascript-ajax-button').on('click', function(){

            // send an ajax-request to this URL: current-server.com/songs/ajaxGetStats
            // "url" is defined in views/_templates/footer.php
            $.ajax(url + "/songs/ajaxGetStats")
                .done(function(result) {
                    // this will be executed if the ajax-call was successful
                    // here we get the feedback from the ajax-call (result) and show it in #javascript-ajax-result-box
                    $('#javascript-ajax-result-box').html(result);
                })
                .fail(function() {
                    // this will be executed if the ajax-call had failed
                })
                .always(function() {
                    // this will ALWAYS be executed, regardless if the ajax-call was success or not
                });
        });
    }

});

function Traerdatosdelproducto(id_producto){
  $.ajax({
    type:"POST",
    url:url+"producto/obtenerProductos",
    data: {
        id: id_producto,
    },
     success: function(respuesta){

       $("#txtcodigo").val("");
        $("#txtnombreproducto").val("");
        $("#txtprecioventa").val("");
        $("#txtprecioalpormayor").val("");
        $("#txtpreciocompra").val("");
        $("#txtcategoria1").val("");
        $("#txttamano").val("");
        $("#txtstock").val("");
        if($("#txtcate1").data("select2") !== undefined){
        $("#txtcategoria1").select2("destroy");
        }
        $("#txtcodigo").val(respuesta.id_producto);
        $("#txtcodigo-txt").val(respuesta.id_producto);
        $("#txtnombreproducto").val(respuesta.nombre_producto);
        $("#txtprecioventa").val(respuesta.precio_detal);
        $("#txtprecioalpormayor").val(respuesta.precio_por_mayor);
        $("#txtpreciocompra").val(respuesta.precio_unitario);
        $("#txtcategoria1").val(respuesta.Tbl_Categoria_idcategoria);

        if(respuesta.Tbl_Categoria_idcategoria ==  1){
          $("#txttalla").val(respuesta.talla).show();
          $("#txttamano-input").val(respuesta.tamano).show();
          $("#lbltamanio").show();
        } else {
            $("#txttamano-input").val(respuesta.tamano).show();
            $("#lbltamanio").show();
        }

        $("#txtstock").val(respuesta.stock_minimo);
        $("#txtcategoria1").select2({width: "100%"});
       $("#actualizar-producto").modal('show');

     },
   });
}

$(function(){
  $("#txtcategoria").change(function(){
    var valor = parseInt($(this).val());
    if(valor === 1 ){
      var contenedorOcultar = $("#txttamano");
      var contenedorMostrar = $("#div-talla");
      contenedorMostrar.find('label').show();
      contenedorMostrar.find('input').show();
      contenedorMostrar.find('select').show();
      contenedorOcultar.find('input').show();
      contenedorOcultar.find('label').show();

      contenedorOcultar.slideUp(function(){
      contenedorMostrar.slideDown();
      });
    } else {
      var contenedorOcultar = $("#div-talla");
      var contenedorMostrar = $("#txttamano");
      contenedorMostrar.find('input').show();
      contenedorMostrar.find('label').show();
      contenedorOcultar.find('input').show();
      contenedorOcultar.find('select').show();
      contenedorOcultar.find('label').show();
      contenedorOcultar.slideUp(function(){
      contenedorMostrar.slideDown();
      });
    }
  });
});

function Traerdatoscategoria(id_categoria){
    $.ajax({
  type:"POST",
  url:url+"producto/obtenercategoria",
  data:{
    id:id_categoria,
  },
  success:function(respuesta){

    $("#txtnombreca").val("");
    $("#txtcodigo").val("");

    $("#txtnombreca").val(respuesta.nombre);
    $("#txtcodigo").val(respuesta.id_categoria);
    $("#txtcodigo-show").val(respuesta.id_categoria);
    $("#myForm").modal('show');

  },
    });
}

function preciosProducto(){
  var id = $("#ddlproducto").val();
    $.ajax({
      type: 'POST',
      url: url + 'producto/obtenerProductos2',
      dataType: 'json',
      data: {id: id},
    })
      .done(function(respuesta){
        var ids = respuesta.id;
        var precio1 = respuesta.precio1;
        var precio2 = respuesta.precio2;
        var precio3 = respuesta.precio3;
        if (respuesta.id != null) {
          $("#txtcodigo").val(ids);
          $("#txtpreciocompra").val(precio1);
          $("#txtprecioventa").val(precio2);
          $("#txtprecioalpormayor").val(precio3);
        }
      })

}
