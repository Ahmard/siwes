@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registration</div>
                    <div class="card-body">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action" href="{{route('register.student')}}">
                                <i class="fa fa-plus-circle"></i>
                                Students Registration
                            </a>
                            <a class="list-group-item list-group-item-action" href="{{route('register.lecturer')}}">
                                <i class="fa fa-plus-square"></i>
                                Lecturers Registration
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
