<ul class="nav navbar-nav pull-left">
    <li>
        <a class="navbar-brand" href="/">
            <img src="{!! Config::get('layout.appLogo', asset('vendor/layout/img/logo.png') ) !!}" alt="logo" class="img-responsive">
        </a>
    </li>
    <li>
        <ul class="nav-titulo">
            <li><h5>{{ Config::get('layout.appTitle1') }}</h5></li>
            <li><h5>{{ Config::get('layout.appTitle2') }}</h5></li>
            <li><h6>{{ Config::get('layout.appTitle3') }}</h6></li>
        </ul>
    </li>
</ul>

{{-- Icone do menu, quando em display pequenos --}}
<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <img src="{!! asset('vendor/layout/img/menu-toggler.png') !!}">
</a>

<ul class="nav navbar-nav pull-right">
    {{-- View composer para renderizar os atalhos --}}
    {!! $shortcut or '' !!}
</ul>