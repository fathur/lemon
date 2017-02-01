@section('scripts')
    <script src="{{asset('assets/select2/dist/js/select2.full.min.js')}}"></script>
    @parent
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2-bootstrap-theme/dist/select2-bootstrap.min.css')}}">
    @parent
@stop