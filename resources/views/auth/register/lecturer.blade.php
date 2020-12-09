@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Lecturer Registration</div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-row">
                    <div class="col-md">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i class="fa fa-user-alt"></i>
                            </div>
                            <input name="first_name" class="form-control" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <i class="fa fa-user-alt"></i>
                            </div>
                            <input name="last_name" class="form-control" placeholder="Last Name">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
