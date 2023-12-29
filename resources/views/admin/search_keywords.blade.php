@extends('layouts.admin-master')
@section('title', 'Search keywords list')

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
                    <h4 class="text-themecolor">Search keywords list</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Search keywords</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        
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
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Keywords</th>
                                            <th>User IP</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach($search_keywords as $index => $search_keyword)
                                        <tr id="item{{$search_keyword->id}}">
                                            <td>{{(($search_keywords->perPage() * $search_keywords->currentPage() - $search_keywords->perPage()) + ($index+1) )}}</td>
                                            <td>{{$search_keyword->keyword}}</td>
                                            <td>{{$search_keyword->user_ip_address}}</td>
                                            <td>{{Carbon\Carbon::parse($search_keyword->created_at)->format("d M y, h:i a")}}</td>
                                            <td>
                                                <button data-target="#delete" onclick="deleteConfirmPopup('{{route("searchKeywordDelete", $search_keyword->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{$search_keywords->links()}}
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


    <!-- delete Modal -->
    @include('admin.modal.delete-modal')
@endsection

