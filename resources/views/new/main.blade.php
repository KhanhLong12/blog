<!DOCTYPE html>
<html lang="en">
<head>
    @include('new.elements.header')
</head>
<body>
<div class="super_container">
    <!-- Header -->
    <header class="header">
        <!-- Header Content -->
        @include('new.elements.header_content')
    </header>
    <!-- Menu -->
    <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
        @include('new.elements.menu')
    </div>
    <!-- Home -->
    <div class="home">
        <!-- Home Slider -->
        @include('new.elements.home_slider')
    </div>
    <!-- Content Container -->
    <div class="content_container">
        @yield('content')
    </div>
    <!-- Footer -->
    <footer class="footer">
        @include('new.elements.footer')
    </footer>
</div>
    @include('new.elements.script')
</body>
</html>