<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('admin.layout.head')
</head>
<body>
    @include('admin.layout.sidebar')
    @yield('content')
    @include('admin.layout.footer')
    @include('admin.layout.script')
</body>
</html>