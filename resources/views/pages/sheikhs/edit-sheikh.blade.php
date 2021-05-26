<style>
   .btn-primary:active:hover {
        color: #fff;
        background-color: #93c73e;
        border-color: #8bf5f0;
    }
</style>
@extends('layouts.master')
@section('content')    

<section>
    <div class="box-item">
        <div class="box-item-head">
            <h3 class="title">تعديل بيانات {{$sheikh->name}}</h3>
        </div><!-- End Box-Item-Head -->
        
        <div class="box-item-content">
            <form class="form" id="upload_form" enctype="multipart/form-data" method="POST" action="{{route('update-sheikh', ['id' => $sheikh->id])}}">

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

            {{ csrf_field() }}
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>صورة الشيخ</label>
                                <div class="choose-img">
                                    <input type="file" name="file1" id="file1">
                                    <p>اضغط لتحميل صورة</p>
                                </div><!-- End Choose-Img -->
                                <div class="upload-action">
                                    <button class="upload-btn" type="button" id="upload-btn">
                                        تحميل الصورة
                                    </button>
                                    <div class="progress">
                                        <div id="progressBar" value="0" max="100" class="progress-bar" role="progressbar" style="width: 0%;">0%
                                        </div>
                                    </div>
                                  <h3 id="status"></h3>
                                  <p id="loaded_n_total"></p>
                                </div><!--End upload-action-->
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>الإسم</label>
                                <input class="form-control" type="text" name="sheikh_name" value="{{$sheikh->name}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>  كلمة السر الجديدة </label>
                                <input class="form-control" type="password" name="password">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label> إمكانية التعليق</label><br>
                                <label for=""><input type="checkbox" name="can_comment" @if($sheikh->can_comment) checked @endif  data-toggle="toggle"></label>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-4">
                            <div class="form-group"><br>
                                <label>تجميد حساب هذا الشيخ؟</label>
                                <label for=""><input type="checkbox" name="banned" @if($sheikh->banned) checked @endif data-toggle="toggle"></label>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-4">
                            <div class="form-group"><br>
                                <label>إمكانية إضافة روابط دردشة؟</label>
                                <label for=""><input type="checkbox" name="can_add_meets" @if($sheikh->can_add_meets) checked @endif data-toggle="toggle"></label>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                    </div><!--End Row-->
                </div><!--End Form-body-->
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn" type="submit"> تعديل الشيخ <i class="fa fa-plus" style="margin-right: 10px"> </i></button>
                        </div><!--End Col-->
                    </div><!--End Row-->
                </div><!--End Form-action-->
            </form><!-- End row -->
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->

@stop