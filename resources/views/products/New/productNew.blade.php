@php
  $user = Auth::user();
  //dd($user);

@endphp
<div class="col-md-15" style="width: 100% !important;">

                        <div class="box box-class" style="padding-left: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;
                        padding-top: 0px !important;">

                            <div></div>
                            <div class="box-body"  style="display: flex;justify-content: center;">

                                <div class="col-md-12" style="width: 100%;padding-left: 0px; padding-right: 0px;">
                                    <div class="panel panel-bordered" style="margin-bottom: 0px; padding-bottom: 0px;">
                                    <div class="panel-body" style="padding-top: 5px; margin-top: 0px; padding-right: 0px; padding-left: 0px;padding-bottom: 0px;">

                                         <table id="datatable" class="table-striped table-bordered dt-responsive nowrap">
                                               <thead>
                                                            <th>Codigo</th>
                                                            <th>Imagen</th>
                                                            <th>Descripcion</th>
                                                            <th>Departamento</th>                                                              
                                                            <th >Action</th> 
                                                          
                                                </thead>
                                                <tbody>

                                                    
                                                @foreach($Products as $key => $Product)

@if ($Product->C_CODIGO)

            <tr>

               
                <td tabindex="-1" href="#ViewProducts{{ $Product->C_CODIGO }}" data-toggle="modal" data-target="#view_modal"
                    data-c_codigo="<?php echo $Product->C_CODIGO?>" data-c_descri="<?php echo $Product->C_DESCRI?>"
                    data-c_departamento="<?php echo $Product->c_departamento?>" data-imagen="<?php echo $Product->C_CODIGO?>"
                    >{{ $Product->C_CODIGO }}</td>
                <td tabindex="-1" href="#ViewProducts{{ $Product->C_CODIGO }}" data-toggle="modal" data-target="#view_modal"
                    data-c_codigo="<?php echo $Product->C_CODIGO?>" data-c_descri="<?php echo $Product->C_DESCRI?>"
                    data-c_departamento="<?php echo $Product->c_departamento?>" data-imagen="<?php echo $Product->C_CODIGO?>">
                    <img src="{{ url('/') }}/{{ $Product->c_fileimagen }}" alt="" style="width: 40px;">
                    </td>
                <td tabindex="-1" href="#ViewProducts{{ $Product->C_CODIGO }}" data-toggle="modal" data-target="#view_modal"
                    data-c_codigo="<?php echo $Product->C_CODIGO?>" data-c_descri="<?php echo $Product->C_DESCRI?>"
                    data-c_departamento="<?php echo $Product->c_departamento?>" data-imagen="<?php echo $Product->C_CODIGO?>">
                    {{ $Product->C_DESCRI }}</td>
              
                <td tabindex="-1" href="#ViewProducts{{ $Product->C_CODIGO }}" data-toggle="modal" data-target="#view_modal"
                data-c_codigo="<?php echo $Product->C_CODIGO?>" data-c_descri="<?php echo $Product->C_DESCRI?>"
                    data-c_departamento="<?php echo $Product->c_departamento?>" data-imagen="<?php echo $Product->C_CODIGO?>">
                    {{ $Product->c_departamento }}</td>

                
                    <td>


<!--
<a class=" btn btn-circle btn-primary" role="menuitem" tabindex="-1" href="#ViewProducts{{ $Product->C_CODIGO }}" data-toggle="modal" data-target="#view_modal"
data-id="<?php echo $Product->C_CODIGO?>" ><i class="voyager-basket"></i></a>
-->
@if ($user->role_id==1)
<a class="btn btn-circle btn-success" role="menuitem" tabindex="-1" href="#ViewProducts{{ $Product->C_CODIGO }}" data-toggle="modal" data-target="#view_modal"
                data-c_codigo="<?php echo $Product->C_CODIGO?>" data-c_descri="<?php echo $Product->C_DESCRI?>"
                    data-c_departamento="<?php echo $Product->c_departamento?>" data-imagen="<?php echo $Product->C_CODIGO?>"><i class="voyager-edit"></i></a>



@endif

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
                            </div>

                        </div>

                </div>
