@extends('layouts.master')
@section('content')
    
<section>
    <div class="box-item">
        <div class="box-item-head">
            <h3 class="title">إضافة مًدير</h3>
        </div><!-- End Box-Item-Head -->
        
        <div class="box-item-content">
        <form class="form" id="upload_form" enctype="multipart/form-data" method="POST" action="{{route('add-admin')}}">

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
                                <label>صورة المُدير</label>
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
                                <input class="form-control" type="text" name="admin_name">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>البريد الإلكتروني</label>
                                <input class="form-control" type="text" name="email">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>رقم الهاتف</label>
                                <input class="form-control" type="text" name="phone_number">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>كلمة السر </label>
                                <input class="form-control" type="password" name="password">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        
                    </div><!--End Row-->
                </div><!--End Form-body-->
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn" type="submit"> إضافة مُدير <i class="fa fa-plus" style="margin-right: 10px"> </i></button>
                        </div><!--End Col-->
                    </div><!--End Row-->
                </div><!--End Form-action-->
            </form><!-- End row -->
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->

<section>
    <div class="box-item">
        <div class="box-item-head">
            <h3 class="title">بيانات المُدراء</h3>
            <i class="fa fa-angle-down"></i>
        </div><!-- End Box-Item-Head -->
        <div class="box-item-content">
            <table class="table table-striped" id="sample_editable_1">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> الصورة </th>
                        <th> الإسم </th>
                        <th> رقم الهاتف </th>
                        <th> انشئ منذ </th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        
                        <tr>
                            <td> {{$user->id}} </td>
                            <td> 
                                <img src="{{url('storage/uploads/images/admins/')}}/{{$user->file1 }}">
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->phone_number}}                   
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($user->created_at)->diffForHumans()}}
                            </td>
                            <td>
                                <!-- Single button -->
                                <div class="btn-group">
                                <button type="button" class="custom-btn small dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    إعدادات <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('get-admin-edit-page', ['id' => $user->id])}}">تعديل</a></li>
                                    <li><a href="{{route('delete-admin', ['id' => $user->id])}}">مسح</a></li>
                                </ul>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                   
                </tbody>
            </table>
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->

@stop