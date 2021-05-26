<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>نصرة السنة</title>
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <link href="{{asset('assets/site/css/bootstrap-ar.css')}}" rel="stylesheet">
        <link href="{{asset('assets/site/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- Site Style
        ========================== -->
        <link rel="stylesheet" href="{{asset('assets/site/css/styles.css')}}">
    </head>
    <body style="">

        

        <section class="site-login">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm-10 col-sm-offset-1">
                        <div class="notifications">
                            <p></p>
                        </div>
                        <div class="form-container">
                            <h1 class="text-center">تجسل الدخول للسادة <strong>المشايخ</strong> </h1>

                            <form action="{{route('site-post-shikh-login')}}" method="POST" class="form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>البريد الإلكتروني</label>
                                    <input type="text" class="form-control email" name="email">
                                </div>

                                <div class="form-group">
                                    <label>كلمة السر</label>
                                    <input type="password" class="form-control password" name="password">
                                </div>
                                <input type="hidden" value="{{route('site-home')}}" id="homeRoute">
                                <button type="submit" class="btn btn-default">تسجيل الدخول</button>
                            </form>

                        </div>
                        <div class="go-home">
                            <p><a href="{{route('site-home')}}">الرئيسية</a></p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        </section>


       

        <script src="{{asset('assets/site/js/jquery.js')}}"></script>
        <script src="{{asset('assets/site/js/bootstrap.js')}}"></script>
        <script src="{{asset('assets/site/js/app.js')}}"></script>
        <script>
            // Login Form Constants 
            const form = document.querySelector('.form');
            const email = document.querySelector('.email');
            const password = document.querySelector('.password');
            const notifications  = document.querySelector('.notifications');

            // Login Form
            $(form).on('submit', function(e) {
                e.preventDefault();
                if(email.value == '') {
                    notifications.classList.add('show');
                    notifications.querySelector('p').innerText = 'من فضلك أدخل البريد الإلكتروني';
                    setTimeout(() => notifications.classList.remove('show'), 2500);
                } else if(password.value == '') {
                    notifications.classList.add('show');
                    notifications.querySelector('p').innerText = 'من فضلك أدخل كلمة السر';
                    setTimeout(() => notifications.classList.remove('show'), 2500);
                } else {
                    $.ajax({
                        url: form.action,
                        type: 'POST',
                        data: {email: email.value, password: password.value, _token: '{{ csrf_token()}}'}
                    }).done((data) => {
                        if(!(data === 'sheikhLogedin')) {
                            notifications.classList.add('show');
                            notifications.querySelector('p').innerText = 'خطأ في رقم البريد الإلكتروني او كلمة السر!';
                            setTimeout(() => notifications.classList.remove('show'), 3000);
                        } else {
                            notifications.classList.add('logeddin');
                            notifications.querySelector('p').innerText = 'تم تسجيل دخولك بنجاح';
                            setTimeout(() => window.location.href = form.homeRoute.value, 1900);
                        }
                    }).error((err) => {
                        console.log(err.message);
                    });
                }
            
            });
        </script>
    </body>
    </html>