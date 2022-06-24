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
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="d-flex justify-content-center">
                    <h2 class="text-black bg-white p-3 text-center rounded">Add Restaurant</h2>
                </div>
                
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{route('addRestaurantProcess')}}" method="POST" class="">
                            @csrf
                            <span class="opac-50">Restaurant Name</span>
                            <input type="text" class="form-control mb-3" name="name">
                            <div class="d-flex justify-content-center mt-7">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection

@section('js1')
@endsection
