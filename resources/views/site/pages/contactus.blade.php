@extends('site.layouts.master')
@section('content')

    
    <section class="contact-us">
        <div class="top-panner">
            <div class="inner-title">
                <div class="container header-para">
                    <h1>نتشرف بالتواصل معكم</h1>
                    <p>المملكة العربية السعودية – المدينة المنورة – حي الوبرة- جوار جامع الأنصار</p>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            @if(Session::has('m'))
                                <?php $a = []; $a = session()->pull('m'); ?>
                                <div class="alert alert-{{$a[0]}}" style="margin-top: 15px;">
                                    {{$a[1]}}
                                </div>
                            @endif

                            @if(count($errors) > 0)
                                <div class="alert alert-danger" style="margin-top: 15px;">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-5"></div>
                        <div class="col-md-7">
                            
                            <div class="form">
                                <form action="{{route('site-contact-us')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" id="" placeholder="الإسم" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="phone" class="form-control" id="" placeholder="رقم الجوال">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control" id="" placeholder="البريد الإلكتروني" required>
                                    </div>

                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="" cols="30" rows="7" required placeholder="رسالتك ومقترحاتك"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input class="btn btn-info" type="submit" value="إرسال" name="" id="">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="contact-info">
                                <ul class="list-group">
                                    <li class="list-group-item"><span>هاتف</span> <span class="left-span">00966148288838</span></li>
                                    <li class="list-group-item"><span>هاتف وفاكس</span> <span class="left-span">00966148277727</span></li>
                                    <li class="list-group-item"><span>جوال</span> <span class="left-span">00966556663617</span></li>
                                    <li class="list-group-item"><span>واتس آب</span> <span class="left-span">00966556663617</span></li>
                                    <li class="list-group-item"><span>صندوق بريد</span> <span class="left-span">4160</span></li>
                                    <li class="list-group-item"><span>الرمز البريدي</span> <span class="left-span">42370</span></li>
                                    <li class="list-group-item"><span>بريد الكتروني	</span> <span class="left-span">info@waqfaletqan.com</span></li>
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

@stop