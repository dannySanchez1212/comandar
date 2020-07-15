@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.__('Pending My Commission'))

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
     <h1 >

                 <div class="row">


                    <div class="col-md-1">

                    </div>
                    <div class="col-xs-5">
                        <i class="voyager-hammer"></i> {{ __('Pending My Commission') }}
                        <div id="loader" class="text-center">

                        </div>

                    </div>
                </div>

    </h1>

<!-- Bootstrap Modal - To Add New Record -->
@stop

@section('content')

     <!-- Main content -->
        <section class="content">
            <div id="resultados_ajax"></div>
            <div class="outer_div">
                <div class="row">

                    @include('products.product')


              </div>
            </div><!-- Datos ajax Final -->
       </section><!-- /.content -->


@stop

@section('javascript')

   <!-- /............-->
   <!-- DataTables -->
    <script>
            $(document).ready( function () {
              $('#dataTables').DataTable();

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



  <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>


  <script type="text/javascript">

      $('div.panel-body').on("shown.bs.dropdown", ".dropdown", function() {

  var desplegable = $(this).children('ul.dropdown-menu');
  var boton = $(this).children(".dropdown-toggle");

  var separaciondesplegable = desplegable.offset();

  var espacioArriba = (separaciondesplegable.top - boton.height() - desplegable.height()) - $(window).scrollTop();
  // alert('espacioArriba='+espacioArriba);
  var espacioAbajo = $(window).scrollTop() + $(window).height() - (separaciondesplegable.top + desplegable.height());
   //alert('espacioAbajo='+espacioAbajo);
  if (espacioAbajo < 100 && (espacioArriba >= 0 || espacioArriba > espacioAbajo)){
     // alert('entro al si');
      $(this).addClass("dropup");

  }

}).on("hidden.bs.dropdown", ".dropdown", function() {
    $(this).removeClass("dropup");
});

  </script>

    <script type="text/javascript">
        $(function(){
            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show');
            });
        });
    </script>

<script>
    function Sale_price(){

        var profit = $("#profit").val();
        var buying_price = $("#buying_price").val();

        var parametros = {"profit":profit,"buying_price":buying_price};
        alert('parametros_symbol='+parametros.profit);
        $.ajax({
                dataType: "json",
                type:"POST",
                url:'/PendingC/Symbol',
                data: parametros,
                 success:function(data){
                    //$("#datos").html(data).fadeIn('slow');
                 $.each(data, function(index, element) {
                    alert('sale');
                    var precio= element.precio;
                    $("#selling_price").val(precio);
                });


                }
            })
    }

    </script>

<script>
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var filePreview = document.createElement('img');
                filePreview.id = 'file-preview-zone';
                //e.target.result contents the base64 data from the image uploaded
                document.getElementById('pictureimage').src=e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    var fileUpload = document.getElementById('pictureinput');
    fileUpload.onchange = function (e) {
        readFile(e.srcElement);
    }

</script>
@stop
