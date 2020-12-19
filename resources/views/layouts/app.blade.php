<html>
<head>
    <title> Halaman @yield('title')</title>
</head>
<body>

    @section('sidebar')
            Ini adalah  sidebar.
    @show

    <div class="container">
    @yield('content')
    </div>
    
</body>
</html>
