

<!-- NAVBAR ====================================================== -->

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{route('site-about-us')}}">من نحن <span class="sr-only">(current)</span></a></li>
            <li><a href="#" class="supervisor-parent">المشرف <i class="fa fa-chevron-down"></i> </a>
                <ul class="list-unstyled supervisor hide-menue">
                    <li><a href="{{route('site-supervisor')}}">كلمة المشرف</a></li>
                    <li><a href="{{route('site-supervisor-about')}}">عن المشرف</a></li>
                </ul>
            </li>
            <li><a href="#">خدماتنا</a></li>
            <li><a href="#">فعالياتنا</a></li>
            <li><a href="https://nusrahalsunnah-store.com/category/VAGXW" target="_blank">إصداراتنا</a></li>
            <li><a href="https://nusrahalsunnah-store.com/" target="_blank">دعمنا</a></li>
            <li><a href="{{route('site-contact')}}">إتصل بنا</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right" style="display: flex">
            <div class="social-links">
                <ul class="list-unstyled"  style="display: flex; margin-top:15px"> 
                    <li><a href="https://www.facebook.com/nusrah.alsunnah" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
                    <li><a href="https://twitter.com/home" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/nusrahalsunnah/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                </ul>
            </div>
            @if(auth()->guard('auth-site')->check() || auth()->guard('auth-site-sheikh')->check()) 
                <li><a href="{{route('site-logout')}}"><i class="fa fa-sign-out"></i>خروج</a></li> 
            @else 
                <li><a href="{{route('site-login')}}"><i class="fa fa-user"></i>دخول</a></li> 
            @endif
            
        </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<!-- HEADER SECTION ====================================================== -->

<section class="header">

    <div class="container">
        <div class="col-md-4">
            <div class="nosrah-logo">
                <a href="{{route('site-home')}}"><img class="img-responsive" src="{{asset('assets/images/logo4.png')}}" alt=""></a>
            </div>
        </div>

        <div class="col-md-4">
            
        </div>

        <div class="col-md-4">
            <div class="hazem-name">
                <a href="{{route('site-supervisor-about')}}" target="_blank"><img class="img-responsive" src="{{asset('assets/site/images/333.png')}}" alt=""></a>
            </div>
        </div>
    </div>

</section>

<!-- MIDDLE NAVBAR SECTION ====================================================== -->
<section class="mid-nav">
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav">
                <li class="{{ Request::route()->getName() == 'site-main' ? 'active' :'' }}"><a href="{{route('site-main')}}"> <i class="fa fa-home"></i>  الرئيسية <span class="sr-only">(current)</span></a></li>
                <li class="{{ Request::route()->getName() == 'site-home' ? 'active' :'' }}"><a href="{{route('site-home')}}">شبهات وردود <span class="sr-only">(current)</span></a></li>
                <li class="{{ Request::route()->getName() == 'site-hot-suspicions' ? 'active' :'' }}"><a href="{{route('site-hot-suspicions')}}">شبهات ساخنة</a></li>
                <li class="{{ Request::route()->getName() == 'site-evidences' ? 'active' :'' }}"><a href="{{route('site-evidences')}}">أدلة</a></li>
                <li class="{{ Request::route()->getName() == 'site-discussions' ? 'active' :'' }}"><a href="{{route('site-discussions')}}">مناظرات</a></li>
                <li class="{{ Request::route()->getName() == 'site-infographs' ? 'active' :'' }}"><a href="{{route('site-infographs')}}">بطاقات</a></li>
                @if(auth()->guard('auth-site')->check())
                    <li class="{{ Request::route()->getName() == 'site-favorites' ? 'active' :'' }}"><a href="{{route('site-favorites')}}">مُفضلة</a></li>
                @endif
                <li><a href="#">الخط الساخن</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form action="">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search-text" placeholder="البحث ...">
                        <a href="#" class="btn btn-default"><i class="fa fa-search"></i></a>
                    </div>
                    
                </form>
            </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</section>
