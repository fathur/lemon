@section('scripts')
    <script src="{{asset('assets/select2/js/select2.full.min.js')}}"></script>
    @parent
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('assets/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
    @parent
@stop