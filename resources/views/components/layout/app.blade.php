<!DOCTYPE html>
<html lang='en'>
    @include('components.includes.head')
    <body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('components.includes.sidebar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
                @include('components.includes.header')
                @yield('content')
                @yield('scripts')
        </div>
   
    </body>
    
</html>
