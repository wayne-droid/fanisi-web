<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Admin Portal</title>

        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <link rel="stylesheet" href="{{ URL::asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('vendor/fontawesome-free/css/all.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ URL::asset('css/sb-admin-2.min.css') }}">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
        <link
            href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css"
            rel="stylesheet"  type='text/css'>
        <link href=”https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css” rel=”stylesheet”>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>

    <body id="page-top">

        @if(session()->has('user'))
            @yield('content')
        @else
            @yield('auth')
        @endif

        <script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ URL::asset('js/sb-admin-2.min.js') }}"></script>
        <script src="{{ URL::asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>

        <script src="{{ URL::asset('js/demo/datatables-demo.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="uft8" src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>

        <script type="text/javascript" charset="uft8" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script type="text/javascript" charset="uft8" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data-10-year-range.min.js"></script>

        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
        <script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>

    </body>
</html>
