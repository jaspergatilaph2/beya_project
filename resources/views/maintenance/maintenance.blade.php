@extends('layouts.app')
@section('content')
<div class="container-xxl container-p-y d-flex flex-column align-items-center justify-content-center text-center" style="height: 100vh;">
  <div class="misc-wrapper">
    <h2 class="mb-2 mx-2">Under Developing!</h2>
    <p class="mb-4 mx-2">Sorry for the inconvenience but we're performing some developing at the moment</p>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to home</a>
    <div class="mt-4">
      <img
        src="{{ asset('sneat/img/illustrations/girl-doing-yoga-light.png') }}"
        alt="girl-doing-yoga-light"
        width="500"
        class="img-fluid"
        data-app-dark-img="illustrations/girl-doing-yoga-dark.png"
        data-app-light-img="illustrations/girl-doing-yoga-light.png"
      />
    </div>
  </div>
</div>

    <!-- /Under Maintenance -->
@endsection