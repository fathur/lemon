@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <form class="form-horizontal" action="{{route('posts.store')}}" method="post">
                    {{csrf_field()}}
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
                </form>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                        <label for="release_date" class="">Release Date</label>

                        <input type="text" class="form-control" name="release_date" id="release_date" placeholder="Release Date"
                               value="{{old('release_date')}}">

                        @if ($errors->has('release_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('release_date') }}</strong>
                            </span>
                        @endif
                </div>
                {{--<div class="form-group">
                    <label for="author" class="col-sm-2 control-label">Author</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="author" id="author" placeholder="Username"
                               value="{{old('username')}}">
                        @if ($errors->has('author_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('author_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
@stop

@include('layouts.includes.select2')

@section('script')
    <script>
    </script>
@stop