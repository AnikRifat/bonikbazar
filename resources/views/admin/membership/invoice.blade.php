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
                <div class="card card-body printableArea">
                    
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
                                    @if($membership->user)
                                    {{ $membership->user->name }}
                                    @if($membership->user->email)<br>{{$membership->user->email}}@endif
                                    @if($membership->user->mobile)<br>{{$membership->user->mobile}}@endif
                                   @else
                                   User not found. @endif
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                <strong>Invoice ID:</strong> #{{$membership->order_id}} <br>
                                <b>Date:</b> {{Carbon\Carbon::parse($membership->start_date)->format('M d, Y')}}<br>
                                <b>Payment Status:</b> {{str_replace( '-', ' ', ucfirst($membership->payment_status)) }}
                                
                                </address>
                            </div>
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;overflow: hidden;">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Membership Name</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        
                                        <tr id="item{{$membership->id}}">
                                            
                                            <td>{{str_replace("-", " ", ucfirst($membership->membership))}} </td>
                                             <td>Start: {{Carbon\Carbon::parse($membership->start_date)->format("d M, Y")}} <br/>
                                                End: {{Carbon\Carbon::parse($membership->end_date)->format("d M, Y")}}
                                            </td>
                                            <td>{{$membership->duration}} Month</td>
                                             <td>{{ config("siteSetting.currency_symble"). $membership->amount}}</td>
                                            <td>{{ $membership->payment_method }} 
                                                

                                            </td>
                                            <td> {{$membership->status}}</td>
                                           
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
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
                                    @if($membership->user)
                                    {{ $membership->user->name }}
                                    @if($membership->user->email)<br>{{$membership->user->email}}@endif
                                    @if($membership->user->mobile)<br>{{$membership->user->mobile}}@endif
                                   @else
                                   User not found. @endif
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                <strong>Invoice ID:</strong> #{{$membership->order_id}} <br>
                                <b>Date:</b> {{Carbon\Carbon::parse($membership->start_date)->format('M d, Y')}}<br>
                                <b>Payment Status:</b> {{str_replace( '-', ' ', ucfirst($membership->payment_status)) }}
                                
                                </address>
                            </div>
                        </div>                    
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;overflow: hidden;">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Membership Name</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                            <th>Amount</th>
                                            <th>Payment</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        
                                        <tr id="item{{$membership->id}}">
                                            
                                            <td>{{str_replace("-", " ", ucfirst($membership->membership))}} </td>
                                             <td>Start: {{Carbon\Carbon::parse($membership->start_date)->format("d M, Y")}} <br/>
                                                End: {{Carbon\Carbon::parse($membership->end_date)->format("d M, Y")}}
                                            </td>
                                            <td>{{$membership->duration}} Month</td>
                                             <td>{{ config("siteSetting.currency_symble"). $membership->amount}}</td>
                                            <td>{{ $membership->payment_method }} 
                                                

                                            </td>
                                            <td> {{$membership->status}}</td>
                                           
                                        </tr>
                                      
                                    </tbody>
                                </table>
                            </div>
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