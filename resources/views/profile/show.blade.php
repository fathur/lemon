@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{$user->username}}</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Full Name</label>
                        <div class="col-sm-10">

                            <p class="form-control-static">{{$user->name}}</p>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            @if($isFollower)
                                <button type="button" class="btn btn-default" id="btn-unfollow">Unfollow</button>
                            @else
                                <button type="button" class="btn btn-default" id="btn-follow">Follow</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        $('#btn-follow').click(function() {
            $.post('{{ route('users.follow', [$user->id]) }}', {
                _token: window.Lemon.csrfToken
            },function(response) {

            });
        });

        $('#btn-unfollow').click(function() {

            $.ajax({
                method: 'DELETE',
                url: '{{ route('users.unfollow', [$user->id]) }}',
                data: {
                    _token: window.Lemon.csrfToken
                }
            });
        });
    </script>
@endsection