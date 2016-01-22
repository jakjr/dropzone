<script src="{{asset('vendor/layout/js/all.js')}}"></script>
<script src="{{asset('vendor/layout/js/app.js')}}"></script>

{{--Injecao de js macro--}}
@if(isset($scriptCollection))
    @foreach($scriptCollection->all() as $script)
        <script src="{{asset($script)}}"></script>
    @endforeach
@endif

@section('js')
@show