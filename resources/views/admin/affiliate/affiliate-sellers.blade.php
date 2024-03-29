@extends('layouts.admin-master')
@section('title', 'Affiliate Sellers')

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
                    <h4 class="text-themecolor">Affiliate Sellers List</h4>
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="margin-bottom: 2px;">

                        <form action="" method="get">

                            <div class="form-body">
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">User</label>
                                                <input type="text" value="{{ Request::get('user')}}" placeholder="User name or Id" name="user" class="form-control">
                                           </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">From Date</label>
                                                <input name="from_date" value="{{ Request::get('from_date')}}" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-6">
                                            <div class="form-group">
                                                <label class="control-label">End Date</label>
                                                <input name="end_date" value="{{ Request::get('end_date')}}" type="date" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-1">
                                            <div class="form-group">
                                               .
                                               <button type="submit" class="form-control btn btn-success"><i style="color:#fff; font-size: 20px;" class="ti-search"></i> </button>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card ">
                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Seller Info</th>
                                            <th>Membership</th>
                                            <th>Amount</th>
                                            <th>Discount</th>
                                            <th>Address</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @foreach($customers as $index => $customer)
                                        <tr id="item{{$customer->id}}">
                                            <td>{{(($customers->perPage() * $customers->currentPage() - $customers->perPage()) + ($index+1) )}}</td>
                                            <td>
                                                {{ Carbon\Carbon::parse($customer->created_at)->format("d M, Y") }}
                                            </td>
                                            <td>
                                                @if($customer->username)
                                                <a title="View Profile" href="{{ route('customer.profile', $customer->username) }}"> 
                                                {{$customer->shop_name}}
                                                </a> <br>
                                                User ID: {{$customer->user_id}} <br>
                                                {{$customer->mobile}} <br/> {{$customer->email}}
                                                @else
                                                User Not Found. @endif
                                            </td> 
                                            <td>{{str_replace("-", " ", $customer->membership)}} 
                                            </td>
                                            <td>{{ config('siteSetting.currency_symble') . $customer->amount }}</td>
                                            <td>{{ config('siteSetting.currency_symble') . $customer->referAmount }}</td>
                                         
                                            <td> {{ $customer->address }} @if($customer->get_city), {{ $customer->get_city->name }} @endif @if($customer->get_state), {{ $customer->get_state->name }} @endif</td>
                                            
                                            <td> @if( $customer->sellerMembership->payment_status == 'paid') <span style="color:green"> Paid </span> @else <span style="color:red">Unpaid</span> @endif</td>

                                            <td> @if($customer->status == 'active') <span style="color:green"> Verified </span> @else <span style="color:red">{{$customer->status}}</span> @endif</td>
                                           
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
               <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                   {{$customers->appends(request()->query())->links()}}
                  </div>
                <div class="col-sm-6 col-md-6 col-lg-6 text-right">Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of total {{$customers->total()}} entries ({{$customers->lastPage()}} Pages)</div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
 

@endsection
