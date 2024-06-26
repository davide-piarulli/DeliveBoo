<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

     <!-- Scripts -->
     @vite(['resources/js/app.js'])

     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <title>DeliveBoo</title>


</head>
<body>

    @include('admin.partials.header')

    <div class="main-wrapper d-flex">
        @include('admin.partials.aside')

        <div class="content py-5">
            @yield('content')

        </div>
    </div>

    @yield('scripts')
</body>
</html>
