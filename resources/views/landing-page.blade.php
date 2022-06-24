@extends('welcome')

@section('css')
    <style>
        @font-face {
            font-family: Anydore;
            src: url('{{ asset('font/anydore.otf') }}')
        }

        .logo {
            font-family: Anydore;
            color: goldenrod
        }

        .bg-lp {
            background: #DAA52010;
        }

        .banner {
            min-height: 400px;
            background-image: linear-gradient(to left, #DAA52010, white)
        }

        .img-banner {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-top-left-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        .banner-text {
            color: #c48d04;
            font-weight: 600;

        }

        .data-list th {
            color: #c48d04;
        }

        .data-list .number {
            color: goldenrod;
            font-weight: 600;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            background: #DAA52044;

        }

        .footer {
            margin-top: 45px;
            width: 100%;
            background-color: white;

            text-align: center;
        }

        .btn-nav {
            color: white;
            border: 0;
            background: #c48d04;
            padding: 8px 25px !important;
        }

        .resto-filter .form-select,
        .resto-filter .form-control {
            outline-color: transparent;
            border: 2px solid goldenrod;
            color: #c48d04;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">

                <a class="navbar-brand" href="{{ route('dashboardPage') }}">
                    <h1 class="logo">Restaurante</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link btn btn-primary btn-nav" aria-current="page"
                            href="{{ route('loginPage') }}">Login</a>


                    </div>
                </div>


            </div>
        </nav>

    </div>
    <div class="bg-lp min-vh-100 d-flex flex-column justify-content-between">
        <div>
            <div class="banner ">

                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-5 col-md-6 col-12 order-2 order-md-1">
                        <div class="ms-lg-5 ms-md-1 ms-1">
                            <h2 class="banner-text">Best Restaurant List For Your Needs.</h2>
                            <p>Everything that you need to know is here.</p>
                        </div>

                    </div>
                    <div class="col-lg-6 col-md-6 col-12 order-1 order-md-2 mb-3 mb-md-0">
                        <img src="{{ asset('images/dl-banner.jpg') }}" alt="" class="img-banner">
                    </div>
                </div>

            </div>
            <div class="container mt-5">
                <div class="card border-0 ">
                    <div class="card-body">
                        <h3 class="text-center logo">Restaurant List</h3>
                        <form action="" class="mt-3 mb-4 resto-filter">
                            <div class="row align-items-end">
                                <div class="col-lg-3 col-md-4 mb-3">
                                    <span class="banner-text">Restaurant Name</span>
                                    <select name="resto_id" id="" class="form-select">
                                        <option value="" selected disabled>Select Name</option>
                                        @foreach ($resto as $item)
                                            @if (app('request')->input('resto_id') == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-4 mb-3">
                                    <span class="banner-text">Restaurant Date</span>
                                    <input type="date" name="date" class="form-control" value="{{app('request')->input('date')}}">
                                </div>
                                <div class="col-lg-2 col-md-4 mb-3">
                                    <span class="banner-text">Open Hours</span>
                                    <input type="time" name="time" class="form-control" value="{{app('request')->input('time')}}">
                                </div>
                                <div class="col-lg-3 col-0">

                                </div>
                                <div class="col-lg-2 col-12 mb-3">
                                    <button class="btn btn-primary btn-nav w-100">Filter</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive data-list">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Restaurant Name</th>
                                        <th scope="col">Opened Days</th>
                                        <th scope="col">Opened Hours</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $page = app('request')->input('page');
                                        if (!$page) {
                                            $page = 1;
                                        }
                                        $idx1 = 1 + +($page - 1) * 10;
                                    @endphp
                                    @foreach ($schedule as $item)
                                        <tr>

                                            <td class="number">{{ $idx1 }}</td>
                                            <td>{{ $item->resto_name }}</td>
                                            <td>{{ daysTranslator($item->start_day) . '-' . daysTranslator($item->end_day) }}
                                            </td>
                                            <td>{{ hoursOpenTranslator($item->start_time) . '-' . hoursOpenTranslator($item->end_time) }}
                                            </td>
                                        </tr>
                                        @php
                                            $idx1++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @if (count($schedule) == 0)
                                
                                <h1 class="text-center logo">Sorry, There is no restaurant open !</h1>

                            @endif
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $schedule->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer shadow">
            <div class="container">
                <h6 class="my-3">Made with <span class="banner-text">Laravel</span></h6>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
