@php
  $user = Auth::user();
 // dd($user);
@endphp
<div class="col-md-15" style="width: 100% !important;">

                        <div class="box box-class" style="padding-left: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;
                        padding-top: 0px !important;">

                            <div></div>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="panel panel-bordered">
                                    <div class="panel-body">
                                           <table id="datatable" class="table-striped table-bordered dt-responsive nowrap">
                                                    
                                                <thead>

                                                        <tr>
                                                            <th>Reserva</th>
                                                            <th>Codigo</th>
                                                            <th>Imagen</th>
                                                            <th>Descripcion</th>
                                                            <th>Departamento</th>                                                        
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                            @foreach($Products as $key => $Product)

                                                            @if ($Product->C_CODIGO)

                                                                        <tr>

                                                                            <td>
                                                                                <a id="ViewProductsReserva" class=" btn btn-circle btn-primary" role="menuitem" tabindex="-1" href="#ViewProductsReserva{{ $Product->C_CODIGO }}" data-toggle="modal" data-target="#ViewProductsReserva"
                                                                                data-c_codigo="<?php echo $Product->C_CODIGO?>" data-c_descri="<?php echo $Product->C_DESCRI?>"
                                                                                data-c_departamento="<?php echo $Product->c_departamento?>" data-imagen="<?php echo $Product->C_CODIGO?>" ><i class="voyager-basket"></i></a>
                                                                            </td>
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
