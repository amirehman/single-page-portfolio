<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @include ('layouts.head')


</head>

<body>


      <div id="app">
        <app-home></app-home>
      </div>


    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
  </div>
</body>

</html>
