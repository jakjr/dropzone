<link rel="stylesheet" href="{{asset('vendor/layout/css/all.css')}}">

{{--injeção de css via macros--}}
@if(isset($cssCollection))
    @foreach($cssCollection->all() as $css)
        <link rel="stylesheet" href="{{asset($css)}}">
    @endforeach
@endif

@section('css')
@show