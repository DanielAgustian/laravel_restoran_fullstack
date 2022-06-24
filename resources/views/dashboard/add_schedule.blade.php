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
                    <h2 class="text-black bg-white p-3 text-center rounded">Add Restaurant Schedule</h2>
                </div>
                
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{route('addScheduleProcess')}}" method="POST" class="">
                            @csrf
                            <span class="opac-50">Choose Restaurant</span>
                            <select name="restoran_id" id="" class="form-select w-100 mb-3" required>
                                @foreach ($restoran as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option> 
                                @endforeach
                            </select>
                            <div class="row ">
                                <div class="col-md-6  mb-3">
                                    <span class="opac-50">Start Day</span>
                                    <select name="start_day" id="" class="form-select w-100" required>
                                        @for ($i = 0; $i < count($days); $i++)
                                            <option value="{{$i}}">{{$days[$i]}}</option>
                                        @endfor
                                    </select>
                                </div>
                               
                                <div class="col-md-6  mb-3">
                                    <span class="opac-50">End Day</span>
                                    <select name="end_day" id="" class="form-select w-100" required>
                                        @for ($i = 0; $i < count($days); $i++)
                                            <option value="{{$i}}">{{$days[$i]}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="opac-50">Open Hour</span>
                                    <input type="time" class="form-control" name="start_time" required placeholder="ex. 12:30">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <span class="opac-50">Closing Hour</span>
                                    <input type="time" class="form-control" name="end_time" required placeholder="ex. 17:30">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-center mt-4">
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
