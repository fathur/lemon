@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal" action="{{route('users.password.update', $user->id)}}" method="post">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" disabled value="{{$user->name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Super strong password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Confirm password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password-confirm" id="password-confirm" placeholder="Confirm super strong password">

                            @if ($errors->has('password-confirm'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-default">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop