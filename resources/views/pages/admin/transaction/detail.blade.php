{{-- mengkoneksikan ke layout/admin --}}
@extends('layouts.admin')

{{-- memasukkan kontent --}}
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Transaksi {{$item->user->name}}</h1>
    </div>

    {{-- nonttifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>                
                @endforeach
            </ul>
        </div>
        
    @endif
   <div class="card shadow">
       <div class="card-body">
           <table class="table table-responsive">
               <tr>
                   <th>ID</th>
                   <td>{{$item->id}}</td>
               </tr>
               <tr>
                   <th>Paket Travel</th>
                   <td>{{$item->travel_package->title}}</td>
               </tr>
               <tr>
                   <th>Pembeli</th>
                   <td>{{$item->user->name}}</td>
               </tr>
               <tr>
                   <th>Additional Visa</th>
                   <td>${{$item->additional_visa}}</td>
               </tr>
               <tr>
                   <th>Total Transaksi</th>
                   <td>${{$item->transaction_total}}</td>
               </tr>
               <tr>
                   <th>Status Transaksi</th>
                   <td>{{$item->transaction_status}}</td>
               </tr>
               <tr>
                   <th>Pembelian</th>
                   <td>
                       <table class="table-bordered">
                           <tr>
                               <th>ID</th>
                               <th>Username</th>
                               <th>Nationality</th>
                               <th>Visa</th>
                               <th>DOE Passport</th>
                           </tr>
                           @foreach ($item->details as $detail)
                           {{$detail->username}}
                            <tr>
                                <td>{{$detail->id}}</td>
                                <td>{{$detail->username}}</td>
                                <td>{{$detail->nationality}}</td>
                                {{-- pakai if ternary --}}
                                <td>{{$detail->is_visa?'30 Days':'N/A'}}</td>
                                <td>{{$detail->doe_passport}}</td>
                            </tr>
                           @endforeach
                       </table>
                   </td>
               </tr>
           </table>
       </div>
   </div>
    
</div>
<!-- /.container-fluid -->
@endsection