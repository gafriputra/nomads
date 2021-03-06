<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
     <link rel="shortcut icon" href="{{asset('frontend/favicon.ico')}}">
    <title>@yield('title')</title>


    {{-- tambahan style --}}
    @stack('prepend-style')
    {{-- masukkan style --}}
    @include('includes.style')
    {{-- tambahan style --}}
    @stack('addon-style')



  </head>
  <body>
      {{-- masukkan navbar --}}
    @include('includes.navbar-alternate')

    {{-- untuk konten --}}
    @yield('content')

    {{-- masukkan footer --}}
    @include('includes.footer')



    {{-- tambahan sript --}}
    @stack('prepend-script')
   
    {{-- masukkan script --}}
    @include('includes.script')

    {{-- tambahan script --}}
    @stack('addon-script')


    
  </body>
</html>
