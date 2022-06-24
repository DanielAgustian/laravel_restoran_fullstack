@extends('welcome')

@section('css')
    @yield('css1')
@endsection

@section('content')
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">

                <a class="navbar-brand" href="{{ route('dashboardPage') }}">Dashboard Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link {{ set_active_bar('addRestaurantPage') }}" aria-current="page"
                            href="{{ route('addRestaurantPage') }}">Add Restoran</a>
                        <a class="nav-link {{ set_active_bar('addSchedulePage') }}"
                            href="{{ route('addSchedulePage') }}">Add Schedule</a>

                    </div>
                </div>


            </div>
        </nav>
        @yield('content1')
    </div>
@endsection

@section('js')
    @yield('js1')
@endsection
