@php
  $user = Auth::user();
 // dd($user);
@endphp
@include('sweetalert::alert')
@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.__('Invitation'))

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
            <strong>{{ __('Successfully Saved Invitations') }}</strong>
        </div>


    </div>

    <h1 style="margin-top: 2px; margin-bottom: 0px;">

       <div class="row">


                    <div class="col-md-1">

                    </div>
                    <div class="col-xs-5">
                        <i class="voyager-mail"></i> {{ __('Invitations') }}
                        <div id="loader" class="text-center">

                        </div>

                    </div>
                 @if ($user->role_id==1)
                      <div class="col-md-5">
                        <div class="btn-group pull-right">
                          <div class="col-md-2 ">
                            <button type="button" class="btn btn-success btn-add-new" data-toggle="modal" data-target="#add_new_record_modal"><i class="voyager-plus"></i> Add Invitation</button>
                         </div>
                        </div>
                       </div>
                    <input type="hidden" id="per_page" value="15">
                 @endif
                </div>

    </h1>

    <!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->

<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width: 80%">
        <div class="modal-content">

            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">New Invitation</h4>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    <p>{{ session('error') }}</p>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    <p>{{ session('success') }}</p>
                                </div>
                            @endif

                            <div class="panel panel-default">
                                <div class="panel-heading">Requesting Invitation</div>

                                <div class="panel-body">
                                    <p>{{ config('app.name') }} is a closed community. You must have an invitation link to register. You can request your link below.</p>

                                    <form class="form-horizontal" method="POST" action="{{ route('storeInvitation') }}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Request An Invitation
                                                </button>

                                                <a class="btn btn-link" href="{{ route('login') }}">
                                                    Already Have An Account?
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="addItens" type="button" onclick="addInvitation()" class="btn btn-primary">Save</button>
                </div>


            </div>
        </div>
    </div>
</div>


<!--///////////////////////////////// --->

<!-- Modal  view-->


<div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-right: 15px;
padding-left: 15px;">
    <div class="modal-dialog" role="document" style=" width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">View Invitation</h4>
            </div>
            <div class="modal-body">





            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>


        </div>
    </div>
</div>

<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal  edit-->
<form id="SaveInvitation"  method="post">
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-right: 15px;
    padding-left: 15px;">
        <div class="modal-dialog" role="document" style=" width: 100%;">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Invitation</h4>
                </div>
                <div class="modal-body">



                <!--//////////////////////////////////// -->


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    <button id="addItens" type="button
                    "  class="btn btn-primary">Save</button>
                </div>

            </div>
        </div>
    </div>
</form>
<!-- Bootstrap Modal - To Add New Record -->


<!--///////////////////////////////// --->
@stop

@section('content')

     <!-- Main content -->
        <section class="content-product">
            <div id="resultados_ajax"></div>
                <div class="outer_div" style="width:100%;">

                         @include('user.invitation.invitationTable')

                </div><!-- Datos ajax Final -->
       </section><!-- /.content -->


@stop

@section('javascript')
<!-- data data tables Search -->

<!-- DataTables -->
    <script>
            $(document).ready( function () {
                ///

                /////
              $('#dataTabless').DataTable({
                scrollY:        200,
                deferRender:    true,
                "scrollX": true,
                scroller:       true
                ////add button



              });
    </script>


<script  type="text/javascript" src="{{ url('/') }}/js/sweetalert2.all.js"></script>


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

@stop
