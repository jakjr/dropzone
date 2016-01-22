@section('sidebar')
<div class="page-sidebar navbar-collapse collapse">
    <ul class="page-sidebar-menu">
        <li class="sidebar-toggler-wrapper">

            <div class="sidebar-toggler-userinfo">
                <div class="sidebar-toggler-name">
                    {!! $togglerInfo or '' !!}
                </div>
                {{--@if ( array_key_exists('Celepar\Lum\LumServiceProvider', \App::getLoadedProviders()) && Lum::check() )--}}
                    {{--<div class="sidebar-toggler-name">{{ Lum::getUserFirstName() }} {{ Lum::getUserLastName() }}</div>--}}
                    {{--<div>{{ Lum::getUserLastLogin() }}</div>--}}
                {{--@else--}}
                    {{--<div class="sidebar-toggler-name"></div>--}}
                    {{--@if(Auth::check())--}}
                        {{--<div class="sidebar-toggler-name">{{ Auth::user()->name }}</div>--}}
                    {{--@endif--}}
                {{--@endif--}}

            </div>
            <div class="sidebar-toggler">
                <img src="{{asset('vendor/layout/img/sidebar-toggler.png')}}">
            </div>
        </li>
    </ul>
    {!! $menu or '' !!}
</div>
@show