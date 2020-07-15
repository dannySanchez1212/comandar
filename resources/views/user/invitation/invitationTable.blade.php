@php
  $user = Auth::user();
 // dd($user);
@endphp
<div class="col-md-15" style="width: 100% !important;">

                        <div class="box box-class" style="padding-left: 0px !important;padding-right: 0px !important;padding-bottom: 0px !important;
                        padding-top: 0px !important;">

                            <div></div>
                            <div class="box-body"  style="display: flex;justify-content: center;">

                                <div class="col-md-12" style="width: 100%;padding-left: 0px; padding-right: 0px;">
                                    <div class="panel panel-bordered" style="margin-bottom: 0px; padding-bottom: 0px;">
                                    <div class="panel-body" style="padding-top: 5px; margin-top: 0px; padding-right: 0px; padding-left: 0px;padding-bottom: 0px;">


                                        @if (!empty($invitations))

                                           <table id="dataTabless" class="table table-striped table-bordered dt-responsive nowrap">

                                                <thead>

                                                        <tr>
                                                            <th >Id Article</th>
                                                            <th >Email</th>

                                                            <th >Invitation Link</th>

                                                            <th >registered_at</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                            @foreach($invitations as $key => $invitation)

                                                                        <tr>
                                                                            <td >{{ $invitation->id }}</td>
                                                                            <td >{{ $invitation->email }}</td>
                                                                            <td >
                                                                                <kbd> {{ $invitation->getLink() }} </kbd>
                                                                            </td>
                                                                            <td >{{ $invitation->registered_at }}</td>
                                                                        </tr>


                                                            @endforeach
                                                    </tbody>
                                            </table>
                                        @endif

                                        </div>
                                    </div>
                                </div>

                            </div>
                            </div>

                        </div>

                </div>
