@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <textarea name="status" id="status" class="form-control mb15" title="Status" placeholder="Status"></textarea>
                    <button class="btn btn-lg btn-success pull-right" id="btn-create-post">Post</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <ul class="list-group">

                @foreach($statuses as $status)
                    <li class="list-group-item">{{$status->text}}</li>
                @endforeach
            </ul>


    </div>
</div>
@endsection

@section('script')
        <script>
            $('#btn-create-post').click(function() {
                var status = $('#status').val();
                console.log(status);

                $.post(window.Lemon.url + '/statuses', {
                    status: status,
                    _token: window.Lemon.csrfToken
                }, function(response) {

                });


                $('#status').val('');
            });
        </script>
@endsection