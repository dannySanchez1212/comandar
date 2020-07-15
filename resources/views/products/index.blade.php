@php
  $user = Auth::user();
 // dd($user);
@endphp
 
@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.__('Products'))

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
                        <i class="voyager-basket"></i> {{ __('All Products') }}
                        <div id="loader" class="text-center">

                        </div>

                    </div>                 
                </div>

    </h1>
    <!-- Bootstrap Modal  -->
<!-- import data -->
<form name="update_register" action="#"  style="width:100%;display: inline-grid;justify-content: center;margin-bottom: 0px;" class="form-horizontal" id="update_register" enctype="multipart/form-data" accept-charset="UTF-8" method="post">
<div class="modal fade" id="add_import" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Import Products</h4>
</div>

<div class="modal-body">

           <div class="col-md-3">
              <div class="box box-primary" style="padding-top: 5px;padding-left: 5px;    padding-right: 5px;padding-bottom: 5px;">
                  <div class="box-body box-profile">
                      <div id="load_img">
                      <img class="img-responsive" src="{{ url('/') }}/img/Product/product.png" id="pictureimage" alt="Bussines profile picture">

                      </div>
                  </div>
              </div>
            </div>


                  <div class="col-md-9" style="padding-right: 0px;    padding-left: 0px;">
                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; width: 100%; ">
                        <div class="content" style="margin-top: 0px;margin-left: 10px;margin-right: 10px;margin-bottom: 20px;">
                        <div class="box" style=" padding-right: 0px; padding-left: 0px;    padding-top: 0px; padding-bottom: 0px;
">

                            <div></div>
                            <div class="box-body"  style="display: flex;justify-content: center;">


<form name="update_register"   style="width:100%;display: inline-grid;justify-content: center;" class="form-horizontal" id="update_register" enctype="multipart/form-data" accept-charset="UTF-8" method="post">
      @csrf
        <div class="content">
        <div class="col-md-12 center" style="text-align: center;">
             <h4>Upload the file of the products to be imported</h4>
        </div>
        <div  class="col-md-12 center" style="text-align: -webkit-center;">
            <button id="divbrowsefile" class="btn btn-danger" onclick="" type="button"  style="display:block;">
                <i class="voyager-data"></i>
                <label>Browse File
                <input required style="display:none;" value="BrowseFile" name="BrowseFile" id="BrowseFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  type="file">
                </label>

            </button>

            <label for="BrowseFile" id="fichero"></label>
        </div>
        <div id="divbrowsefileCancel" class="col-md-12 center" style="display:none; text-align: center;">
            <button class="btn btn-success" onclick="cancelinput();" type="button" >
                <i class="voyager-data"></i>
                <label>Cancel File
                 </label>
            </button>
        </div>
        <div id="upload" class="col-md-12 center" style="text-align: center; display:none;">
            <button id="Pbutton" class="btn btn-info" onclick="startProgress()" type="button">
                <i class="voyager-data"></i>
                <label>Upload File</label>
            </button>
            <div id="load" class="containers" style="display:none;">
                <div id="nun" class="skills html"></div>
              </div>
        </div>

        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width:0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
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
<button id="addItensDate" type="submit"  style="display:none;" class="btn btn-primary">Save</button>
</div>


</div>
</div>
</div>
</div>
</form>



    <!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->

<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document" style="width: 80%">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Add New Products</h4>
</div>

<div class="modal-body">

           <div class="col-md-3">
              <div class="box box-primary" style="padding-top: 5px;padding-left: 5px;    padding-right: 5px;padding-bottom: 5px;">
                  <div class="box-body box-profile">
                      <div id="load_img">
                      <img class="img-responsive" src="{{ url('/') }}/img/Product/product.png" id="pictureimage" alt="Bussines profile picture">

                      </div>
                  </div>
              </div>
            </div>


                  <div class="col-md-9" style="padding-right: 0px;    padding-left: 0px;">
                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; width: 100%; ">
                        <div class="content" style="margin-top: 0px;margin-left: 10px;margin-right: 10px;margin-bottom: 20px;">
                        <div class="box" style=" padding-right: 0px; padding-left: 0px;    padding-top: 0px; padding-bottom: 0px;
">

                            <div></div>
                            <div class="box-body"  style="display: flex;justify-content: center;">


    <form name="update_register" style="width:100%;" class="form-horizontal" id="update_register" enctype="multipart/form-data" accept-charset="UTF-8" method="post">

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a aria-expanded="false" href="#details" data-toggle="tab">Product Details</a></li>


            </ul>
            <div class="tab-content">
              <div id="resultados_ajax"></div>
              <div class="tab-pane active" id="details" style="padding-left: 6%; padding-right: 0%;">

                  <div class="form-group ItemsSpace">
                    <div class="col-sm-12">
                        <div class="col-sm-2">
                          <label class="control-label" for="private">Private</label>
                        </div>
                        <div class="col-sm-10">
                        <input name="private" id="private" type="checkbox">
                        </div>
                   </div>
                  </div>

                  <div class="from-group ItemsSpace">
                      <div class="col-sm-12">
                        <div class="col-sm-2">
                            <label class="control-label" for="outOfStock">Out Of Stock</label>

                        </div>
                        <div class="col-sm-8">
                            <h6>Please marked when the article cant ordered</h6>
                            <input name="outOfStock" id="outOfStock" type="checkbox">
                        </div>
                      </div>
                  </div>
                  <br/>
                  <div class="form-group" style="padding-bottom: 2%; padding-top: 6%;">
                    <label class="col-sm-2 control-label" for="Country">Country</label>
                    <div class="col-sm-7">
                        <select name="country" class="form-control" id="country" required>
                            <option value="">Select the country of the from the article in Amazon</option>
                                   
                        </select>
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="pictureinput">Picture</label>
                    <h6 class="col-sm-5">Please marked when the article cant ordered</h6>
                    <div class="col-sm-2 btn-file-upload" id="divFileUpload">
                        <button class="btn btn-info">
                        <label>Upload file
                          <input required style="display:none;" name="pictureinput" id="pictureinput" accept="image/*" data-name="picture" type="file">
                        </label></button>
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="keywords">Keywords</label>
                    <div class="col-sm-10">
                        <textarea required placeholder="White the keywords to find the article in amazan" name="keywords" class="form-control" id="keywords"></textarea>
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="brand">Brand</label>
                    <div class="col-sm-8">
                        <input required type="text" placeholder="White the name of the brand for the article" class="form-control name="brand" id="brand">
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="store">Store</label>
                    <div class="col-sm-8">
                        <input required type="text"  placeholder="White the name of the store seller for the article" class="form-control" name="store" id="store">
                    </div>
                  </div>

                   <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="asin">Asin</label>
                    <div class="col-sm-8">
                      <input required name="asin" placeholder="White the Asin for the article, when is a article with differents models, Please write the Asin without model Select" class="form-control" id="asin" type="text">
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                     <label class="col-sm-2 control-label" for="coverFees">Cover Fees</label>
                     <div class="col-sm-8">
                        <h6>Please unmarkt if the brand dont cover PP fees (not recommended)</h6>
                        <input required name="coverFees" id="coverFees" type="checkbox">
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="price">Price</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-usd">$</i>
                          </div>
                          <input required  min="0" placeholder="Write the article price with , please, dont use the point." name="price" class="form-control" id="price" type="number" pattern="\d+(\.\d{2})?">
                        </div>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="link">Link</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                          </div>
                          <input required name="link" placeholder="Web address (ex. http://..)"  class="form-control" id="link" type="url">
                        </div>
                    </div>
                  </div>
                  <h6 style="padding-left:18%;">Add the link for the article in Amazon, if you can addthe link with the keywords search is the best.</h6>

                  <div class="form-group" style="padding-top:3%;padding-bottom:0%;margin:0px;">
                    <label class="col-sm-3 control-label" for="conditionRefund">Condition Refund</label>

                    <div class="col-sm-9">
                        <div class="input-group">
                            <select required class="form-control select2 select2-hidden-accessible" id="conditionRefund" name="conditionRefund" tabindex="-1" aria-hidden="true">
                                <option value="5">Text Review 5 Stars</option>
                                <option value="4">Text Review 4 Stars</option>
                                <option value="3">Text Review 3 Stars</option>
                                <option value="2">Text Review 2 Stars</option>
                                <option value="1">Text Review 1 Stars</option>
                                <option value="0">Text Review 0 Stars</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <h6 style="padding-left:26%; padding-bottom:3%;">Write the article price with "," please, dont use the point "."</h6>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="info">Info</label>
                    <div class="col-sm-10">
                        <textarea required placeholder="Please details specials conditions or info for the buyers" name="info" class="form-control" id="info"></textarea>
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="privatInfo">Privat Info</label>

                    <div class="col-sm-10">
                        <textarea required placeholder="This info can only see the seller" name="privatInfo" class="form-control" id="privatInfo"></textarea>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="maxOrdersPerDay">Max Orders Per Day</label>
                        <h6>Please write how much order per day can ordered, when not limit write "999"</h6>
                    <div class="col-sm-8">
                          <input required name="maxOrdersPerDay"  min="0" max="999" class="form-control" id="maxOrdersPerDay" type="number" >
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                    <label class="col-sm-2 control-label" for="soldToday">Sold Today</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                          </div>
                          <input required name="soldToday" placeholder="0"  min="0" class="form-control" id="soldToday" type="number">
                        </div>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="maxOrdersPerWeek">Max Orders Per Week</label>
                        <h6>Please write how much order per Week can ordered, when not limit write "999"</h6>
                    <div class="col-sm-8">
                          <input required name="maxOrdersPerWeek"  min="0" max="999" class="form-control" id="maxOrdersPerWeek" type="number" >
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                    <label class="col-sm-2 control-label" for="soldWeek">Sold Week</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                          </div>
                          <input required name="soldWeek" placeholder="0"  min="0"  class="form-control" id="soldWeek" type="number">
                        </div>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="maxOrdersTotal">Max Orders Total</label>
                        <h6>How much orders in total  forn article, if dont have limit please write "999"</h6>
                    <div class="col-sm-8">
                          <input required name="maxOrdersTotal"  min="0" max="999" placeholder="0" class="form-control" id="maxOrdersTotal" type="number" >
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                    <label class="col-sm-2 control-label" for="soldTotal">Sold Total</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                          </div>
                          <input required name="soldTotal" placeholder="0"  min="0"  class="form-control" id="soldTotal" type="number">
                        </div>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="commission">Commission</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-usd">EUR</i>
                          </div>
                          <input required name="commission" class="form-control" id="commission" type="number" >
                        </div>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                    <label class="col-sm-2 control-label" for="seller">Seller</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <select name="seller" class="form-control" id="seller" required>
                            <option value="">Select</option>
                                    @foreach ( $users as $user )
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                          </select>
                        </div>
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



<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button id="addItens" type="button" onclick="addProducts()" class="btn btn-primary">Save</button>
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
<h4 class="modal-title" id="myModalLabel">View Products</h4>
</div>
<div class="modal-body">


    <div class="col-md-3">
        <div class="box box-primary" style="display: flex;justify-content: center;padding-right: 0px;padding-top: 0px;padding-bottom: 0px;padding-left: 0px;">

                                  <div class="box-body box-profile">
                                      <label>Picture</label>
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
                                    <li class="active"><a aria-expanded="false" href="#details" data-toggle="tab">Product Details</a></li>


                                    </ul>
                                    <div class="tab-content" style="height: 348px;">
                                    <div id="resultados_ajax">  </div>



                                    <div class="tab-pane active" id="details" style="margin-right: 2%;">

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_private">Private</label>

                                            <div class="col-sm-4">
                                              <input name="private" readonly=”readonly”  id="private" type="checkbox">
                                            </div>
                                            <label class="col-sm-2 control-label" for="id_article">Id Article</label>

                                            <div class="col-sm-4">
                                              <input name="id_article" readonly=”readonly” class="form-control" id="id_article" type="text" value="2763">
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_country">Country</label>

                                            <div class="col-sm-6">
                                              <img id="country" src="" alt="">
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_keywords">Keywords</label>

                                            <div class="col-sm-9">
                                               <textarea style="width: 100%;
                                               height: 14%;
                                               min-height: 39px !important;" readonly=”readonly” class="form-control" name="keywords" id="keywords" cols="30" rows="10" >Tasche für Nintendo Switch Lite 2019</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_brand">Brand</label>

                                            <div class="col-sm-4">
                                              <input name="brand" readonly=”readonly” class="form-control" id="brand" type="text" value="Tikola">
                                            </div>
                                            <label class="col-sm-2 control-label" for="Product_store">Store</label>

                                            <div class="col-sm-4">
                                              <input name="store" readonly=”readonly” class="form-control" id="store" type="text" value=" Tikola EU">
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_asin">Asin</label>

                                            <div class="col-sm-4">
                                              <input name="asin" readonly=”readonly” class="form-control" id="asin" type="text" value="B07WDV5HY3">
                                            </div>
                                            <label class="col-sm-2 control-label" for="Product_cover_fees">Cover Fees</label>

                                            <div class="col-sm-4">
                                                <input name="cover_fees" readonly=”readonly”   id="cover_fees" type="checkbox">
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_price">Price</label>

                                            <div class="col-sm-4">
                                              <input name="price" readonly=”readonly” class="form-control" id="price" type="text" value="12,99">
                                            </div>
                                            <label class="col-sm-2 control-label" for="Product_condition_refund">Condition Refund</label>

                                            <div class="col-sm-4">
                                                <input type="text" readonly=”readonly” class="form-control" name="condition_refund" id="condition_refund" value="Picture Review 5 Stars">
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_link">Link</label>

                                            <div class="col-sm-6">
                                                <a id="linkDinamic" class="automatic bb-link bb-stop-propagation" href="#" title="https://amzn.to/2KSBbUS" target="_blank">LINK ARTICLE</a>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_info">Info</label>

                                            <div class="col-sm-9">
                                               <textarea readonly style="width: 100%;
                                               height: 14%;
                                               min-height: 39px !important;" readonly=”readonly” class="form-control" name="info" id="info" cols="30" rows="10" >Need Pictures in review</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <label class="col-sm-2 control-label" for="product_link">Commission Agent</label>

                                            <div class="col-sm-6">
                                                    <input readonly=”readonly” class="form-control" name="commission" id="commission" type="text" value="2,40">
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

<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal  edit-->
<form id="SaveProducts"  method="post">
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-right: 15px;
    padding-left: 15px;">
    <div class="modal-dialog" role="document" style=" width: 100%;">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    <h4 class="modal-title" id="myModalLabel">Edit Product</h4>
    </div>
    <div class="modal-body">


        <div class="col-md-3">
            <div class="box box-primary" style="display: flex;justify-content: center;padding-right: 0px;padding-top: 0px;padding-bottom: 0px;padding-left: 0px;">

                                      <div class="box-body box-profile">
                                          <label>Picture</label>
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



                                <div class="nav-tabs-custom" style="height: 85%;">
                                    <ul class="nav nav-tabs">
                                    <li class="active"><a aria-expanded="false" href="#details" data-toggle="tab">Product Details</a></li>


                                    </ul>
                                    <div class="tab-content" style="height: 348px;">
                                    <div id="resultados_ajax">  </div>



                                    <div class="tab-pane active" id="details" style="margin-right: 2%;">

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label" for="product_private">Private</label>

                                            <div class="col-sm-4">
                                              <input name="private"  id="private" type="checkbox">
                                            </div>
                                            <label class="col-sm-2 control-label" for="id_article">Id Article</label>

                                            <div class="col-sm-4 space-itens">
                                              <input name="id_article" required class="form-control" id="id_article" type="text" value="2763">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label" for="product_country">Country</label>

                                            <div class="col-sm-4">
                                              <img id="country" src="" alt="" class="form-control">
                                            </div>
                                            <div class="col-sm-4 space-itens" style="visibility: hidden;">
                                                <img   src="" alt="" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-3 control-label" for="product_keywords">Keywords</label>

                                            <div class="col-sm-9 space-itens">
                                               <textarea style="width: 100%;
                                               height: 14%;
                                               min-height: 39px !important;" required class="form-control" name="keywords" id="keywords" cols="30" rows="10" >Tasche für Nintendo Switch Lite 2019</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label" for="product_brand">Brand</label>

                                            <div class="col-sm-4">
                                              <input name="brand" required class="form-control" id="brand" type="text" value="Tikola">
                                            </div>
                                            <label class="col-sm-2 control-label" for="Product_store">Store</label>

                                            <div class="col-sm-4 space-itens">
                                              <input name="store" required class="form-control" id="store" type="text" value=" Tikola EU">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label" for="product_asin">Asin</label>

                                            <div class="col-sm-4">
                                              <input name="asin" required class="form-control" id="asin" type="text" value="B07WDV5HY3">
                                            </div>
                                            <label class="col-sm-2 control-label" for="Product_cover_fees">Cover Fees</label>

                                            <div class="col-sm-4 space-itens">
                                                <input name="cover_fees"   id="cover_fees" type="checkbox">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label" for="product_price">Price</label>

                                            <div class="col-sm-4">
                                              <input name="price" required class="form-control" id="price" type="text" value="12,99">
                                            </div>
                                            <label class="col-sm-2 control-label" for="Product_condition_refund">Condition Refund</label>

                                            <div class="col-sm-4 space-itens">
                                                <input type="text" required class="form-control" name="condition_refund" id="condition_refund" value="Picture Review 5 Stars">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label" for="product_link">Link</label>

                                            <div class="col-sm-6 space-itens">
                                                <a id="linkDinamic" class="automatic bb-link bb-stop-propagation" href="#" title="https://amzn.to/2KSBbUS" target="_blank">LINK ARTICLE</a>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label" for="product_info">Info</label>

                                            <div class="col-sm-9 space-itens">
                                               <textarea required style="width: 100%;
                                               height: 14%;
                                               min-height: 39px !important;" class="form-control" name="info" id="info" cols="30" rows="10" >Need Pictures in review</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label class="col-sm-2 control-label" for="product_link">Commission Agent</label>

                                            <div class="col-sm-6 space-itens">
                                                    <input required class="form-control" name="commission" id="commission" type="text" value="2,40">
                                             </div>
                                        </div>



                                    </div>
                                    <!-- /.tab-pane -->

                                    </div>


                                    <!-- /.tab-content -->
                                </div>
                                <!-- /.nav-tabs-custom -->





                    </div>
                  </div>
                </div>

            </div>
        </div>



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

<!-- /.....add itens search.......-->
<script>
    $(document).ready(function(){

      var next = 1;
      $(".add_more").click(function(e){

          e.preventDefault();
          next = next + 1;

          document.getElementById("value_id").value=next;
          var newIten = '<div id="add_itens_'+next+'">'+
                         '<div>'+
                            '<div  class="col-md-12">'+
                                '<div class="col-md-1">'+
                                    '<input type="radio" checked="checked" value="AND" name="bb-advsearch-logicaloper_'+next+'">'+
                                    '<label for="bb-advsearch-condition-and_'+next+'">and</label>'+
                                '</div>'+
                                '<div class="col-md-1">'+
                                    '<input type="radio" value="OR" name="bb-advsearch-logicaloper_'+next+'">'+
                                    '<label for="bb-advsearch-condition-or_'+next+'">or</label>'+
                                '</div>'+
                            '</div>'+
                            '<div  class="col-md-12">'+
                              '<div class="col-md-2" style="padding: unset;">'+
                                '<select id="bdSelect_'+next+'" name="bb-select-db-logicaloper_'+next+'" class="bb-advsearch-item-field bb-advsearch-item-field_0">'+
                                    '<option value="id">ID ARTICLE</option>'+
                                    '<option value="country">COUNTRY</option>'+
                                    '<option value="picture">PICTURE</option>'+
                                    '<option value="keywords">KEYWORDS</option>'+
                                    '<option value="brand">BRAND</option>'+
                                    '<option value="store">STORE</option>'+
                                    '<option value="asin">ASIN</option>'+
                                    '<option value="coverFees">COVER FEES</option>'+
                                    '<option value="price">PRICE</option>'+
                                    '<option value="conditionRefund">CONDITION REFUND</option>'+
                                    '<option value="link">LINK</option>'+
                                    '<option value="info">INFO</option>'+
                                    '<option value="commissionAgent">COMMISSION AGENT</option>'+
                                '</select>'+
                              '</div>'+

                              '<div class="col-md-2" style="padding: unset;">'+
                                '<select id="dbStatus_'+next+'" name="bb-select-status-logicaloper_'+next+'" class="bb-advsearch-item-oper bb-advsearch-item-oper_0">'+
                                    '<option value="=">is equal to</option>'+
                                    '<option value="!=">not equal to</option>'+
                                    '<option value="contains">contains</option>'+
                                    '<option value="notcontains">not contains</option>'+
                                    '<option value="start">starts with</option>'+
                                    '<option value="end">ends with</option>'+
                                    '<option value="empty">is empty</option>'+
                                    '<option value="notempty">is not empty</option>'+
                                    '<option value=">">is greater than</option>'+
                                    '<option value=">=">is greater than equal</option>'+
                                    '<option value="<">is less than</option>'+
                                    '<option value="<=">is less than equal</option>'+
                                '</select>'+
                              '</div>'+
                              '<div class="col-md-2" style="padding: unset;">'+
                                '<input id="dbSearch_'+next+'" name="bb-select-dinamic-logicaloper_'+next+'" type="text" autocomplete="off" class="bb-advsearch-item-val_0">'+
                              '</div>'+
                              '<div class="col-md-1" style="padding: unset;">'+
                                '<a style="padding-left: 9.609;" href="javaScript:delete_itens()" id="imgdelete" name="add_itens_'+next+'"><img  src="https://basebear.com/images/datagrid/remove.png" alt=""></a>'+
                              '</div>'+
                              '</div>'+
                          '</div>'+
                          '</div>';
       // var newItens = $(newIten);
        $('#add_itens_search').append(newIten);

       // $("#count").val(next);
      });
      function delete_itens(){
         var eliminar =  $('#imgdelete').attr("name");
            $("#"+eliminar).remove();
            next= next -1;
    }

      ///delete itens
     });
 </script>

<script>
   function delete_itens(){
         var eliminar =  $('#imgdelete').attr("name");
            $("#"+eliminar).remove();
    }
</script>
<script>
       function search(){
           $('#searchProduct').toggle();
       }

       function close(){
        $('#searchProduct').toggle();
       }
</script>
<!-- /............-->
   <!-- button cancel file -->
<script>
 function cancelinput(){
    document.getElementById('fichero').innerHTML = "";
    document.getElementById("BrowseFile").value = "";

    document.getElementById("Pbutton").className ='btn btn-info';
    document.getElementById("load").className ="skills html";
    $('#load').toggle();
       $('#upload').toggle();
       $('#divbrowsefile').toggle();
        $('#divbrowsefileCancel').toggle();
        var elem = document.getElementById("nun");
        elem.style.width = 0 + "%";
        elem.innerHTML = 0 + "%";
         $("#addItensDate").hide();
  }
</script>

<!-- /............-->
   <!-- button progress file -->


<script type="text/javascript">

var i = 0;

function startProgress()
{

    // change button to progress button, and add progress bar
    $('#Pbutton').addClass('btn-danger');
     $('#load').toggle();
    // update progress bar every 0.5 second


  if (i == 0) {
    i = 1;
    var elem = document.getElementById("nun");

    var width = 1;
    var id = setInterval(frame, 10);

    function frame() {

      if (width >= 100) {
        $("#addItensDate").show();
        clearInterval(id);
        i = 0;

      } else {

        width++;
        elem.style.width = width + "%";
        elem.innerHTML = width * 1 + "%";

      }

    }
  }

}
</script>

 <!-- /............-->
   <!-- button browse file name -->
  <script type="text/javascript">
       document.getElementById('BrowseFile').onchange = function(){
           document.getElementById('fichero').innerHTML = document.getElementById('BrowseFile').files[0].name;
        $('#upload').toggle();
        $('#divbrowsefile').toggle();
        $('#divbrowsefileCancel').toggle();
       }
  </script>
   <!-- /............-->

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

    $( "#SaveProducts" ).submit(function( event ) {

        var parametros = $(this).serialize();
        alert('parametros.........'+parametros);
        $.ajax({
            type: "POST",
            url: "/Products/Update/Save",
            data: parametros,
            beforeSend: function(objeto){

                },
            success: function(datos){
                $('#edit_modal').modal('hide');
            setTimeout(function(){
                        swal({ title:'Success!',text:"Products Successfully Save",type:'success'});
                        location.reload();
                    },1000);
            }
        });
        event.preventDefault();
});

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
   function importDate(){
    var BrowseFile = $("#BrowseFile").val();


                $.ajax({
                        url:"/Products/import",
                        method:"POST",

                        data:{ BrowseFile:BrowseFile},
                        success:function(data, status){

                            $('#add_alert').css("display", "block");
                            $("#add_import").modal("hide");
                            setTimeout(function(){
                                $('#add_alert').alert('close');
                                    location.reload();
                            },3000);
                        //
                        },
                        error : function(xhr, status) {
                            swal({ title:'Error',text:"Saving Imported Products",type:'error'});
                        }

                    })

   }


   $('#fileUpload').on('change','input[type="file"]',function(){
	// this.files[0].size recupera el tamaño del archivo
	// alert(this.files[0].size);

	var fileName = this.files[0].name;
	var fileSize = this.files[0].size;

	if(fileSize > 3000000){
		alert('El archivo no debe superar los 3MB');
		this.value = '';
		this.files[0].name = '';
	}else{
		// recuperamos la extensión del archivo
		var ext = fileName.split('.').pop();

		// Convertimos en minúscula porque
		// la extensión del archivo puede estar en mayúscula
		ext = ext.toLowerCase();

		// console.log(ext);
		switch (ext) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'pdf': break;
			default:
				alert('El archivo no tiene la extensión adecuada');
				this.value = ''; // reset del valor
				this.files[0].name = '';
		}
	}
});
   $('#pictureinput').on('change','input[type="file"]',function(){
	// this.files[0].size recupera el tamaño del archivo
	// alert(this.files[0].size);

	var fileName = this.files[0].name;
	var fileSize = this.files[0].size;

	if(fileSize > 3000000){
		alert('El archivo no debe superar los 3MB');
		this.value = '';
		this.files[0].name = '';
	}else{
		// recuperamos la extensión del archivo
		var ext = fileName.split('.').pop();

		// Convertimos en minúscula porque
		// la extensión del archivo puede estar en mayúscula
		ext = ext.toLowerCase();

		// console.log(ext);
		switch (ext) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'pdf': break;
			default:
				alert('El archivo no tiene la extensión adecuada');
				this.value = ''; // reset del valor
				this.files[0].name = '';
		}
	}
});
 </script>

  <script type="text/javascript">

      function addProducts(){
                // get values
                var private = document.getElementById("private").checked;
               // alert('private ='+private);

                var outOfStock = document.getElementById("outOfStock").checked;
              //  alert('outOfStock ='+outOfStock);

                var country = $("#country").val();
               // alert('country ='+country);

                var pictureinput = $("#pictureinput").val();
               // alert('pictureinput ='+pictureinput);

                var keywords = $("#keywords").val();
               // alert('keywords ='+keywords);

                var brand = $("#brand").val();
               // alert('brand ='+brand);

                var store = $("#store").val();
                //alert('store ='+store);

                var asin = $("#asin").val();
                //alert('asin ='+asin);

                var coverFees = document.getElementById("coverFees").checked;
              //  alert('coverFees ='+coverFees);

                var price= $("#price").val();
               // alert('price ='+price);

                var link = $('#link').val();
              //  alert('link ='+link);

                var conditionRefund = $('#conditionRefund').val();
               // alert('conditionRefund ='+conditionRefund);

                var info = $('#info').val();
              //  alert('info ='+info);

                var privatInfo = $('#privatInfo').val();
             //   alert('privatInfo ='+privatInfo);

                var maxOrdersPerDay = $('#maxOrdersPerDay').val();
               // alert('maxOrdersPerDay ='+maxOrdersPerDay);

                var soldToday = $('#soldToday').val();
              //  alert('soldToday ='+soldToday);

                var maxOrdersPerWeek = $('#maxOrdersPerWeek').val();
             //   alert('maxOrdersPerWeek ='+maxOrdersPerWeek);

                var soldWeek = $('#soldWeek').val();
              //  alert('soldWeek ='+soldWeek);

                var maxOrdersTotal = $('#maxOrdersTotal').val();
              //  alert('maxOrdersTotal ='+maxOrdersTotal);

                var soldTotal = $('#soldTotal').val();
              //  alert('soldTotal ='+soldTotal);

                var commission = $('#commission').val();
              //  alert('commission ='+commission);

                var seller = $('#seller').val();
              //  alert('seller ='+seller);


                    $.ajax({
                        url:"/Products/Update",
                        method:"POST",

                        data:{ private:private, outOfStock:outOfStock, country:country,
                               pictureinput:pictureinput, keywords:keywords, brand:brand, store:store,
                               conditionRefund:conditionRefund, info:info, privatInfo:privatInfo, maxOrdersPerDay:maxOrdersPerDay,
                               soldToday:soldToday, maxOrdersPerWeek:maxOrdersPerWeek, soldWeek:soldWeek, maxOrdersTotal:maxOrdersTotal,
                               soldTotal:soldTotal, commission:commission, seller:seller,
                               asin:asin, coverFees:coverFees, price:price, link:link
                                 },
                        success:function(data, status){

                           $("#add_new_record_modal").modal("hide");
                           setTimeout(function(){
                                swal({ title:'Success!',text:"Product Saved",type:'success'});
                                location.reload();
                            },1000);
                        },
                        error : function(xhr, status) {
                            swal({ title:'Error',text:"Saving  Products",type:'error'});
                        }
                    })

            }
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
                url:'/Product/Symbol',
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
