<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title')</title>
<link rel="icon" href="{{ asset('geek.ico') }}">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/front/css/front.css') }}">
</head>

<body>

    <div id="wrapper">
        @include("layouts.navbar")

        @yield('header')

        @include("layouts.error")

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        @yield('content')
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        @section('sidebar')
                            @include('layouts.sidebar')
                        @show
                    </div>
                </div>
            </div>
        </section>

        @include('layouts.footer')
    </div>


    <script src="{{ asset('assets/front/js/front.js') }}"></script>

</body>

</html>
