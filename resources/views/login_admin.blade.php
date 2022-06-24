@extends('welcome')

@section('css')
    <style>
        .style-card{
            min-width: 60%;
        }
        .bg-auth{
            background-image: url("{{asset('images/nightsky.jpg')}}");
        }
    </style>
@endsection

@section('content')
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center bg-auth" >
        <h2 class="text-white font-weight-bold">Admin Login</h2>
        <div class="row w-100 justify-content-center">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="card" >
                    <div class="card-body">
                        <form action="{{route('loginProcess')}}" method="POST">
                            @csrf
                            <span class="opac-50">Username</span>
                            <input type="email" class="form-control mb-3" name="email">
                            <span class="opac-50">Password</span>
                            <input type="password" class="form-control mb-3" name="password">
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

@section('js')
    
@endsection