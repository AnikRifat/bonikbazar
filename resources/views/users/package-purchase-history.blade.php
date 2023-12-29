@extends('layouts.frontend')
@section('title', 'Package History')
@section('css')

@endsection
@section('content')
	<div class="container bg-white mb-2 px-0">
        @include('users.inc.user_header')
        <div class="row">
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
            <div class="col-12 col-md-3">
                @include('users.inc.sidebar')
            </div>@endif
            <div class="col-12 col-md-9">
				
				@if(Session::has('success'))
                <div class="alert alert-success">
                  <strong>Success! </strong> {{Session::get('success')}}
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger">
                  <strong>Error! </strong> {{Session::get('error')}}
                </div>
                @endif
			
				<form action="{{route('user.packageHistory')}}" id="orerControll" method="get" class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <input name="package" value="{{ Request::get('package')}}" type="text" placeholder="package name" class="form-control mr-md-2">
                        <select name="status" class="form-control mr-md-2">
                            <option value="">Select Status</option>
                            <option value="pending" {{ (Request::get('status') == 'pending') ? 'selected' : ''}} >Pending</option>
                            <option value="received" {{ (Request::get('status') == 'received') ? 'selected' : ''}}>Received</option>
                            <option value="paid" {{ (Request::get('status') == 'paid') ? 'selected' : ''}}>Paid</option>
                            <option value="all" {{ (Request::get('status') == "all") ? 'selected' : ''}}>All</option>
                        </select>
                       <button type="submit" class="form-control btn btn-success">Search </button>
                    </div>
                </form>
		       
				<div class="table-responsive">
                    <table class="table display table-bordered ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th style="min-width: 100px;">Package</th>
                               
                                <th>Ad & Category</th>
                                <!-- <th>Post</th> -->
                                <th>Duration</th>
                                <th>Price</th>
                               
                                <th>Pay_method</th>
                                <th>Payment</th>
                                <!-- <th>Promote</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($orders)>0)
                                @foreach($orders as $index => $order)
                                @php $total_price = $order->price @endphp
                                <tr id="{{$order->order_id}}" @if($order->order_status == 'cancel') style="background:#ff000026" @endif >
                                    <td>{{(($orders->perPage() * $orders->currentPage() - $orders->perPage()) + ($index+1) )}}</td>
                                    <td>@if($order->package_id == 'post_fee') Ad post fee @else @if($order->get_package) <img width="30" src="{{asset('upload/images/package/'.$order->get_package->ribbon)}}">  {{ $order->get_package->name }} @endif
                                       <p style="font-size: 12px;margin: 0;padding: 0"> {{\Carbon\Carbon::parse($order->order_date)->format(Config::get('siteSetting.date_format'))}}<br/>
                                    {{\Carbon\Carbon::parse($order->order_date)->format('h:i:s A')}}</p> @endif
                                    </td>
                                    <td>
                                        @if($order->get_boostAd)
                                        <a target="_blank" href="{{ route('post_details', $order->get_boostAd->slug) }}"> {{Str::limit($order->get_boostAd->title, 40)}}</a> <br/>

                                        @else  Ad Not found  <br/> @endif
                                        {{($order->get_category) ? $order->get_category->name : '.' }}</td>
                                   
                                    <td>{{$order->duration}} days</td>
                                    <td>
                                        {{$order->currency_sign}}{{$total_price }}
                                        
                                    </td>
                                   
                                    <td>{{ str_replace( '-', ' ', $order->payment_method) }}</td>
                                    <td> <span class="badge badge-{{($order->payment_status=='pending') ? 'danger' : 'success' }}">{{$order->payment_status}}</span></td>
                                    <!-- <td>
                                    @if($order->get_package)
                                    <a href="{{route('ads.promoteHistory', $order->get_package->slug)}}">History</a> @endif</td> -->
                                </tr>
                               @endforeach
                            @else <tr><td colspan="8"> <h1>No package found.</h1></td></tr> @endif
                        </tbody>
                    </table>
                </div>

			</div>
			<!--Middle Part End-->
		</div>
	</div>
	
@endsection		
@section('js')
   	<script src="{{asset('assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

     <script>
    // responsive table
        $('#config-table').DataTable({
            responsive: true,
            ordering: false
        });
    </script>
@endsection		


