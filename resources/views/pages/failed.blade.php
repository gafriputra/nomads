@extends('layouts.success')
@section('title', 'Checkout Success')

@section('content')
<main>
  <div class="section-success d-flex align-items-center">
    <div class="col text-center">
      {{-- <img src="{{ url('frontend/images/ic_mail.png') }}" alt="" /> --}}
      <h1>Opps@</h1>
      <p>
        Your Transaction Is Failed :(
        <br />
        Please contact representative if this problem occurs
      </p>
      <a href="{{ url('/') }}" class="btn btn-home-page mt-3 px-5">
        Home Page
      </a>
    </div>
  </div>
</main>
@endsection
