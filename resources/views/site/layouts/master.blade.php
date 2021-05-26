
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ردالشبهات - نصرة السنة</title>
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet">
        <link href="{{asset('assets/site/css/bootstrap-ar.css')}}" rel="stylesheet">
        <link href="{{asset('assets/site/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/site/css/treeView.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/site/css/jquery.rateyo.min.css')}}" rel="stylesheet">
        <link rel="icon" class="tab-icon" href="{{asset('assets/images/favicon.png')}}">
        <!-- Site Style
        ========================== -->
        <link rel="stylesheet" href="{{asset('assets/site/css/styles.css')}}">
    </head>
    <body>
        @include('site.layouts.header')
            @yield('content')
        @include('site.layouts.footer')
    
        <script src="{{asset('assets/site/js/jquery.js')}}"></script>
        <script src="{{asset('assets/site/js/treeView.min.js')}}"></script>
        <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/site/js/app.js')}}"></script>
        <script src="{{asset('assets/js/javascript.js')}}"></script>
        <script src="{{asset('assets/site/js/jquery.rateyo.min.js')}}"></script>
        {{-- <script>
            let lists = document.querySelectorAll('.mid-nav .navbar-default .navbar-nav li');
            console.log(lists);
            lists.forEach( list => {
                list.classList.remove('active');
                list.addEventListener('click', event => {
                    console.log(event.target);
                    event.target.classList.add('active');
                });
            });
    
        </script> --}}
    </body>
    </html>