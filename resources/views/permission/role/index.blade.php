@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb15">
            <div class="col-md-12">
                <a href="{{route('roles.create')}}" class="btn btn-success">Add</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table responsive no-wrap table-bordered table-condensed table-hover table-striped" id="{{$name}}-list">
                    <thead>
                    <tr>
                        <td>Slug</td>
                        <td>Name</td>
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
        $.extend( $.fn.dataTable.defaults, {
            responsive: true
        } );

        $(document).ready(function() {
            var dt = $('#{{$name}}-list').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                responsive: true,
                ajax: {
                    url: "{{route('roles.data')}}"
                },
                columns: [
                    {data: 'slug', name: 'slug'},
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });


        });
    </script>
@stop