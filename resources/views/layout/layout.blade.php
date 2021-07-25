<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Library</title>
  <link rel="stylesheet" href={{ asset('css/app.css') }} type="text/css">
  <script defer="defer" src="{{ asset('js/app.js') }}"></script>
</head>
<body>
  @guest 
  @include('components/signup')

  @include('components/signin')

  @include('components/remember')
  @endguest

  {{--@include('components/reset')--}}

  <div class="container">

    @include('components/header')

    @include('components/menu')

    @yield('content')

    @include('components/footer')

  </div>
</body>
</html>