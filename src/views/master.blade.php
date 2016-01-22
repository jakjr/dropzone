<!DOCTYPE html>
<html lang="pt-br">

    @include('layout::master.head')

    {{--{{ Celepar\Light\Html\TemplateHelper::returnClassIfSideBarIsClosed('page-sidebar-closed') }}--}}
    <body class="page-header-fixed{{$sidebarClosed or ''}}">

        @include('layout::master.header')

        <div class="page-container">
            @include('layout::master.sidebar')
            @include('layout::content')
        </div>

        @include('layout::master.footer')

        @include('layout::master.javascript')
    </body>

</html>