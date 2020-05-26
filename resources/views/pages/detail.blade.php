{{-- konek ke layouts/app --}}
@extends('layouts/app')
{{-- masukkan title --}}
@section('title','Detail Travel')

@section('content')
    <main>
        <section class="section-details-header"></section>
        <section class="section-details-content">
            <div class="container">
                <div class="row">
                <div class="col p-0 pl-3 pl-lg-0"">
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">
                        Paket Travel
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                        Details
                        </li>
                    </ol>
                    </nav>
                </div>
                </div>
                <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                    <h1>{{$item->title}}</h1>
                    <p>
                        {{$item->location}}
                    </p>
                    {{-- dicek apakah ada gambarnya --}}
                    @if ($item->galleries->count())
                        <div class="gallery">
                            {{-- ambil gambar yang pertama --}}
                            <div class="xzoom-container">
                            <img
                                class="xzoom"
                                id="xzoom-default"
                                src="{{Storage::url($item->galleries->last()->image)}}"
                                xoriginal="{{Storage::url($item->galleries->last()->image)}}"
                            />
                            <div class="xzoom-thumbs">
                                @foreach ($item->galleries->skip(1) as $gallery)
                                    <a href="{{Storage::url($gallery->image)}}"
                                    ><img
                                        class="xzoom-gallery"
                                        width="128"
                                        src="{{Storage::url($gallery->image)}}"
                                        xpreview="{{Storage::url($gallery->image)}}"
                                    /></a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                            <h2>Tentang Wisata</h2>
                            <p>
                            {!! $item->about !!}
                            </p>
                            <div class="features row pt-3">
                                <div class="col-md-4">
                                    <img
                                    src="{{url('frontend/images/ic_event.png')}}"
                                    alt=""
                                    class="features-image"
                                    />
                                    <div class="description">
                                    <h3>Featured Ticket</h3>
                                    <p>{{$item->featured_event}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 border-left">
                                    <img
                                    src="{{url('frontend/images/ic_bahasa.png')}}"
                                    alt=""
                                    class="features-image"
                                    />
                                    <div class="description">
                                    <h3>Language</h3>
                                    <p>{{$item->language}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4 border-left">
                                    <img
                                    src="{{url('frontend/images/ic_foods.png')}}"
                                    alt=""
                                    class="features-image"
                                    />
                                    <div class="description">
                                    <h3>Foods</h3>
                                    <p>{{$item->foods}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-details card-right">
                    <h2>Members are going</h2>
                    <div class="members my-2">
                        <img src="{{url('frontend/images/members.png')}}" alt="" class="w-75" />
                    </div>
                    <hr />
                    <h2>Trip Informations</h2>
                    <table class="trip-informations">
                        <tr>
                        <th width="50%">Date of Departure</th>
                        <td width="50%" class="text-right">{{\Carbon\Carbon::create($item->date_of_departure)->format('F n, Y')}}</td>
                        </tr>
                        <tr>
                        <th width="50%">Duration</th>
                        <td width="50%" class="text-right">{{$item->duration}}</td>
                        </tr>
                        <tr>
                        <th width="50%">Type</th>
                        <td width="50%" class="text-right">{{$item->type}}</td>
                        </tr>
                        <tr>
                        <th width="50%">Price</th>
                        <td width="50%" class="text-right">Rp. {{$item->price}},00 / person</td>
                        </tr>
                    </table>
                    </div>
                    <div class="join-container">
                        {{-- hanya diakses jjika sudah login --}}
                        @auth
                        <form action="{{route('checkout-process', $item->id)}}" method="post">
                            @csrf
                            <button class="btn btn-block btn-join-now mt-3 py-2" type="submit">Join Now</button>
                        </form>
                        @endauth
                        {{-- jika belum login --}}
                        @guest

                        {{-- arahkan pakai fungsi route dengan pakai namaroutenya --}}
                        <a href="{{route('login')}}" class="btn btn-block btn-join-now mt-3 py-2"
                            >Login or Register to Join</a
                        >
                        @endguest
                    </div>
                </div>
                </div>
            </div>
        </section>
    </main>
@endsection

{{-- menambahkan style --}}
@push('prepend-style')
    <link rel="stylesheet" href="{{url('frontend/libraries/xzoom/dist/xzoom.css')}}" />
@endpush
{{-- menambah script tambahan --}}
@push('addon-script')
    <script src="{{url('frontend/libraries/xzoom/dist/xzoom.min.js')}}"></script>
    <script>
        $(document).ready(function() {
        $('.xzoom, .xzoom-gallery').xzoom({
            zoomWidth: 500,
            title: false,
            tint: '#333',
            Xoffset: 15
        });
        });
    </script>
@endpush
