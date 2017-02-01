@extends('layouts.app')

@inject('permission', '\App\Repositories\Permission')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form class="form-horizontal" action="{{route('users.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{old('username')}}">

                            @if ($errors->has('username'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{old('email')}}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="{{old('name')}}">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-10">
                            <select name="role_id" id="role" class="form-control">
                                @if(old('role_id') != null)
                                <option value="{{old('role_id')}}" selected>{{$permission->roleValue(old('role_id'))}}</option>
                                @endif
                            </select>

                            @if ($errors->has('role_id'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@include('layouts.includes.select2')

@section('script')
    <script>
        $('#role').select2({
            ajax: {
                url: '{{route('roles.select')}}',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            theme: "bootstrap",
//            allowClear: true,
            placeholder: 'Role',
            minimumInputLength: 2,
            templateResult: function(data) {
                return data.name || data.text;
            },
            templateSelection: function(data) {
                return data.name || data.text;
            }
        });
    </script>
@stop