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
                            <h1 class="text-center">تسجيل الدخول</h1>

                            <form action="{{route('site-post-login')}}" method="POST" class="form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    <input type="text" class="form-control phone" name="phone">
                                </div>

                                <div class="form-group">
                                    <label>كلمة السر</label>
                                    <input type="password" class="form-control password" name="password">
                                </div>
                                <input type="hidden" value="{{route('site-home')}}" id="homeRoute">
                                <button type="submit" class="btn btn-default">تسجيل الدخول</button>
                            </form>

                            <div class="dont-have-account">
                                <p>ليس لديك حساب؟ <a data-toggle="modal" data-target="#RegModal">قم بإنشاء حساب</a></p>
                            </div>
                        </div>
                        <div class="go-home">
                            <p><a href="{{route('site-home')}}">الرئيسية</a></p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Register -->
            <div class="container">
                <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-10 col-sm-offset-1">
                   <!-- Modal -->
                    <div id="RegModal" class="modal fade" role="dialog">
                        <div class="modal-dialog site-modal-dialog box-item">

                            <!-- Modal content-->
                            <div class="modal-content">
                                
                                <div class="modal-header box-item-head">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="text-center">إنشاء حساب</h4>
                                </div>
                                
                                <div class="modal-body  box-item-content">
                                    <form method="POST" action="{{route('site-register')}}" class="register-form">  
                                        {{ csrf_field() }}
                                        <div class="alert alert-danger"></div>
                                        <div class="alert alert-success"></div>
                                        <div class="form-group">
                                            <label for="name">الإسم</label>
                                            <input type="text" id="user_name" class="user_name form-control" name="user_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="number">رقم الهاتف</label>
                                            <input type="text" id="phone_number" value="" class="phone_number form-control" name="phone_number">
                                            <span>يرجى تذكر هذا الرقم للتمكن من تسجيل الدخول لاحقا!</span>
                                        </div>

                                        <div class="form-group">
                                            <label for="country">الدولة</label>
                                            <select id="country" value="" class="country form-control" name="country">
                                                <option value="أفغانستان">أفغانستان</option>
                                                <option value="ألبانيا">ألبانيا</option>
                                                <option value="الجزائر">الجزائر</option>
                                                <option value="أندورا">أندورا</option>
                                                <option value="أنغولا">أنغولا</option>
                                                <option value="أنتيغوا وباربودا">أنتيغوا وباربودا</option>
                                                <option value="الأرجنتين">الأرجنتين</option>
                                                <option value="أرمينيا">أرمينيا</option>
                                                <option value="أستراليا">أستراليا</option>
                                                <option value="النمسا">النمسا</option>
                                                <option value="أذربيجان">أذربيجان</option>
                                                <option value="البهاما">البهاما</option>
                                                <option value="البحرين">البحرين</option>
                                                <option value="بنغلاديش">بنغلاديش</option>
                                                <option value="باربادوس">باربادوس</option>
                                                <option value="بيلاروسيا">بيلاروسيا</option>
                                                <option value="بلجيكا">بلجيكا</option>
                                                <option value="بليز">بليز</option>
                                                <option value="بنين">بنين</option>
                                                <option value="بوتان">بوتان</option>
                                                <option value="بوليفيا">بوليفيا</option>
                                                <option value="البوسنة والهرسك ">البوسنة والهرسك </option>
                                                <option value="بوتسوانا">بوتسوانا</option>
                                                <option value="البرازيل">البرازيل</option>
                                                <option value="بروناي">بروناي</option>
                                                <option value="بلغاريا">بلغاريا</option>
                                                <option value="بوركينا فاسو ">بوركينا فاسو </option>
                                                <option value="بوروندي">بوروندي</option>
                                                <option value="كمبوديا">كمبوديا</option>
                                                <option value="الكاميرون">الكاميرون</option>
                                                <option value="كندا">كندا</option>
                                                <option value="الرأس الأخضر">الرأس الأخضر</option>
                                                <option value="جمهورية أفريقيا الوسطى ">جمهورية أفريقيا الوسطى </option>
                                                <option value="تشاد">تشاد</option>
                                                <option value="تشيلي">تشيلي</option>
                                                <option value="الصين">الصين</option>
                                                <option value="كولومبيا">كولومبيا</option>
                                                <option value="جزر القمر">جزر القمر</option>
                                                <option value="كوستاريكا">كوستاريكا</option>
                                                <option value="ساحل العاج">ساحل العاج</option>
                                                <option value="كرواتيا">كرواتيا</option>
                                                <option value="كوبا">كوبا</option>
                                                <option value="قبرص">قبرص</option>
                                                <option value="التشيك">التشيك</option>
                                                <option value="جمهورية الكونغو الديمقراطية">جمهورية الكونغو الديمقراطية</option>
                                                <option value="الدنمارك">الدنمارك</option>
                                                <option value="جيبوتي">جيبوتي</option>
                                                <option value="دومينيكا">دومينيكا</option>
                                                <option value="جمهورية الدومينيكان">جمهورية الدومينيكان</option>
                                                <option value="تيمور الشرقية ">تيمور الشرقية </option>
                                                <option value="الإكوادور">الإكوادور</option>
                                                <option value="مصر">مصر</option>
                                                <option value="السلفادور">السلفادور</option>
                                                <option value="غينيا الاستوائية">غينيا الاستوائية</option>
                                                <option value="إريتريا">إريتريا</option>
                                                <option value="إستونيا">إستونيا</option>
                                                <option value="إثيوبيا">إثيوبيا</option>
                                                <option value="فيجي">فيجي</option>
                                                <option value="فنلندا">فنلندا</option>
                                                <option value="فرنسا">فرنسا</option>
                                                <option value="الغابون">الغابون</option>
                                                <option value="غامبيا">غامبيا</option>
                                                <option value="جورجيا">جورجيا</option>
                                                <option value="ألمانيا">ألمانيا</option>
                                                <option value="غانا">غانا</option>
                                                <option value="اليونان">اليونان</option>
                                                <option value="جرينادا">جرينادا</option>
                                                <option value="غواتيمالا">غواتيمالا</option>
                                                <option value="غينيا">غينيا</option>
                                                <option value="غينيا بيساو">غينيا بيساو</option>
                                                <option value="غويانا">غويانا</option>
                                                <option value="هايتي">هايتي</option>
                                                <option value="هندوراس">هندوراس</option>
                                                <option value="المجر">المجر</option>
                                                <option value="آيسلندا">آيسلندا</option>
                                                <option value="الهند">الهند</option>
                                                <option value="إندونيسيا">إندونيسيا</option>
                                                <option value="إيران">إيران</option>
                                                <option value="العراق">العراق</option>
                                                <option value="جمهورية أيرلندا ">جمهورية أيرلندا </option>
                                                <option value="فلسطين">فلسطين</option>
                                                <option value="إيطاليا">إيطاليا</option>
                                                <option value="جامايكا">جامايكا</option>
                                                <option value="اليابان">اليابان</option>
                                                <option value="الأردن">الأردن</option>
                                                <option value="كازاخستان">كازاخستان</option>
                                                <option value="كينيا">كينيا</option>
                                                <option value="كيريباتي">كيريباتي</option>
                                                <option value="الكويت">الكويت</option>
                                                <option value="قرغيزستان">قرغيزستان</option>
                                                <option value="لاوس">لاوس</option>
                                                <option value="لاوس">لاوس</option>
                                                <option value="لاتفيا">لاتفيا</option>
                                                <option value="لبنان">لبنان</option>
                                                <option value="ليسوتو">ليسوتو</option>
                                                <option value="ليبيريا">ليبيريا</option>
                                                <option value="ليبيا">ليبيا</option>
                                                <option value="ليختنشتاين">ليختنشتاين</option>
                                                <option value="ليتوانيا">ليتوانيا</option>
                                                <option value="لوكسمبورغ">لوكسمبورغ</option>
                                                <option value="مدغشقر">مدغشقر</option>
                                                <option value="مالاوي">مالاوي</option>
                                                <option value="ماليزيا">ماليزيا</option>
                                                <option value="جزر المالديف">جزر المالديف</option>
                                                <option value="مالي">مالي</option>
                                                <option value="مالطا">مالطا</option>
                                                <option value="جزر مارشال">جزر مارشال</option>
                                                <option value="موريتانيا">موريتانيا</option>
                                                <option value="موريشيوس">موريشيوس</option>
                                                <option value="المكسيك">المكسيك</option>
                                                <option value="مايكرونيزيا">مايكرونيزيا</option>
                                                <option value="مولدوفا">مولدوفا</option>
                                                <option value="موناكو">موناكو</option>
                                                <option value="منغوليا">منغوليا</option>
                                                <option value="الجبل الأسود">الجبل الأسود</option>
                                                <option value="المغرب">المغرب</option>
                                                <option value="موزمبيق">موزمبيق</option>
                                                <option value="بورما">بورما</option>
                                                <option value="ناميبيا">ناميبيا</option>
                                                <option value="ناورو">ناورو</option>
                                                <option value="نيبال">نيبال</option>
                                                <option value="هولندا">هولندا</option>
                                                <option value="نيوزيلندا">نيوزيلندا</option>
                                                <option value="نيكاراجوا">نيكاراجوا</option>
                                                <option value="النيجر">النيجر</option>
                                                <option value="نيجيريا">نيجيريا</option>
                                                <option value="كوريا الشمالية ">كوريا الشمالية </option>
                                                <option value="النرويج">النرويج</option>
                                                <option value="سلطنة عمان">سلطنة عمان</option>
                                                <option value="باكستان">باكستان</option>
                                                <option value="بالاو">بالاو</option>
                                                <option value="بنما">بنما</option>
                                                <option value="بابوا غينيا الجديدة">بابوا غينيا الجديدة</option>
                                                <option value="باراغواي">باراغواي</option>
                                                <option value="بيرو">بيرو</option>
                                                <option value="الفلبين">الفلبين</option>
                                                <option value="بولندا">بولندا</option>
                                                <option value="البرتغال">البرتغال</option>
                                                <option value="قطر">قطر</option>
                                                <option value="جمهورية الكونغو">جمهورية الكونغو</option>
                                                <option value="جمهورية مقدونيا">جمهورية مقدونيا</option>
                                                <option value="رومانيا">رومانيا</option>
                                                <option value="روسيا">روسيا</option>
                                                <option value="رواندا">رواندا</option>
                                                <option value="سانت كيتس ونيفيس">سانت كيتس ونيفيس</option>
                                                <option value="سانت لوسيا">سانت لوسيا</option>
                                                <option value="سانت فنسينت والجرينادينز">سانت فنسينت والجرينادينز</option>
                                                <option value="ساموا">ساموا</option>
                                                <option value="سان مارينو">سان مارينو</option>
                                                <option value="ساو تومي وبرينسيب">ساو تومي وبرينسيب</option>
                                                <option selected value="السعودية">السعودية</option>
                                                <option value="السنغال">السنغال</option>
                                                <option value="صربيا">صربيا</option>
                                                <option value="سيشيل">سيشيل</option>
                                                <option value="سيراليون">سيراليون</option>
                                                <option value="سنغافورة">سنغافورة</option>
                                                <option value="سلوفاكيا">سلوفاكيا</option>
                                                <option value="سلوفينيا">سلوفينيا</option>
                                                <option value="جزر سليمان">جزر سليمان</option>
                                                <option value="الصومال">الصومال</option>
                                                <option value="جنوب أفريقيا">جنوب أفريقيا</option>
                                                <option value="كوريا الجنوبية">كوريا الجنوبية</option>
                                                <option value="جنوب السودان">جنوب السودان</option>
                                                <option value="إسبانيا">إسبانيا</option>
                                                <option value="سريلانكا">سريلانكا</option>
                                                <option value="السودان">السودان</option>
                                                <option value="سورينام">سورينام</option>
                                                <option value="سوازيلاند">سوازيلاند</option>
                                                <option value="السويد">السويد</option>
                                                <option value="سويسرا">سويسرا</option>
                                                <option value="سوريا">سوريا</option>
                                                <option value="طاجيكستان">طاجيكستان</option>
                                                <option value="تنزانيا">تنزانيا</option>
                                                <option value="تايلاند">تايلاند</option>
                                                <option value="توغو">توغو</option>
                                                <option value="تونجا">تونجا</option>
                                                <option value="ترينيداد وتوباغو">ترينيداد وتوباغو</option>
                                                <option value="تونس">تونس</option>
                                                <option value="تركيا">تركيا</option>
                                                <option value="تركمانستان">تركمانستان</option>
                                                <option value="توفالو">توفالو</option>
                                                <option value="أوغندا">أوغندا</option>
                                                <option value="أوكرانيا">أوكرانيا</option>
                                                <option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>
                                                <option value="المملكة المتحدة">المملكة المتحدة</option>
                                                <option value="الولايات المتحدة">الولايات المتحدة</option>
                                                <option value="أوروغواي">أوروغواي</option>
                                                <option value="أوزبكستان">أوزبكستان</option>
                                                <option value="فانواتو">فانواتو</option>
                                                <option value="فنزويلا">فنزويلا</option>
                                                <option value="فيتنام">فيتنام</option>
                                                <option value="اليمن">اليمن</option>
                                                <option value="زامبيا">زامبيا</option>
                                                <option value="زيمبابوي">زيمبابوي</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="city">المدينة</label>
                                            <input type="text" id="city" value="" class="city form-control" name="city">
                                        </div>

                                        <div class="form-group">
                                            <label for="password">كلمة السر</label>
                                            <input type="password" id="reg_password" value="" class="reg_password form-control" name="reg_password">
                                        </div>

                                        <button type="submit" class="btn btn-default button-register">إنشاء <i class="fa fa-pencil" style="margin-right: 5px"></i></button>

                                    </form> 
                                    
                                </div>
                            </div>

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
            const phone = document.querySelector('.phone');
            const password = document.querySelector('.password');
            const notifications  = document.querySelector('.notifications');

            // Register form Constants
            const regForm = document.querySelector('.register-form');
            const name = regForm.user_name;
            const phone_number = regForm.phone_number;
            const country = regForm.country;
            const city = regForm.city;
            const reg_password = regForm.reg_password;
            const alert_danger  = document.querySelector('.alert.alert-danger') ;
            const alert_success = document.querySelector('.alert.alert-success');
            
            // Login Form
            $(form).on('submit', function(e) {
                e.preventDefault();
                if(phone.value == '') {
                    notifications.classList.add('show');
                    notifications.querySelector('p').innerText = 'من فضلك أدخل رقم الهاتف';
                    setTimeout(() => notifications.classList.remove('show'), 2500);
                } else if(password.value == '') {
                    notifications.classList.add('show');
                    notifications.querySelector('p').innerText = 'من فضلك أدخل كلمة السر';
                    setTimeout(() => notifications.classList.remove('show'), 2500);
                } else {
                    $.ajax({
                        url: form.action,
                        type: 'POST',
                        data: {phone: phone.value, password: password.value, _token: '{{ csrf_token()}}'}
                    }).done((data) => {
                        if(!(data === 'Logedin')) {
                            notifications.classList.add('show');
                            notifications.querySelector('p').innerText = 'خطأ في رقم الهاتف او كلمة السر!';
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

            // Register form
            $(regForm).on('submit', function(e) {
                e.preventDefault();
                if(name.value == '') {
                    alert_danger.classList.add('show');
                    alert_danger.innerText = 'من فضلك أدخل الإسم';
                    setTimeout(() => alert_danger.classList.remove('show'), 4000);
                } else if(name.value.length < 2) {
                    alert_danger.classList.add('show');
                    alert_danger.innerText = 'ﻻ يمكن أن يكون الإسم أقل من حرفين';
                    setTimeout(() => alert_danger.classList.remove('show'), 4000);
                } else if(phone_number.value == '') {
                    alert_danger.classList.add('show');
                    alert_danger.innerText = 'أدخل رقم الهاتف';
                    setTimeout(() => alert_danger.classList.remove('show'), 4000);
                } else if(phone_number.value.length < 6) {
                    alert_danger.classList.add('show');
                    alert_danger.innerText = 'ﻻ يمكن أن يكون رقم الهاتف أقل من 6 أرقام';
                    setTimeout(() => alert_danger.classList.remove('show'), 4000);
                } else if(city.value == '') {
                    alert_danger.classList.add('show');
                    alert_danger.innerText = 'أدخل إسم المدينة';
                    setTimeout(() => alert_danger.classList.remove('show'), 4000);
                } else if(reg_password.value =='') {
                    alert_danger.classList.add('show');
                    alert_danger.innerText = 'من فضلك أدخل كلمة السر';
                    setTimeout(() => alert_danger.classList.remove('show'), 4000);
                } else if(reg_password.value.length < 6) {
                    alert_danger.classList.add('show');
                    alert_danger.innerText = 'ﻻ يمكن أن تكون كلمة السر أقل من 6 أحرف';
                    setTimeout(() => alert_danger.classList.remove('show'), 4000);
                } else {
                    $.ajax({
                        url: regForm.action,
                        type: 'POST',
                        data: {
                            name: name.value,
                            phone_number: phone_number.value,
                            country: country.value,
                            city: city.value,
                            reg_password: reg_password.value,
                            _token: '{{ csrf_token()}}'
                        }
                    }).done((data) => {
                        if(!(data === 'Registered')) {
                            alert_danger.classList.add('show');
                            alert_danger.innerText = 'خطأ في الإتصال';
                            setTimeout(() => alert_danger.classList.remove('show'), 3000);
                        } else {
                            alert_success.classList.add('show');
                            alert_success.innerText = 'تم إنشاء حسابك وسيتم تسجيل دخولك الآن';
                            setTimeout(() => {
                                window.location.href = form.homeRoute.value
                            }, 4000);
                        }
                    }).error((err) => {
                        console.log(err.message);
                    });
                }
            });

        </script>
    </body>
    </html>