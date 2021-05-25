@extends('layouts.master')
@section('content')
<section>
    <div class="box-item">
        <div class="box-item-head">
            <h3 class="title">بيانات الصفحة التعريفية للتطبيق</h3>
            <i class="fa fa-angle-down"></i>
        </div><!-- End Box-Item-Head -->
        <div class="box-item-content">
            <form class="form" id="upload_form" enctype="multipart/form-data" method="post" action="{{route('about-update')}}">

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
            
                <div class="form-body">
                    {{ csrf_field() }}
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الرسالة </label>
                                <textarea class="form-control" rows="5" name="message">{{$about->message}}</textarea>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الأهداف</label>
                                <textarea class="form-control" rows="5" name="goals">{{$about->goals}}</textarea>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>الرؤية</label>
                                <textarea class="form-control" rows="5" name="vision">{{$about->vision}}</textarea>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رقم الواتس اب</label>
                                <input class="form-control" type="text" name="whatsapp" value="{{$about->whatsapp}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رابط الفيسبوك </label>
                                <input class="form-control" type="url" name="facebook" value="{{$about->facebook}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رابط تويتر</label>
                                <input class="form-control" type="url" name="twitter" value="{{$about->twitter}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رابط جوجل بلس </label>
                                <input class="form-control" type="url" name="googleplus" value="{{$about->googleplus}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رابط اليوتيوب</label>
                                <input class="form-control" type="url" name="youtube" value="{{$about->youtube}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رابط لينكدإن </label>
                                <input class="form-control" type="url" name="linkedin" value="{{$about->linkedin}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رابط إنستاجرام</label>
                                <input class="form-control" type="url" name="instagram" value="{{$about->instagram}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رابط الموقع </label>
                                <input class="form-control" type="url" name="website" value="{{$about->website}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        
                    </div><!--End Row-->
                </div><!--End Form-body-->
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn" type="submit">حفظ التغييرات</button>
                        </div><!--End Col-->
                    </div><!--End Row-->
                </div><!--End Form-action-->
            </form><!-- End row -->
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->
@endsection