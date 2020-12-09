@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Student Registration</div>
            <div class="card-body">

                @foreach($errors->all() as $thisError)
                    <div class="alert alert-danger mx-4">
                        {{ $thisError }}
                    </div>
                @endforeach

            @if(!empty($student))
                    <div class="alert alert-success d-flex justify-content-between">
                        <div>
                            <i class="fa fa-check"></i>
                            Student account created successfully.
                        </div>
                        <a href="{{route('login')}}"><i class="fa fa-sign"></i> Login Here</a>
                    </div>
                @else
                    <form action="{{route('register.student.submit')}}" method="post" class="m-4">
                        @csrf
                        <div class="form-row">
                            <div class="col-md mt-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user-alt"></i>
                                </span>
                                    </div>
                                    <input name="first_name" class="form-control" placeholder="First Name"
                                           value="{{old('first_name')}}">
                                </div>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md mt-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-user-alt"></i>
                                </span>
                                    </div>
                                    <input name="other_names" class="form-control" placeholder="Last Name"
                                           value="{{old('other_names')}}">
                                </div>

                                @error('other_names')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md mt-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-sort-numeric-up-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="reg_number" class="form-control"
                                           placeholder="PRG/16/DEP/00123" value="{{old('reg_number')}}">

                                    @error('reg_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md mt-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-at"></i>
                                </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="you@domain.tld"
                                           value="{{old('email')}}">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mt-2">
                            <div class="col-md mt-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-hashtag"></i>
                                </span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md mt-1">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-hashtag"></i>
                                </span>
                                    </div>
                                    <input type="password" name="confirm_password" class="form-control"
                                           placeholder="Confirm Password">

                                    @error('confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="fa fa-plus"></i> Create Account
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
