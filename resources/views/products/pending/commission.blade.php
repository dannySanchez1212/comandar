@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.__('Pending Commissions'))

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
                        <i class="voyager-hammer"></i> {{ __('Pending Commissions') }}
                        <div id="loader" class="text-center">

                        </div>

                    </div>
                </div>

    </h1>

    <!-- Bootstrap Modal - To Add New Record -->
<!-- Modal -->

<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document" style="width: 80%">
<div class="modal-content">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Add New Pending Commissions</h4>
</div>

<div class="modal-body">

                  <div class="col-md-12" style="padding-right: 0px;    padding-left: 0px;">
                    <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; width: 100%; ">
                        <div class="content" style="margin-top: 0px;margin-left: 10px;margin-right: 10px;margin-bottom: 20px;">
                        <div class="box" style=" padding-right: 0px; padding-left: 0px;    padding-top: 0px; padding-bottom: 0px;
">

                            <div></div>
                            <div class="box-body"  style="display: flex;justify-content: center;">


    <form name="update_register" style="width:100%;" class="form-horizontal" id="update_register" enctype="multipart/form-data" accept-charset="UTF-8" method="post">

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a aria-expanded="false" href="#details" data-toggle="tab">Pending Commission Details</a></li>


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
                        <select name="country" class="form-control" id="country" required="">
                            <option value="">Select the country of the from the article in Amazon</option>
                                    @foreach ( $countrys as $country )
                                        <option value="{{ $country->id }}">{{ $country->code }}</option>
                                    @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="pictureinput">Picture</label>
                    <h6 class="col-sm-5">Please marked when the article cant ordered</h6>
                    <div class="col-sm-2 btn-file-upload" id="divFileUpload">
                        <button class="btn btn-info">
                        <label>Upload file
                          <input style="display:none;" name="pictureinput" id="pictureinput" accept="image/*" data-name="picture" type="file">
                        </label></button>
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="keywords">Keywords</label>
                    <div class="col-sm-10">
                        <textarea placeholder="White the keywords to find the article in amazan" name="keywords" class="form-control" id="keywords"></textarea>
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="brand">Brand</label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="White the name of the brand for the article" class="form-control name="brand" id="brand">
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="store">Store</label>
                    <div class="col-sm-8">
                        <input type="number"  min="0" placeholder="White the name of the store seller for the article" class="form-control" name="store" id="store">
                    </div>
                  </div>

                   <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="asin">Asin</label>
                    <div class="col-sm-8">
                      <input name="asin" placeholder="White the Asin for the article, when is a article with differents models, Please write the Asin without model Select" class="form-control" id="asin" type="text">
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                     <label class="col-sm-2 control-label" for="coverFees">Cover Fees</label>
                    <div class="col-sm-8">
                        <input placeholder="Please unmarkt if the brand dont cover PP fees (not recommended)" name="coverFees" class="form-control" id="coverFees" type="text">
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="price">Price</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-usd">$</i>
                          </div>
                          <input  min="0" placeholder="Write the article price with , please, dont use the point." name="price" class="form-control" id="price" type="number" pattern="\d+(\.\d{2})?">
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
                          <input name="link" placeholder="Web address (ex. http://..)"  class="form-control" id="link" type="url">
                        </div>
                    </div>
                  </div>
                  <h6 style="padding-left:18%;">Add the link for the article in Amazon, if you can addthe link with the keywords search is the best.</h6>

                  <div class="form-group" style="padding-top:3%;padding-bottom:0%;margin:0px;">
                    <label class="col-sm-3 control-label" for="conditionRefund">Condition Refund</label>

                    <div class="col-sm-9">
                        <div class="input-group">
                            <select class="form-control select2 select2-hidden-accessible" id="conditionRefund" name="conditionRefund" tabindex="-1" aria-hidden="true">
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
                        <textarea placeholder="Please details specials conditions or info for the buyers" name="info" class="form-control" id="info"></textarea>
                    </div>
                  </div>
                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="privatInfo">Privat Info</label>

                    <div class="col-sm-10">
                        <textarea placeholder="This info can only see the seller" name="privatInfo" class="form-control" id="privatInfo"></textarea>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="maxOrdersPerDay">Max Orders Per Day</label>
                        <h6>Please write how much order per day can ordered, when not limit write "999"</h6>
                    <div class="col-sm-8">
                          <input name="maxOrdersPerDay"  min="0" max="999" class="form-control" id="maxOrdersPerDay" type="number" >
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                    <label class="col-sm-2 control-label" for="soldToday">Sold Today</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                          </div>
                          <input name="soldToday" placeholder="0"  min="0" class="form-control" id="soldToday" type="number">
                        </div>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="maxOrdersPerWeek">Max Orders Per Week</label>
                        <h6>Please write how much order per Week can ordered, when not limit write "999"</h6>
                    <div class="col-sm-8">
                          <input name="maxOrdersPerWeek"  min="0" max="999" class="form-control" id="maxOrdersPerWeek" type="number" >
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                    <label class="col-sm-2 control-label" for="soldWeek">Sold Week</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                          </div>
                          <input name="soldWeek" placeholder="0"  min="0"  class="form-control" id="soldWeek" type="number">
                        </div>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">
                    <label class="col-sm-2 control-label" for="maxOrdersTotal">Max Orders Total</label>
                        <h6>How much orders in total  forn article, if dont have limit please write "999"</h6>
                    <div class="col-sm-8">
                          <input name="maxOrdersTotal"  min="0" max="999" placeholder="0" class="form-control" id="maxOrdersTotal" type="number" >
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                    <label class="col-sm-2 control-label" for="soldTotal">Sold Total</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                          </div>
                          <input name="soldTotal" placeholder="0"  min="0"  class="form-control" id="soldTotal" type="number">
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
                          <input name="commission" class="form-control" id="commission" type="number" >
                        </div>
                    </div>
                  </div>

                  <div class="form-group ItemsSpace">

                    <label class="col-sm-2 control-label" for="seller">Seller</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                          <select name="seller" class="form-control" id="seller" required="">
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


<div class="modal fade" id="view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">View Pending Commissions</h4>
</div>
<div class="modal-body">

  <!--  //////////////////tabs////////////////////  -->
    <ul class="nav nav-tabs">
    <li><a href="#ViewPendingC1contac" data-toggle="tab">Contac</a></li>
    <li><a href="#ViewPendingC1address" data-toggle="tab">Address</a></li>
    </ul>
    <!--  //////////////////tabs////////////////////  -->

    <div class="tab-content">
  <!--  //////////////////contac////////////////////  -->
    <div class="tab-pane active" id="ViewPendingC1contac">
         <div class="form-group">
        <label for="name">Name</label>
        <input type="text" readonly=”readonly” id="name" placeholder="Name" class="form-control" />
        </div>

        <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" readonly=”readonly” id="last_name" placeholder="Last Name" class="form-control" />
        </div>

        <div class="form-group">
        <label for="email">Email</label>
        <input type="text" readonly=”readonly” id="email" placeholder="Email" class="form-control" />
       </div>

       <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" readonly=”readonly” id="phone" placeholder="Phone" class="form-control" />
        </div>
      </div>
    <!--  //////////////////address////////////////////  -->
    <div class="tab-pane" id="ViewPendingC1address">

        <div class="form-group">
        <label for="">Country</label>
        <input type="text" id="country" readonly=”readonly” placeholder="Country" class="form-control" />
        </div>

         <div class="form-group">
        <label for="state">State</label>
        <input type="text" id="state" readonly=”readonly” placeholder="State" class="form-control" />
        </div>

         <div class="form-group">
        <label for="city">City</label>
        <input type="text" readonly=”readonly” id="city" placeholder="City" class="form-control" />
        </div>

        <div class="form-group">
        <label for="street">Street</label>
        <input type="text" readonly=”readonly” id="street" placeholder="Street" class="form-control" />
        </div>

        <div class="form-group">
        <label for="address">Address</label>
        <input type="text" readonly=”readonly” id="address" placeholder="Address" class="form-control" />
        </div>

        <div class="form-group">
        <label for="postal_code">Postal Code</label>
        <input type="text" readonly=”readonly” id="postal_code" placeholder="Postal Code" class="form-control" />
        </div>

   </div>
</div>

<!--//////////////////////////////////// -->


</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>


</div>
</div>
</div>

<!-- Bootstrap Modal - To Add New Record -->
<!-- Modal  edit-->
<form id="SavePendingC"  method="post">
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
<h4 class="modal-title" id="myModalLabel">Edit Pending Commission</h4>
</div>
<div class="modal-body">

  <!--  //////////////////tabs////////////////////  -->
    <ul class="nav nav-tabs">
    <li><a href="#editPendingC1contac" data-toggle="tab">Contac</a></li>
    <li><a href="#editPendingC1address" data-toggle="tab">Address</a></li>
    </ul>
    <!--  //////////////////tabs////////////////////  -->

    <div class="tab-content">
  <!--  //////////////////contac////////////////////  -->
    <div class="tab-pane active" id="editPendingC1contac">
         <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" placeholder="Name" class="form-control" />
        </div>

        <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text"  id="last_name" placeholder="Last Name" class="form-control" />
        </div>

        <div class="form-group">
        <label for="email">Email</label>
        <input type="text"  id="email" placeholder="Email" class="form-control" />
       </div>

       <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text"  id="phone" placeholder="Phone" class="form-control" />
        </div>
      </div>
    <!--  //////////////////address////////////////////  -->
    <div class="tab-pane" id="editPendingC1address">

        <div class="form-group">
        <label for="">Country</label>
        <input type="text" id="country" placeholder="Country" class="form-control" />
        </div>

         <div class="form-group">
        <label for="state">State</label>
        <input type="text" id="state" placeholder="State" class="form-control" />
        </div>

         <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" placeholder="City" class="form-control" />
        </div>

        <div class="form-group">
        <label for="street">Street</label>
        <input type="text" id="street" placeholder="Street" class="form-control" />
        </div>

        <div class="form-group">
        <label for="address">Address</label>
        <input type="text"  id="address" placeholder="Address" class="form-control" />
        </div>

        <div class="form-group">
        <label for="postal_code">Postal Code</label>
        <input type="text"  id="postal_code" placeholder="Postal Code" class="form-control" />
        </div>

   </div>
</div>

<!--//////////////////////////////////// -->


</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

<button id="addItens" type="button
"  class="btn btn-primary">Save Template</button>
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
        <section class="content">
            <div id="resultados_ajax"></div>
            <div class="outer_div">
                <div class="row">

                    @include('products.pending.tables.tableCommissions')


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
    $('#view_modal').on('show.bs.modal', function (event) {



      var button = $(event.relatedTarget) // Botón que activó el modal

      var documents = button.data('documents') // Extraer la información de //atributos de datos
     //  alert('Cpostal='+Cpostal);
      var name = button.data('name') // Extraer la información de atributos de datos
     //  alert('city='+city);
     var lastname = button.data('lastname') // Extraer la información de atributos de datos
     //  alert('city='+city);
      var email = button.data('email')
    //  alert('emaillll='+email);
      var phone = button.data('phone')
     // alert('contac_phone='+contac_phone);
     var country = button.data('country')
     // alert('country='+country);
      var state = button.data('state') // Extraer la información de atributos de datos
    //   alert('state='+state);
     var city = button.data('city')
     // alert('country='+country);
      var street = button.data('street') // Extraer la información de atributos de datos
    //  alert('street='+street);

      var address= button.data('address')
     // alert('surname='+surname);
      var postal_code = button.data('postal_code')
     // alert('contac_name='+contac_name);
    var modal = $(this)
      modal.find('.modal-title').text('View Pending Commission: ')
      modal.find('.modal-body #documents').val(documents)
      modal.find('.modal-body #name').val(name)
       modal.find('.modal-body #last_name').val(lastname)
       modal.find('.modal-body #email').val(email)
       modal.find('.modal-body #phone').val(phone)
      modal.find('.modal-body #country').val(country)
      modal.find('.modal-body #city').val(city)
      modal.find('.modal-body #state').val(state)

      modal.find('.modal-body #street').val(street)


      modal.find('.modal-body #address').val(address)
      modal.find('.modal-body #postal_code').val(postal_code)

      $('.alert').hide();//Oculto alert
    })

    $('#edit_modal').on('show.bs.modal', function (event) {

       var button = $(event.relatedTarget) // Botón que activó el modal

      var documents = button.data('documents') // Extraer la información de //atributos de datos
     //  alert('Cpostal='+Cpostal);
      var name = button.data('name') // Extraer la información de atributos de datos
     //  alert('city='+city);
     var lastname = button.data('lastname') // Extraer la información de atributos de datos
     //  alert('city='+city);
      var email = button.data('email')
    //  alert('emaillll='+email);
      var phone = button.data('phone')
     // alert('contac_phone='+contac_phone);
     var country = button.data('country')
     // alert('country='+country);
      var state = button.data('state') // Extraer la información de atributos de datos
    //   alert('state='+state);
     var city = button.data('city')
     // alert('country='+country);
      var street = button.data('street') // Extraer la información de atributos de datos
    //  alert('street='+street);

      var address= button.data('address')
     // alert('surname='+surname);
      var postal_code = button.data('postal_code')
     // alert('contac_name='+contac_name);
    var modal = $(this)
      modal.find('.modal-title').text('View Pending Commission: ')
      modal.find('.modal-body #documents').val(documents)
      modal.find('.modal-body #name').val(name)
       modal.find('.modal-body #last_name').val(lastname)
       modal.find('.modal-body #email').val(email)
       modal.find('.modal-body #phone').val(phone)
      modal.find('.modal-body #country').val(country)
      modal.find('.modal-body #city').val(city)
      modal.find('.modal-body #state').val(state)

      modal.find('.modal-body #street').val(street)


      modal.find('.modal-body #address').val(address)
      modal.find('.modal-body #postal_code').val(postal_code)

      $('.alert').hide();//Oculto alert
    })

    $('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var modal = $(this)
      modal.find('#id_pais').val(id)
    })

  $( "#SavePendingC" ).submit(function( event ) {

    var parametros = $(this).serialize();
     alert('parametros.........'+parametros);
       $.ajax({
          type: "POST",
          url: "/PendingC/Update/Save",
          data: parametros,
           beforeSend: function(objeto){

            },
          success: function(datos){
            $('#edit_modal').modal('hide');
         setTimeout(function(){
                    swal({ title:'Success!',text:"Pending Commission Successfully Save",type:'success'});
                    location.reload();
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
          url: "/PendingC/Update/Save",
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
                          text: " Pending Commission Successfully Removed!",
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
                              url:"/PendingC/destroy",
                              method:"POST",
                              data:{id:id, _token:_token},
                              success:function(result){

                                swal({ title:'Deleted!',text:"Pending Commission Successfully Removed",type:'success'});
                                location.reload();
                              }

                             })
                           } else if(result.dismiss == swal.DismissReason.cancel){

                            swal({ title:'Cancelled',text:"Pending Commission Successfully Not Removed",type:'error'});

                          }
                        })

      });
    </script>

  <script type="text/javascript">

      function addProducts(){
                // get values
                var private = $("#private").val();
                alert('private ='+private);

                var outOfStock = $("#outOfStock").val();
                alert('outOfStock ='+outOfStock);

                var country = $("#country").val();
                alert('country ='+country);

                var pictureinput = $("#pictureinput").val();
                alert('pictureinput ='+pictureinput);

                var keywords = $("#keywords").val();
                alert('keywords ='+keywords);

                var brand = $("#brand").val();
                alert('brand ='+brand);

                var store = $("#store").val();
                alert('store ='+store);

                var asin = $("#asin").val();
                alert('asin ='+asin);

                var coverFees = $("#coverFees").val();
                alert('coverFees ='+coverFees);

                var price= $("#price").val();
                alert('price ='+price);

                var link = $('#link').val();
                alert('link ='+link);

                var conditionRefund = $('#conditionRefund').val();
                alert('conditionRefund ='+conditionRefund);

                var info = $('#info').val();
                alert('info ='+info);

                var privatInfo = $('#privatInfo').val();
                alert('privatInfo ='+privatInfo);

                var maxOrdersPerDay = $('#maxOrdersPerDay').val();
                alert('maxOrdersPerDay ='+maxOrdersPerDay);

                var soldToday = $('#soldToday').val();
                alert('soldToday ='+soldToday);

                var maxOrdersPerWeek = $('#maxOrdersPerWeek').val();
                alert('maxOrdersPerWeek ='+maxOrdersPerWeek);

                var soldWeek = $('#soldWeek').val();
                alert('soldWeek ='+soldWeek);

                var maxOrdersTotal = $('#maxOrdersTotal').val();
                alert('maxOrdersTotal ='+maxOrdersTotal);

                var soldTotal = $('#soldTotal').val();
                alert('soldTotal ='+soldTotal);

                var commission = $('#commission').val();
                alert('commission ='+commission);

                var seller = $('#seller').val();
                alert('seller ='+seller);


                    $.ajax({
                        url:"/PendingC/Update",
                        method:"POST",

                        data:{ private:private, outOfStock:outOfStock, country:country,
                               pictureinput:pictureinput, keywords:keywords, brand:brand, store:store,
                               conditionRefund:conditionRefund, info:info, privatInfo:privatInfo, maxOrdersPerDay:maxOrdersPerDay,
                               soldToday:soldToday, maxOrdersPerWeek:maxOrdersPerWeek, soldWeek:soldWeek, maxOrdersTotal:maxOrdersTotal,
                               soldTotal:soldTotal, commission:commission, seller:seller,
                               asin:asin, coverFees:coverFees, price:price, link:link
                                 },
                        success:function(data, status){
                            alert('gusrdado');
                        //    $('#add_alert').css("display", "block");
                     //       $("#add_new_record_modal").modal("hide");
                     //       setTimeout(function(){
                     //       $('#add_alert').alert('close');
                     //           location.reload();
                    //        },3000);
                        //


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
