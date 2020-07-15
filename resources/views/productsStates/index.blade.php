@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.__('Products States'))

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
            <strong>{{ __('Successfully Saved Product State') }}</strong>
        </div>


    </div>

    <h1 >

       <div class="row">


                    <div class="col-md-1">

                    </div>
                    <div class="col-xs-5">
                        <i class="voyager-world"></i> {{ __('Products States') }}
                        <div id="loader" class="text-center">

                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-success btn-add-new" data-toggle="modal" data-target="#add_new_record_modal"><i class="voyager-plus"></i> Add New</button>
                        </div>
                    </div>
                    <input type="hidden" id="per_page" value="15">
                </div>

    </h1>

<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal  New-->
<form id="ProductsStatesModalNew" method="post">


<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Add New Products States</h4>
</div>
<div class="modal-body">


<div class="form-group">
<label for="name">Products States Name</label>
<input type="text" id="name" name="name" placeholder="Products States Name" class="form-control" />
</div>

<div class="form-group">
<label for="description">Description</label>
<input type="text" id="description" name="description" placeholder="description" class="form-control" />
</div>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

<button id="addItens" type="button
" onclick="addProductsStates()" class="btn btn-primary">Add Products States</button>
</div>


</div>
</div>
</div>
</form>
<!-- Bootstrap Modal -  -->
<!-- Modal  edit-->

<form id="SaveProductsStates"  method="post">
<div class="modal fade" id="ProductsStatesModaledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Edit New Products States</h4>
</div>
<div class="modal-body">

<div class="form-group">
<label for="id">Products States Id</label>
<input type="text" readonly=”readonly” id="id" name="id" placeholder="id" class="form-control" />
</div>

<div class="form-group">
<label for="name">Products States Name</label>
<input type="text" id="name" name="name" placeholder="Products States Name" class="form-control" />
</div>

<div class="form-group">
<label for="description">Description</label>
<input type="text" id="description" name="description" placeholder="Description" class="form-control" />
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

<button id="editItens" type="button
"  class="btn btn-primary">Save Products States</button>
</div>


</div>
</div>
</div>
</form>
<!-- Bootstrap Modal --->
<!-- Modal  view-->


<div class="modal fade" id="ProductsStatesModalview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">View Products States</h4>
</div>
<div class="modal-body">

<div class="form-group">
<label for="id">Products States Id</label>
<input type="text" readonly=”readonly” id="id" name="id" placeholder="Id" class="form-control" />
</div>

<div class="form-group">
<label for="name">Products States Name</label>
<input type="text" readonly=”readonly” id="name" name="name" placeholder="Products States Name" class="form-control" />
</div>

<div class="form-group">
    <label for="description">Description</label>
    <input type="text" id="description" name="description" placeholder="Description" class="form-control" />
</div>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>


</div>
</div>
</div>
<!-- Bootstrap Modal - -->
<!-- -->
@stop

@section('content')


        <!-- Main content -->
        <section class="content">
            <div id="resultados_ajax"></div>
            <div class="outer_div">
                <div class="row">




                    <div class="col-md-3">
              <div class="box box-primary">
                  <div class="box-body box-profile">
                      <div id="load_img">
                          <img class="img-responsive" src="http://sitemaleo.test/storage\settings\November2018\MzeAHaaFq7by5BnHQOXu.jpg" alt="Bussines profile picture">
                      </div>
                      <h3 class="profile-username text-center">tradel</h3>
                      <p class="text-muted text-center mail-text">soporte@sisten.com</p>
                  </div>
              </div>
            </div>
       <div class="col-md-9">
                    <div class="col-md-12">

                        <div class="box">

                            <div></div>
                            <div class="box-body"  style="display: flex;justify-content: center;">

                                <div class="col-md-12" style="width: 95%;font-size: 0px !important;">
                                    <div class="panel panel-bordered">
                                        <div class="panel-body">
                                             <table id="dataTable" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                                  <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label=" Name : activate to sort column ascending" style="width: 50px;">Code</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 126px;">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 126px;">Description</th>
                                          <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 126px;">Action</th>
                                    </tr>
                                </thead>

                                  <tbody>

                                        @foreach($productsStates as $key => $product)

                                         @if ($product->name)
                                           <tr>

                                            <td>
                                                <div class="readmore" style="max-height: none;">{{ strtolower($product->id)}}</div>
                                            </td>
                                            <td>
                                              <div class="readmore" style="max-height: none;">{{ strtolower($product->name) }}</div>
                                               </td>
                                               <td>
                                              <div class="readmore" style="max-height: none;">{{ strtolower($product->description) }}</div>
                                               </td>
                                            <td>



                                              <a href="#UpdateProductsStates{{ $product->id }}" class="btn-floating btn-small waves-effect waves-light blue">
                                                <button type="button" class="btn btn-success btn-edit" data-toggle="modal" data-target="#ProductsStatesModaledit"
data-id="<?php echo $product->id?>" data-name="<?php echo strtolower($product->name)?>" data-description="<?php echo strtolower($product->description) ?> " ><i class="voyager-plus"></i>Edit</button>
                                             </a>

                                              <a class="btn btn-danger" name="{{  $product->id }}" href="#" id="boton" id="boton"> Delete </a>



                                                <a href="#ViewProductsStates{{ $product->id }}" class="btn-floating btn-small waves-effect waves-light blue">
                                                <button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#ProductsStatesModalview"
data-id="<?php echo $product->id?>" data-name="<?php echo strtolower($product->name)?>" data-description="<?php echo strtolower($product->description) ?> "><i class="voyager-plus"></i>View</button>
                                             </a>


                                            </td>


                                        </tr>
                                        @endif

                                        @endforeach
                                </tbody>
                                     </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </div><!-- /.box-body -->

                        </div><!-- /.box -->

                     </div>
                </div><!-- /.col -->
                <!-- /.row -->


            </div><!-- Datos ajax Final -->
       </section><!-- /.content -->


@stop

@section('javascript')

  <script type="text/javascript">
    $('#ProductsStatesModalview').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) // Botón que activó el modal

      var name = button.data('name') // Extraer la información de atributos de datos
      var id = button.data('id') // Extraer la información de atributos de datos
      var description = button.data('description') // Extraer la información de atributos de datos

      var modal = $(this)
      modal.find('.modal-title').text('View Products States: ')
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #description').val(description)

      $('.alert').hide();//Oculto alert
    })

    $('#ProductsStatesModaledit').on('show.bs.modal', function (event) {

      var button = $(event.relatedTarget) // Botón que activó el modal

      var name = button.data('name') // Extraer la información de atributos de datos
      //alert('name='+name);
      var id = button.data('id') // Extraer la información de atributos de datos
      var description = button.data('description') // Extraer la información de atributos de datos

      var modal = $(this)
      modal.find('.modal-title').text('Edit Products States: ')
      modal.find('.modal-body #id').val(id)
      modal.find('.modal-body #name').val(name)
      modal.find('.modal-body #description').val(description)

      $('.alert').hide();//Oculto alert
    })

    $('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var modal = $(this)
      modal.find('#id_pais').val(id)
    })

  $( "#SaveProductsStates" ).submit(function( event ) {

    var parametros = $(this).serialize();
     alert('parametros.........'+parametros);
       $.ajax({
          type: "POST",
          url: "/ProductsStates/Update/Save",
          data: parametros,
           beforeSend: function(objeto){

            },
          success: function(datos){
            $('#ProductsStatesModaledit').modal('hide');
         setTimeout(function(){
                    swal({ title:'Success!',text:"Products States Successfully Save",type:'success'});
                    location.reload();
                 },1000);
          }
      });
      event.preventDefault();
    });



    $( "#guardarDatos" ).submit(function( event ) {
    var parametros = $(this).serialize();
       $.ajax({
          type: "POST",
          url: "/ProductsStates/Update/Save",
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
     $('#editC').on('click',function(){
    $('.modal-body').load('getContent.php?id=2',function(){
        $('#edit_currency_modal').modal({show:true});
    });
});

   </script>

    <!-- DataTables -->
    <script>
            $(document).ready( function () {
              $('#dataTable').DataTable();


                $('#toggle_options').click(function () {
                $('.new-ProductsStates-options').toggle();
                if ($('#toggle_options .voyager-double-down').length) {
                    $('#toggle_options .voyager-double-down').removeClass('voyager-double-down').addClass('voyager-double-up');
                } else {
                    $('#toggle_options .voyager-double-up').removeClass('voyager-double-up').addClass('voyager-double-down');
                }
            });

            $('.panel-actions .voyager-trash').click(function () {
                var display = $(this).data('display-name') + '/' + $(this).data('display-key');

                $('#delete_ProductsStates_title').text(display);

                $('#delete_form')[0].action = '{{ route('voyager.settings.delete', [ 'id' => '__id' ]) }}'.replace('__id', $(this).data('id'));
                $('#delete_modal').modal('show');
            });

            $('.toggleswitch').bootstrapToggle();
            } );
    </script>
<script type="text/javascript">

    function addProductsStates() {
    // get values
    var name = $("#name").val();
   //  alert('currency_name;;;;'+currency_name);
    var description = $("#description").val();
  //   alert('currency_symbol;;;;'+currency_symbol);



        $.ajax({
            url:"/ProductsStates/Update",
            method:"POST",
            data:{name:name, description:description},
            success:function(data, status){
                $("#add_new_record_modal").modal("hide");
              //   alert('elemento save   ');
            }
        });

}
</script>

   <script type="text/javascript">
         $(document).on('click','#boton',function(event){

                 var id = $(this).attr("name");

                 var _token = '{{csrf_token()}}';

                         swal({
                          title: 'Are you sure?',
                          text: " Products States Successfully Removed!",
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
                              //alert('id...'+id);
                             $.ajax({
                              url:"/ProductsStates/destroy",
                              method:"POST",
                              data:{id:id, _token:_token},
                              success:function(result){

                                swal({ title:'Deleted!',text:"Products States Successfully Removed",type:'success'});
                                location.reload();
                              }

                             })
                           } else if(result.dismiss == swal.DismissReason.cancel){

                            swal({ title:'Cancelled',text:"Products States Successfully Not Removed",type:'error'});

                          }
                        })

      });
    </script>


@stop
