@extends('layouts.app')
<!-- © 2020 Copyright: Tahu Coding -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card" style="min-height: 85vh">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col"><h4 class="font-weight-bold">Report / Laporan Transaksi</h4></div>
                    <div class="col"><a class="btn btn-primary float-right btn-sm" onclick="window.print()"><i class="fas fa-print"></i> Print</a>
                        <a href="{{ URL::previous() }}" class="btn btn-success float-right btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
                    </div>
                    </div>                 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                              <table width="100%" class="table table-borderless">
                                <tr>
                                    <td width="38%" class="font-weight-bold">Invoices Number</td>
                                    <td width="2%" class="font-weight-bold">:</td>
                                    <td width="60%" class="font-weight-bold">{{$transaction->invoices_number}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Admin</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$transaction->user->name}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Create At</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$transaction->created_at}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table width="100%" class="table table-borderless">
                                <tr>
                                    <td width="38%">Pay</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$transaction->pay}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Total</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$transaction->total}}</td>
                                </tr>   
                                <tr>
                                    <td width="38%">Customer</td>
                                    <td width="2%">:</td>
                                    <td width="60%">Take Away Customer</td>
                                </tr>                   
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                     @foreach ($transaction->productTransaction as $index=>$item)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$item->product->name}}</td>
                                            <td>{{$item->qty}}</td>
                                        </tr>
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
@endsection