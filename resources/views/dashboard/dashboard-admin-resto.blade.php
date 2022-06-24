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

        <div class="container ">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('dashboardPage') }}"
                            class="btn {{ set_active_button('dashboardPage') }}">Schedule</a>
                        <a href="{{ route('dashboardRestoPage') }}"
                            class="btn {{ set_active_button('dashboardRestoPage') }}">Restaurant List</a>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col-12">
                            <h3 class="text-center">Restaurant List</h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $page = app('request')->input('page');
                                            if (!$page) {
                                                $page = 1;
                                            }
                                            $idx = 1 + ($page - 1) * 10;
                                        @endphp
                                        @foreach ($resto as $item)
                                            <tr>

                                                <td>{{ $idx }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                            @php
                                                $idx++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center mt-3 mb-4">
                                {{ $resto->links() }}
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
