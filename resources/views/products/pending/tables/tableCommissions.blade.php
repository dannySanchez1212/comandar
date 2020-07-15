<div class="col-md-20" style="max-width:100% !important;">

    <div class="box box-class">

        <div></div>
        <div class="box-body"  style="display: flex;justify-content: center;">

            <div class="col-md-12" style="width: 100%;font-size: 0px !important;">
                <div class="panel panel-bordered">
                <div class="panel-body">
                             <table id="dataTables" class="table table-hover dataTable no-footer" role="grid" aria-describedby="dataTable_info">
                               <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label=" Name : activate to sort column ascending" style="width: 50px;">Id Article</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 200px;">Article</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 150px;">Order Id</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Paypal Buyer</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Commission Agent</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Commission Agent Refunded</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Refund</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Created</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Created By</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Modified</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Modified By</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="symbol : activate to sort column ascending" style="width: 100px;">Action</th>

                                    </tr>
                                </thead>
                                <tbody>



                                        @foreach($Products as $key => $Product)

                                        @if ($Product->id)
                                                    <tr>
                                                        <td>{{ $Product->id }}</td>
                                                        <td>{{ $Product->country_id }}</td>
                                                        <td>{{ $Product->picture }}</td>
                                                        <td>{{ $Product->keywords }}</td>
                                                        <td>{{ $Product->brand }}</td>
                                                        <td>{{ $Product->store }}</td>
                                                        <td>{{ $Product->asin }}</td>
                                                        <td>{{ $Product->cover_fees }}</td>
                                                        <td>{{ $Product->price }}</td>
                                                        <td>{{ $Product->condition_refund }}</td>
                                                        <td>{{ $Product->link }}</td>

                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-info btn-xs dropdown-toggle" id="menu1" type="button" data-toggle="dropdown">Options
                                                                <span class="caret"></span></button>

                                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

                                                                        <li role="presentation"><a class=" btn btn-primary" role="menuitem" tabindex="-1" href="#ViewProducts{{ $Product->id }}" data-toggle="modal" data-target="#view_modal"
                                                                    data-id="<?php echo $Product->id?>" ><i class="voyager-plus"></i>View</a></li>

                                                                        <li role="presentation"><a class="btn btn-success" role="menuitem" tabindex="-1" href="#UpdateProducts{{ $Product->id }}" data-toggle="modal" data-target="#edit_modal"
                                                                    data-id="<?php echo $Product->id?>" ><i class="voyager-plus"></i>Edit</a></li>

                                                                        <li role="presentation"><a class="btn btn-danger" role="menuitem" tabindex="-1"
                                                                            name="{{  $Product->id }}" href="#" id="boton"><i class="voyager-plus"></i>Delete</a></li>

                                                                    </ul>
                                                            </div>

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
