@php
  $user = Auth::user();
 // dd($user);
@endphp
 
@extends('voyager::master')

@section('page_title', __('').' '.__('Charcuteria'))

@section('css')
    <style>
        .panel-actions .voyager-trash {
            cursor: pointer;
        }
        .panel-actions .voyager-trash:hover {
            color: #e94542;
        }
        .settings .panel-actions{
            right:0px;
        }
        .panel hr {
            margin-bottom: 10px;
        }
        .panel {
            padding-bottom: 15px;
        }
        .sort-icons {
            font-size: 21px;
            color: #ccc;
            position: relative;
            cursor: pointer;
        }
        .sort-icons:hover {
            color: #37474F;
        }
        .voyager-sort-desc {
            margin-right: 10px;
        }
        .voyager-sort-asc {
            top: 10px;
        }
        .page-title {
            margin-bottom: 0;
        }
        .panel-title code {
            border-radius: 30px;
            padding: 5px 10px;
            font-size: 11px;
            border: 0;
            position: relative;
            top: -2px;
        }
        .modal-open .settings  .select2-container {
            z-index: 9!important;
            width: 100%!important;
        }
        .new-setting {
            text-align: center;
            width: 100%;
            margin-top: 20px;
        }
        .new-setting .panel-title {
            margin: 0 auto;
            display: inline-block;
            color: #999fac;
            font-weight: lighter;
            font-size: 13px;
            background: #fff;
            width: auto;
            height: auto;
            position: relative;
            padding-right: 15px;
        }
        .settings .panel-title{
            padding-left:0px;
            padding-right:0px;
        }
        .new-setting hr {
            margin-bottom: 0;
            position: absolute;
            top: 7px;
            width: 96%;
            margin-left: 2%;
        }
        .new-setting .panel-title i {
            position: relative;
            top: 2px;
        }
        .new-settings-options {
            display: none;
            padding-bottom: 10px;
        }
        .new-settings-options label {
            margin-top: 13px;
        }
        .new-settings-options .alert {
            margin-bottom: 0;
        }
        #toggle_options {
            clear: both;
            float: right;
            font-size: 12px;
            position: relative;
            margin-top: 15px;
            margin-right: 5px;
            margin-bottom: 10px;
            cursor: pointer;
            z-index: 9;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .new-setting-btn {
            margin-right: 15px;
            position: relative;
            margin-bottom: 0;
            top: 5px;
        }
        .new-setting-btn i {
            position: relative;
            top: 2px;
        }
        textarea {
            min-height: 120px;
        }
        textarea.hidden{
            display:none;
        }

        .voyager .settings .nav-tabs{
            background:none;
            border-bottom:0px;
        }

        .voyager .settings .nav-tabs .active a{
            border:0px;
        }

        .select2{
            width:100% !important;
            border: 1px solid #f1f1f1;
            border-radius: 3px;
        }

        .voyager .settings input[type=file]{
            width:100%;
        }

        .settings .select2{
            margin-left:10px;
        }

        .settings .select2-selection{
            height: 32px;
            padding: 2px;
        }

        .voyager .settings .nav-tabs > li{
            margin-bottom:-1px !important;
        }

        .voyager .settings .nav-tabs a{
            text-align: center;
            background: #f8f8f8;
            border: 1px solid #f1f1f1;
            position: relative;
            top: -1px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .voyager .settings .nav-tabs a i{
            display: block;
            font-size: 22px;
        }

        .tab-content{
            background:#ffffff;
            border: 1px solid transparent;
        }

        .tab-content>div{
            padding:10px;
        }

        .settings .no-padding-left-right{
            padding-left:0px;
            padding-right:0px;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover{
            background:#fff !important;
            color:#62a8ea !important;
            border-bottom:1px solid #fff !important;
            top:-1px !important;
        }

        .nav-tabs > li a{
            transition:all 0.3s ease;
        }


        .nav-tabs > li.active > a:focus{
            top:0px !important;
        }

        .voyager .settings .nav-tabs > li > a:hover{
            background-color:#fff !important;
        }
    </style>

    <style>
        * {box-sizing: border-box}

        .containers {
        width: 100%;
        background-color: #ddd;
        }

        .skills {
        text-align: right;
        color: white;
        }

        .html {width: 0%; background-color: #4CAF50;}
        .css {width: 80%; background-color: #2196F3;}
        .js {width: 65%; background-color: #f44336;}
        .php {width: 60%; background-color: #808080;}
    </style>
@stop


<!-- Bootstrap CSS File -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

@section('page_header')
 <div class="container-fluid" style="display: flex;justify-content: flex-start!important;">
        @include('voyager::alerts')


        <div  id="add_alert" class="alert alert-success" role="alert" style="display: none;width: 289px !important;">
            <strong>{{ __('Successfully Saved Products') }}</strong>
        </div>


    </div>

    <h1 style="margin-top: 2px; margin-bottom: 0px;">

       <div class="row">


                    <div class="col-md-1">

                    </div>
                    <div class="col-xs-5">
                        <i class="voyager-basket"></i> {{ __('Charcuteria') }}
                        <div id="loader" class="text-center">                       
                           <button type="button" action="{{ route('carrito.index')}}"  class="btn btn-primary">Carrito</button>
                        </div>

                    </div>                 
                </div>

    </h1>
    <!-- Bootstrap Modal  -->

<!--///////////////////////////////// agregar producto al carrito//////////////////////////////--->



<div class="modal fade" id="ViewProductsReserva" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-right: 15px;
padding-left: 15px;">
<div class="modal-dialog" role="document">
<div class="modal-content" style="width:746px;">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Agregar Al Pedido</h4>
</div>
<div class="modal-body">


    <div class="col-md-3">
        <div class="box box-primary" style="display: flex;justify-content: center;padding-right: 0px;padding-top: 0px;padding-bottom: 0px;padding-left: 0px;">

                                  <div class="box-body box-profile">                                      
                                     <img   src="http://distribucionesdp.test/img/product/product.png"  class="form-control img-responsive" name="image" id="image"  style="height: 251px;">


                                  </div>
                              </div>
    </div>


          <div class="col-md-9" style="padding-right: 0px;    padding-left: 0px;">
            <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; width: 100%; ">
                <div class="content" style="margin-top: 0px;margin-left: 10px;margin-right: 10px;margin-bottom: 20px;">
                  <div class="box" style=" padding-right: 0px; padding-left: 0px;    padding-top: 0px; padding-bottom: 0px;
">
                    <div></div>
                    <div class="box-body" >


                            <form name="update_register" class="form-horizontal" id="update_register" enctype="multipart/form-data" method="post">


                                <div class="nav-tabs-custom" style="height: 45%;">
                                    <ul class="nav nav-tabs">
                                    <li class="active"><a aria-expanded="false" href="#details" data-toggle="tab"></a></li>


                                    </ul>
                                    <div class="tab-content" style="height: 88%;">
                                    <div id="resultados_ajax">  </div>

                                   
                                    <div class="tab-pane active" id="details" style="margin-right: 2%;">

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_c_codigo">Codigo</label>

                                            <div class="col-sm-3">
                                              <input name="c_codigo" readonly=”readonly” class="form-control"  id="c_codigo" type="text">
                                            </div>
                                        </div> 
                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="c_descri">Descripcion</label>

                                            <div class="col-sm-8">
                                              <input name="c_descri" readonly=”readonly” class="form-control" id="c_descri" type="text" >
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                          <label class="col-sm-2 control-label" for="product_peso">Peso</label>
                                           <div class="col-sm-4">                                             
                                             <select class="form-control select2 select2-hidden-accessible" id="peso" name="peso" tabindex="-1" aria-hidden="true">
                                                    <option value="500 grs">500 grs</option>
                                                    <option value="1 Kilo">1 Kilo</option>                                                    
                                                </select>
                                            </div>

                                            <label class="col-sm-2 control-label" for="product_cantidad">Cantidad</label>
                                            <div class="col-sm-4">
                                             <select class="form-control select2 select2-hidden-accessible" id="cantidad" name="cantidad" tabindex="-1" aria-hidden="true">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>                                                    
                                                </select>
                                            </div>
                                        </div>                                           

                                    </div>

                                    
                                    <!-- /.tab-pane -->

                                    </div>


                                    <!-- /.tab-content -->
                                </div>
                                <!-- /.nav-tabs-custom -->


                             </form>


                    </div>
                  </div>
                </div>

            </div>
           </div>

</div>

<div class="modal-footer">
<a type="submit" href="javascript:agregarCarrito();"  class="btn btn-success">Agregar</a>
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>


</div>
</div>
</div>
 

<!--///////////////////////////////// --->


<!--///////////////////////////////// ver Produtos//////////////////////////////--->



<div class="modal fade" id="ViewProducts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-right: 15px;
padding-left: 15px;">
<div class="modal-dialog" role="document" style=" width: 100%;">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">View Products</h4>
</div>
<div class="modal-body">


    <div class="col-md-3">
        <div class="box box-primary" style="display: flex;justify-content: center;padding-right: 0px;padding-top: 0px;padding-bottom: 0px;padding-left: 0px;">

                                  <div class="box-body box-profile">
                                      
                                     <img   src="http://distribucionesdp.test/img/product/product.png"  class="form-control img-responsive" name="image" id="image"  style="height: 251px;">


                                  </div>
                              </div>
    </div>


          <div class="col-md-9" style="padding-right: 0px;    padding-left: 0px;">
            <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; width: 100%; ">
                <div class="content" style="margin-top: 0px;margin-left: 10px;margin-right: 10px;margin-bottom: 20px;">
                  <div class="box" style=" padding-right: 0px; padding-left: 0px;    padding-top: 0px; padding-bottom: 0px;
">
                    <div></div>
                    <div class="box-body" >


                            <form name="update_register" class="form-horizontal" id="update_register" enctype="multipart/form-data" method="post">


                                <div class="nav-tabs-custom" style="height: 85%;">
                                    <ul class="nav nav-tabs">
                                    <li class="active"><a aria-expanded="false" href="#details" data-toggle="tab">Detalles del Producto</a></li>


                                    </ul>
                                    <div class="tab-content" style="height: 348px;">
                                    <div id="resultados_ajax">  </div>



                                    <div class="tab-pane active" id="details" style="margin-right: 2%;">

                                      <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_c_codigo">Codigo</label>

                                            <div class="col-sm-4">
                                              <input name="c_codigo" readonly=”readonly”  id="c_codigo" type="text" class="form-control">
                                            </div>
                                            <label class="col-sm-2 control-label" for="c_descri">Descripcion</label>

                                            <div class="col-sm-4">
                                              <input name="c_descri" readonly=”readonly” class="form-control" id="c_descri" type="text" >
                                            </div>
                                        </div>    

                                    </div>
                                    <!-- /.tab-pane -->

                                    </div>


                                    <!-- /.tab-content -->
                                </div>
                                <!-- /.nav-tabs-custom -->


                             </form>


                    </div>
                  </div>
                </div>

            </div>
           </div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>


</div>
</div>
</div>

<!--///////////////////////////////// --->

@stop

@section('content')

     <!-- Main content -->
        <section class="content-product">
            <div id="resultados_ajax"></div>
                <div class="outer_div" style="width:100%;">

                        @include('products.product')

                </div><!-- Datos ajax Final -->
       </section><!-- /.content -->


@stop

@section('javascript')
<!-- data data tables Search -->
<!--  -->
<script>
    function  SearchItens(){
           var parametros = $("#searchDinamic").serialize();
          var id = $("#value_id").val();
         //  alert(parametros);
         //  alert('id='+id);

           var parametrosArray= $("#searchDinamic").serializeArray();
     //       alert('parametrosArray='+parametrosArray);
            var jsonParametros = JSON.stringify($("#searchDinamic").serializeArray());
        //   alert('jsonParametros='+jsonParametros);

            $.ajax({
                type: "POST",
                url: "/Products/Search",
                data: {jsonParametros:jsonParametros,id:id},
                beforeSend: function(objeto){

                    },
                success: function(datos){
                    //alert('exitosa');
                  //  table.ajax.reload();

                setTimeout(function(){
                            swal({ title:'Success!',text:"Successful product search",type:'success'});

                        },1000);
                },
                error:function(datos){
                    setTimeout(function(){
                            swal({ title:'Cancelled',text:"Product Search not found",type:'error'});

                        },1000);
                }
            });
            event.preventDefault();

       }
   </script>

<!-- data data tables -->
<script type="text/javascript">
    function llenar(response, index, value)
    {
        $('#example1').DataTable({
            "destroy": true,
            "data": response,
            "columns":[
                {"data":"response.nombre"},
                {"data":"response.codigo"},
                {"data":"response.codigo"},
                {"data":"response.codigo"},
                {"data":"response.codigo"},
                {"data":"response.codigo"},
                {"data":"response.codigo"},
                {"data":"response.codigo"},
                {"data":"response.codigo"},
                {"data":"response.codigo"},
                {"data":"response.codigo"}
            ]
        });
    }
</script>

   <!-- DataTables -->
    <script>
            $(document).ready( function () {
                ///

                $('#datatable').DataTable({
                
              });
                /////
              $('#dataTabless').DataTable({
                scrollY:        200,
                deferRender:    true,
                "scrollX": true,
                scroller:       true
                ////add button



              });

                $('#toggle_options').click(function () {
                $('.new-templates-options').toggle();
                if ($('#toggle_options .voyager-double-down').length) {
                    $('#toggle_options .voyager-double-down').removeClass('voyager-double-down').addClass('voyager-double-up');
                } else {
                    $('#toggle_options .voyager-double-up').removeClass('voyager-double-up').addClass('voyager-double-down');
                }
            });
            } );
    </script>



   


  <script type="text/javascript">

      $('div.panel-body').on("shown.bs.dropdown", ".dropdown", function() {

  var desplegable = $(this).children('ul.dropdown-menu');
  var boton = $(this).children(".dropdown-toggle");

  var separaciondesplegable = desplegable.offset();

  var espacioArriba = (separaciondesplegable.top - boton.height() - desplegable.height()) - $(window).scrollTop();

  var espacioAbajo = $(window).scrollTop() + $(window).height() - (separaciondesplegable.top + desplegable.height());

  if (espacioAbajo < 100 && (espacioArriba >= 0 || espacioArriba > espacioAbajo)){

      $(this).addClass("dropup");

  }

}).on("hidden.bs.dropdown", ".dropdown", function() {
    $(this).removeClass("dropup");
});

  </script>

<script type="text/javascript">
     $('#ViewProductsReserva').on('show.bs.modal', function (event) {

       var button = $(event.relatedTarget) // Botón que activó el modal

       
        var c_codigo = button.data('c_codigo') // Extraer la información de atributos de datos
         alert('c_codigo='+c_codigo);
        var c_descri = button.data('c_descri') // Extraer la información de atributos de datos
          alert('c_descri='+c_descri);
        var c_departamento = button.data('c_departamento')
          alert('c_departamento='+c_departamento);
        var imagen = button.data('imagen')
         alert('imagen='+imagen);

        
        var modal = $(this)
        modal.find('.modal-title').text('Agregar Pedido Productos: ')
        modal.find('.modal-body #c_codigo').val(c_codigo)
        modal.find('.modal-body #c_descri').val(c_descri)
        modal.find('.modal-body #c_departamento').val(c_departamento)
        modal.find('.modal-body #imagen').val(imagen)    

        $('.alert').hide();//Oculto alert
        })
 
 </script>
 

 <script type="text/javascript">
     $('#ViewProducts').on('show.bs.modal', function (event) {

       var button = $(event.relatedTarget) // Botón que activó el modal

       
        var c_codigo = button.data('c_codigo') // Extraer la información de atributos de datos
        
        var c_descri = button.data('c_descri') // Extraer la información de atributos de datos
         
        var c_departamento = button.data('c_departamento')
         
        var imagen = button.data('imagen')
        

        var modal = $(this)
        modal.find('.modal-title').text('Agregar Pedido Productos: ')
        modal.find('.modal-body #c_codigo').val(c_codigo)
        modal.find('.modal-body #c_descri').val(c_descri)
        modal.find('.modal-body #c_departamento').val(c_departamento)
        modal.find('.modal-body #imagen').val(imagen)    

        $('.alert').hide();//Oculto alert
        })
 
 </script>


  <script type="text/javascript">
    $('#view_modal').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) // Botón que activó el modal

      var private = button.data('private') // Extraer la información de //atributos de datos
      if (private == 1) {
           $("#private").prop("checked",true);
        } else {
            $("#private").prop("checked",false);
        }

      var id_article = button.data('id_article') // Extraer la información de atributos de datos
     //  alert('city='+city);
     var country = button.data('country') // Extraer la información de atributos de datos
     //  alert('city='+city);
      var band = button.data('brand')
    //  alert('emaillll='+email);
      var keywords = button.data('keywords')
     // alert('contac_phone='+contac_phone);
      var story = button.data('story') // Extraer la información de atributos de datos
    //   alert('state='+state);
     var asin = button.data('asin')
     // alert('country='+country);
      var cover_fees = button.data('cover_fees') // Extraer la información de atributos de datos

      var price = button.data('price')
     // alert('surname='+surname);
      var condition_refund = button.data('condition_refund')
     // alert('contac_name='+contac_name);
     var link = button.data('link')
      var url = document.getElementById('linkDinamic');
      url.href = link;
     // $("#linkDinamic").attr('href',link);
     var info = button.data('info')
     // alert('contac_name='+contac_name);
     var commission_agent = button.data('commission_agent')
     // alert('contac_name='+contac_name);
        if (cover_fees == 1) {
           $("#cover_fees").prop("checked",true);
        } else {
            $("#cover_fees").prop("checked",false);
        }
    var modal = $(this)
      modal.find('.modal-title').text('View Products: ')
      modal.find('.modal-body #private').val(private)
      modal.find('.modal-body #id_article').val(id_article)
       modal.find('.modal-body #country').val(country)
       modal.find('.modal-body #brand').val(brand)
       modal.find('.modal-body #keywords').val(keywords)
      modal.find('.modal-body #story').val(story)
      modal.find('.modal-body #asin').val(asin)
      modal.find('.modal-body #cover_fees').val(cover_fees)
      modal.find('.modal-body #price').val(price)
      modal.find('.modal-body #condition_refund').val(condition_refund)
      modal.find('.modal-body #link').val(link)
      modal.find('.modal-body #info').val(info)
      modal.find('.modal-body #commission_agent').val(commission_agent)

      $('.alert').hide();//Oculto alert
    })

    $('#edit_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget) // Botón que activó el modal

            var private = button.data('private') // Extraer la información de //atributos de datos
            if (private == 1) {
                $("#private").prop("checked",true);
            } else {
                $("#private").prop("checked",false);
            }

            var id_article = button.data('id_article') // Extraer la información de atributos de datos
            //  alert('city='+city);
            var country = button.data('country') // Extraer la información de atributos de datos
            //  alert('city='+city);
            var band = button.data('brand')
            //  alert('emaillll='+email);
            var keywords = button.data('keywords')
            // alert('contac_phone='+contac_phone);
            var story = button.data('story') // Extraer la información de atributos de datos
            //   alert('state='+state);
            var asin = button.data('asin')
            // alert('country='+country);
            var cover_fees = button.data('cover_fees') // Extraer la información de atributos de datos

            var price = button.data('price')
            // alert('surname='+surname);
            var condition_refund = button.data('condition_refund')
            // alert('contac_name='+contac_name);
            var link = button.data('link')
            var url = document.getElementById('linkDinamic');
            url.href = link;
            // $("#linkDinamic").attr('href',link);
            var info = button.data('info')
            // alert('contac_name='+contac_name);
            var commission_agent = button.data('commission_agent')
            // alert('contac_name='+contac_name);
            if (cover_fees == 1) {
                $("#cover_fees").prop("checked",true);
            } else {
                $("#cover_fees").prop("checked",false);
            }
            var modal = $(this)
            modal.find('.modal-title').text('Edit Products: ')
            modal.find('.modal-body #private').val(private)
            modal.find('.modal-body #id_article').val(id_article)
            modal.find('.modal-body #country').val(country)
            modal.find('.modal-body #brand').val(brand)
            modal.find('.modal-body #keywords').val(keywords)
            modal.find('.modal-body #story').val(story)
            modal.find('.modal-body #asin').val(asin)
            modal.find('.modal-body #cover_fees').val(cover_fees)
            modal.find('.modal-body #price').val(price)
            modal.find('.modal-body #condition_refund').val(condition_refund)
            modal.find('.modal-body #link').val(link)
            modal.find('.modal-body #info').val(info)
            modal.find('.modal-body #commission_agent').val(commission_agent)

      $('.alert').hide();//Oculto alert
    })

    $('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var modal = $(this)
      modal.find('#id_pais').val(id)
    })   
 

  $( "#ApproveProducts" ).submit(function( event ) {

    var parametros = $(this).serialize();
     alert('parametros.........'+parametros);
       $.ajax({
          type: "POST",
          url: "/Products/Update/Approve",
          data: parametros,
           beforeSend: function(objeto){

            },
          success: function(datos){
            $('#edit_modal').modal('hide');
            setTimeout(function(){
                        swal({ title:'Success!',text:"Approved Product Saved",type:'success'});
                        location.reload();
                    },1000);
          },
          error:function(datos){
                    setTimeout(function(){
                            swal({ title:'Cancelled',text:"Approved Product Saved",type:'error'});

                        },1000);
                }
      });
      event.preventDefault();
    });



    $( "#guardarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
    alert('parametros .....'+parametros);
       $.ajax({
          type: "POST",
          url: "/Products/Update/Save",
          data: parametros,
           success:function(objeto){
            setTimeout(function(){
                    $('#add_alert').css("display", "block");
                   $('#add_alert').alert('close');
                    location.reload();
                 },3000);
            }
      });
      event.preventDefault();
    });


  </script>


    <script type="text/javascript">
         $(document).on('click','#boton',function(event){

                 var id = $(this).attr("name");
                 alert('id Providers '+id);
                 var _token = '{{csrf_token()}}';

                         swal({
                          title: 'Are you sure?',
                          text: " Products Successfully Removed!",
                          type: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Yes, delete it!',
                          cancelButtonText: 'No, cancel!',
                          confirmButtonClass: 'btn btn-success',
                          cancelButtonClass: 'btn btn-danger',
                          buttonsStyling: false,
                          reverseButtons: true
                        }).then(function(result){

                          if (result.value) {

                             $.ajax({
                              url:"/Products/destroy",
                              method:"POST",
                              data:{id:id, _token:_token},
                              success:function(result){

                                swal({ title:'Deleted!',text:"Products Successfully Removed",type:'success'});
                                location.reload();
                              }

                             })
                           } else if(result.dismiss == swal.DismissReason.cancel){

                            swal({ title:'Cancelled',text:"Products Successfully Not Removed",type:'error'});

                          }
                        })

      });
    </script>


<script type="text/javascript">

function agregarCarrito(){

var c_codigo = $("#c_codigo").val();
  alert('c_codigo ='+c_codigo);
var c_descri = $("#c_descri").val();
  alert('c_descri ='+c_descri);
var peso = $("#peso").val();
  alert('peso ='+peso);
var cantidad = $("#cantidad").val();
  alert('cantidad ='+cantidad);
  

  $.ajax({
      url:"/carrito/agregar",
      method:"POST",
      data:{ c_codigo:c_codigo, cantidad:cantidad, peso:peso, c_descri:c_descri },
      success:function(data, status){
          $('#add_alert').css("display", "block");
          $("#add_new_record_modal").modal("hide");
           setTimeout(function(){
             $('#add_alert').alert('close');
              location.reload();
           },3000);
         //


      }
  })

}
</script>

@stop
