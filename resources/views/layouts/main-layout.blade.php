@extends('layouts.app')

@section('content')
  @include('layouts.inc.header')
  @include('layouts.inc.sidebar')

  <main id="main" class="main">
    @yield('main-content')
  </main>
@endsection