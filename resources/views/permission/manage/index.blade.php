@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table class="table responsive no-wrap table-bordered table-condensed table-hover table-striped" id="{{$name}}-list">
                    <thead>
                    <tr>
                        <td>Permission</td>
                        @foreach($roles as $role)
                            @if($role->slug != 'administrator')
                            <td>{{$role->name}}</td>
                            @endif
                        @endforeach
                    </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
@stop

@include('layouts.includes.datatables')

@section('script')
    <script type="text/javascript">
        var manageRole = {
            change: function (el) {

                var     $this = $(el),
                        permissionId = $this.data('permission'),
                        roleId = $this.data('role');

                $.ajax({
                    url: '{{route('permissions.manage')}}',
                    method: 'PUT',
                    data: {
                        _token: window.Lemon.csrfToken,
                        role: roleId,
                        permission: permissionId
                    },
                    success: function (r) {
                        if (r.checked) {
                            $this.prop('checked', true);
                        } else {
                            $this.prop('checked', false);
                        }
                    },
                    error: function () {
                        $this.prop('checked', false);
                    }
                });
            }
        };

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
                    url: "{{route('permissions.data')}}"
                },
                columns: [
                    {data: 'permission', name: 'permission'},
                    @foreach($roles as $role)
                        @if($role->slug != 'administrator')
                        {data: 'role-{{$role->id}}', name: '{{$role->name}}', searchable: false, orderable: false},
                        @endif
                    @endforeach
                ]
            });
        });
    </script>
@stop