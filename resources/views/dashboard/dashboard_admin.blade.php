@extends('master-dashboard')

@section('css1')
    <style>
        .bg-form {

            background-image: url("{{ asset('images/restaurant.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
@endsection

@section('content1')
    <div class="d-flex flex-column min-vh-100 justify-content-center bg-form">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('dashboardPage') }}"
                            class="btn mr-3 {{ set_active_button('dashboardPage') }}">Schedule List</a>
                        <a href="{{ route('dashboardRestoPage') }}"
                            class="btn {{ set_active_button('dashboardRestoPage') }}">Restaurant List</a>
                    </div>
                    <div class="row align-items-center">

                        <div class="col-12 mt-4">
                            <h3 class="text-center">Schedule List</h3>
                            <div class="table-responsive">
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
                                            $idx1 = 1 + + ($page - 1) * 10;
                                        @endphp
                                        @foreach ($schedule as $item)
                                            <tr>

                                                <td>{{ $idx1 }}</td>
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
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{$schedule->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js1')
@endsection
