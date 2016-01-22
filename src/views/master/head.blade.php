<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="pt-br" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8"/>
    <title>@if( ! App::environment('producao') )({{App::environment()}})@endif{{ Config::get('layout.browserTitle') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="description" content="{{Config::get('layout.description')}}">
    <meta name="author" content="{{Config::get('layout.author', 'João Alfredo Knopik Junior')}}">
    <meta name="MobileOptimized" content="320">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}"/>

    @include('layout::master.css')
</head>
