@section('scripts')
    <script src="{{asset('assets/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/datatables/media/js/dataTables.bootstrap.js')}}"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.0/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
    <script src="{{asset('assets/bootbox.js/bootbox.js')}}"></script>
    @parent
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/datatables/media/css/dataTables.bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.bootstrap.min.css">
    @parent
@stop