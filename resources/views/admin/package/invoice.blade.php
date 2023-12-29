@extends('layouts.admin-master')
@section('title', 'Invoice ')
@section('css')
<style type="text/css">
    b, strong { font-weight: 700;}

</style>
@endsection
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
                    <h4 class="text-themecolor">Invoice</h4>
                </div>
              
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
           
            <div class="container">
                <div class="card card-body printableArea" style="position: relative;">
                   
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="pull-left" style="float: left;">
                                <div style="width:160px; height: 55px;">
                                    <img style="height: 100%; width: 100%;" src="{{asset('upload/images/logo/'.(Config::get('siteSetting.invoice_logo') ? Config::get('siteSetting.invoice_logo'): Config::get('siteSetting.logo')))}}" title="Home" alt="Logo">
                                </div>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                {{Config::get('siteSetting.address')}}<br/>
                                Phone: {{Config::get('siteSetting.phone')}}<br/>
                                Email: {{Config::get('siteSetting.email')}}
                                </address>
                            </div>
                             <hr>
                        </div>
                       
                        <div class="col-md-12">

                            <div class="pull-left" style="float: left;max-width: 60%">
                                <address>
                                    {{ $packages[0]->customer->name }}
                                    @if($packages[0]->customer->email)<br>{{$packages[0]->customer->email}}@endif
                                    @if($packages[0]->customer->mobile)<br>{{$packages[0]->customer->mobile}}@endif
                                   
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                <strong>Invoice ID:</strong> #{{$packages[0]->order_id}} <br>
                                <b>Date:</b> {{Carbon\Carbon::parse($packages[0]->order_date)->format('M d, Y')}}<br>
                                <b>Payment Status:</b> {{str_replace( '-', ' ',$packages[0]->payment_status) }}
                                
                                </address>
                            </div>
                        </div>
                       
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                           
                                <table class="table table-borders">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Package</th>
                                        <th>Duration</th>
                                        
                                        <th>Payment by</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total_amount = 0; @endphp
                                    @foreach($packages as $index => $package)
                                        @php $total_amount = $total_amount+$package->price; @endphp
                                        <tr>
                                            <td>{{$index+1}}</td>
                                           <td>
                                            @if($package->package_id == 'post_fee') Ad post fee @else
                                             {{ $package->get_package->name }}
                                             @endif
                                            </td>
                                            <td>{{$package->duration}} days</td>
                                            
                                            <td class ="payment-method"> 
                                                {{ str_replace( '-', ' ', $package->payment_method) }}
                                            </td>
                                            <td>
                                                {{$package->payment_status}} 
                                            </td>
                                            <td>
                                                {{config("siteSetting.currency_symble").$package->price}}
                                            </td>
                                        </tr>
                                       @endforeach
                                       <tr><td colspan="5" style="text-align: right;"><strong>Total</strong></td><td>{{ config("siteSetting.currency_symble").$total_amount }}</td></tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>

                    <p style="border: 1px dotted #979797;width: 100%;"></p>

                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="pull-left" style="float: left;">
                                <div style="width:160px; height: 55px;">
                                    <img style="height: 100%; width: 100%;" src="{{asset('upload/images/logo/'.(Config::get('siteSetting.invoice_logo') ? Config::get('siteSetting.invoice_logo'): Config::get('siteSetting.logo')))}}" title="Home" alt="Logo">
                                </div>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                {{Config::get('siteSetting.address')}}<br/>
                                Phone: {{Config::get('siteSetting.phone')}}<br/>
                                Email: {{Config::get('siteSetting.email')}}
                                </address>
                            </div>
                             <hr>
                        </div>
                       
                        <div class="col-md-12">

                            <div class="pull-left" style="float: left;max-width: 60%">
                                <address>
                                    {{ $packages[0]->customer->name }}
                                    @if($packages[0]->customer->email)<br>{{$packages[0]->customer->email}}@endif
                                    @if($packages[0]->customer->mobile)<br>{{$packages[0]->customer->mobile}}@endif
                                   
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                <strong>Invoice ID:</strong> #{{$packages[0]->order_id}} <br>
                                <b>Date:</b> {{Carbon\Carbon::parse($packages[0]->order_date)->format('M d, Y')}}<br>
                                <b>Payment Status:</b> {{str_replace( '-', ' ',$packages[0]->payment_status) }}
                                
                                </address>
                            </div>
                        </div>
                       
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                           
                                <table class="table table-borders">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Package</th>
                                        <th>Duration</th>
                                        
                                        <th>Payment by</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total_amount = 0; @endphp
                                    @foreach($packages as $index => $package)
                                        @php $total_amount = $total_amount+$package->price; @endphp
                                        <tr>
                                            <td>{{$index+1}}</td>
                                           <td>
                                            @if($package->package_id == 'post_fee') Ad post fee @else
                                             {{ $package->get_package->name }}
                                             @endif
                                            </td>
                                            <td>{{$package->duration}} days</td>
                                            
                                            <td class ="payment-method"> 
                                                {{ str_replace( '-', ' ', $package->payment_method) }}
                                            </td>
                                            <td>
                                                {{$package->payment_status}} 
                                            </td>
                                            <td>
                                                {{ config("siteSetting.currency_symble"). $package->price}}
                                            </td>
                                        </tr>
                                       @endforeach
                                       <tr><td colspan="5" style="text-align: right;"><strong>Total</strong></td><td>{{ config("siteSetting.currency_symble").$total_amount }}</td></tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
                <div class="text-right no-print">
                  
                    <button id="print" class="btn btn-success btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                   
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection

@section('js')
    <script src="{{asset('js/pages/jquery.PrintArea.js')}}" type="text/JavaScript"></script>
    <script>
    $(document).ready(function() {
        $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });

    </script>
@endsection