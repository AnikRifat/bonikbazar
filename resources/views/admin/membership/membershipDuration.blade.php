@extends('layouts.admin-master')
@section('title', 'membership duration list')

@section('content')
                <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">{{$membership->name}} membership duration List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            
                            <a href="{{route('membership')}}" class="btn btn-success d-none d-lg-block m-l-15"><i  class="fa fa-arrow-left"></i> Membership list</a>
                            @if($permission['is_add'])
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Set New Duration</button>@endif
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Duration</th>
                                                <th>Price</th>
                                              
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach($get_data as $index => $data)
                                            <tr id="item{{$data->id}}">
                                                <td>{{$index+1}}</td>
                                               
                                                <td>{{$data->duration ." ". $data->type}}</td>
                                                <td>{{ config('siteSetting.currency_symble') }}{{$data->price}}</td>
                                                <!-- <td>{{($data->discount) ? $data->discount : 0}}%</td> -->
                                               
                                                <td>{!!($data->status == 1) ? "<span class='label label-info'>Active</span>" : '<span class="label label-danger">Deactive</span>'!!} 
                                                </td>
                                                <td>@if($permission['is_edit'])
                                                    <button type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>@endif
                                                    @if($permission['is_delete'])
                                                    <button data-target="#delete" onclick="deleteConfirmPopup('{{route('membershipDuration.delete', $data->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>@endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- add Modal -->
        <div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Set Membership Duration</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="{{route('membershipDuration.store')}}" enctype="multipart/form-data" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$membership->id}}" name="membership_id">
                        <div class="modal-body form-row">

                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                     

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name" class="required">Month Duration</label>
                                                <input name="duration" required placeholder="Example: 5" value="{{old('duration')}}" class="form-control" type="number">
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name" class="required">Price</label>
                                                <input name="price" required placeholder="Example: {{ config('siteSetting.currency_symble') }}50 " value="{{old('price')}}" class="form-control" type="number">
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Discount</label>
                                                <input name="discount" value="{{old('discount')}}" class="form-control" placeholder="Example: 10%" type="number">
                                            </div>
                                        </div> -->
                                     
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <span>Status</span>
                                            <div class="head-label">

                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="statusValue">
                                                        <label  class="custom-control-label" for="statusValue">Active/Deactive</label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="modal-footer">
                            <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                            <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('membershipDuration.update')}}"  enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update membership duration</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>

        <!-- delete Modal -->
        @include('admin.modal.delete-modal')

@endsection
@section('js')


    <script type="text/javascript">

      function edit(id){
            $('#edit_form').html('<div class="loadingData"></div>');
            var  url = '{{route("membershipDuration.edit", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                   
                }
            },
            // $ID Error display id name
            @include('common.ajaxError', ['ID' => 'edit_form'])


        });

    }


// if occur error open model
    @if($errors->any())
        $("#{{Session::get('submitType')}}").modal('show');
    @endif
</script>
  


@endsection
