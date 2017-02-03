@extends('layouts.app')

@section('content')
    <div class="container">

        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{Session::get('success')}}
            </div>
        @endif

        <div class="row mb15">
            <div class="col-md-12">
                <a href="{{route('posts.create')}}" class="btn btn-success">Add</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table responsive no-wrap table-bordered table-condensed table-hover table-striped" id="{{$name}}-list">
                    <thead>
                    <tr>
                        <td>Title</td>
                        <td>Author</td>
                        <td>Active</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop

@include('layouts.includes.datatables')

@section('script')
    <script type="text/javascript">
        //        $.extend( $.fn.dataTable.defaults, {
        //            responsive: true
        //        } );

        $(document).ready(function() {
            var dt = $('#{{$name}}-list').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                responsive: true,
//                rowReorder: {
//                    update: false
//                },
                ajax: {
                    url: "{{route('posts.data')}}"
                },
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'author', name: 'author', searchable: false},
                    {data: 'active', name: 'active', searchable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });

//            dt.on('row-reorder', function(e, diff, edit) {
//                console.log(e);
//                console.log(diff);
//                console.log(edit);
//            });
        });
    </script>
@stop