{{-- mengkoneksikan ke layout/admin --}}
@extends('layouts.admin')

{{-- memasukkan kontent --}}
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Gallery {{$item->title}}</h1>
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
           <form action="{{route('gallery.update',$item->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                 <div class="form-group">
                    <label for="travel_packages_id">Paket Travel</label>
                    <select name="travel_packages_id" id="" class="form-control" >
                        @foreach ($travel_packages as $travel_package)
                            @if ($travel_package->id == $item->travel_packages_id)
                                <option value="{{$travel_package->id}}" selected>{{$travel_package->title}}</option>
                            @else   
                                <option value="{{$travel_package->id}}">{{$travel_package->title}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    Update
                </button>
            </form>
       </div>
   </div>
    
</div>
<!-- /.container-fluid -->
@endsection