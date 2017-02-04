@extends('layouts.app')

@section('content')
    <div class="container">

            <div class="row">
                <form class="form-horizontal" action="{{route('posts.store')}}" method="post" role="form">
                {{csrf_field()}}

                <div class="col-md-8">
                    <div class="form-group">
                        <input type="text" class="form-control input-lg" name="title" id="title" placeholder="Title"
                               value="{{old('title')}}">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <textarea name="content" id="content" class="form-control"
                                  placeholder="Content">{{old('content')}}</textarea>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Create</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="release_date" class="">Release Date</label>
                        <input type="text" class="form-control" name="release_date" id="release_date"
                               placeholder="Release Date"
                               value="{{old('release_date')}}">
                        @if ($errors->has('release_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('release_date') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="active" value="1"> Active
                            </label>
                        </div>
                    </div>
                </div>

                </form>
            </div>
    </div>
@stop

@include('layouts.includes.select2')

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
@stop

@section('scripts')
    <script src="{{asset('assets/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/autogrow-textarea/jquery.autogrowtextarea.min.js')}}"></script>
    <script src="{{asset('assets/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
@stop

@section('script')
    <script>
        $('#content').autoGrow();
        $('#release_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            sideBySide: true
        });
    </script>
@stop