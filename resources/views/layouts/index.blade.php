<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Quay số</title>
        <base href="{{asset('')}}">
        {{-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{asset('js/bootstrap.min.js')}}">
        <script type="text/javascript"  src="{{asset('js/jquery.min.js')}}"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
        {{-- <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}"> --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
        @yield('content')
    </body>
</html>