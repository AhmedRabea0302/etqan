@extends('layouts.master')
@section('content')
<section>
    <div class="box-item">
        <div class="box-item-head">
            <h3 class="title">إضافة شبُهة جديد</h3>
            <i class="fa fa-angle-down"></i>
        </div><!-- End Box-Item-Head -->
        <div class="box-item-content">
            <form class="form" id="upload_form" method="POST" action="{{route('post-add-hot-suspicion')}}" enctype="multipart/form-data">
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
                {{ csrf_field()}}
                <div class="form-body">
                    <div class="row">
                    
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>اختر الفئة</label>
                                <select class="form-control parnt_nodes" name="parent_id">
                                    <option value="0">شبُهة رئيسية</option>
                                    @foreach ($allSuspicions as $suspicion)
                                        <option value="{{$suspicion->id}}">{!!html_entity_decode( $suspicion->suspicion)!!}</option>
                                        
                                        {{-- @if($suspicion->childrenSuspicions)
                                            @include('pages.suspicions.suspicion-optiongroup-partial',['sucpicionChilds' => $suspicion->childrenSuspicions])
                                        @endif --}}
                                    @endforeach
                                </select>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>اختر المستوى</label>
                                <select class="form-control objlevel" name="level" id="objlevel">
                                    <option value="0">شبُهة فرعية</option>
                                    <option value="1">شبُهة نهائية</option>
                                </select>
                            </div><!--End Form-group-->
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group ar">
                                <label>نص الشبُهة</label>
                                <textarea name="suspicion" class="form-control" id="" cols="30" rows="4"></textarea>
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->

                        <div class="col-md-12">
                            <div class="form-group ar">
                                <label>الرد المُختصر</label>
                                <textarea name="short_reply" class="form-control summernote" id="short_reply" cols="30" rows="6"></textarea>
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->

                        <div class="col-md-12">
                            <div class="form-group ar">
                                <label>الرد المٌطول</label>
                                <textarea name="long_reply" class="form-control summernote" id="long_reply" cols="30" rows="10"></textarea>
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>فيديو الشبهة</label>
                                <div class="choose-img">
                                    <input type="file" name="file1" id="file1">
                                    <p>اضغط لتحميل الفيديو</p>
                                </div><!-- End Choose-Img -->

                                <div class="upload-action">
                                    <button class="upload-btn" type="button" id="upload-btn">
                                        تحميل الفيديو
                                    </button>
                                    <div class="progress">
                                        <div id="progressBar" value="0" max="100" class="progress-bar" role="progressbar" style="width: 0%;">0%
                                        </div>
                                    </div>
                                  <h3 id="status"></h3>
                                  <p id="loaded_n_total"></p>
                                </div><!--End upload-action-->
                            </div><!-- End Form-Group -->
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>كتاب عن الشبهة</label>
                                <div class="choose-img">
                                    <input type="file" name="file2" id="file2">
                                    <p>اضغط لتحميل الكتاب</p>
                                </div><!-- End Choose-Img -->

                                <div class="upload-action">
                                    <button class="upload-btn" type="button" id="upload-book">
                                        تحميل الكتاب
                                    </button>
                                    <div class="progress book-progrss">
                                        <div id="progressBar2" value="0" max="100" class="progress-bar" role="progressbar" style="width: 0%;">0%
                                        </div>
                                    </div>
                                  <h3 id="status2"></h3>
                                  <p id="loaded_n_total2"></p>
                                </div><!--End upload-action-->
                            </div><!-- End Form-Group -->

                    </div><!--End Row-->
                    
                </div><!--End Form-body-->
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn pull-right" type="submit">إضافة شبُهة</button>
                        </div><!--End Col-->
                    </div><!--End Row-->
                </div><!--End Form-action-->
            </form><!-- End row -->
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->

<script>
    document.getElementById('short_reply').parentNode.style.display = 'none';
    document.getElementById('long_reply').parentNode.style.display = 'none';
    document.getElementById('file1').parentNode.parentNode.style.display = 'none';
    document.getElementById('file2').parentNode.parentNode.style.display = 'none';
    document.getElementById('objlevel').parentNode.style.display = 'none';

    let select = document.querySelector('.parnt_nodes');
    let level = document.getElementById('objlevel');
    
    select.onchange = function() {

        if(select.value != 0) {
            document.getElementById('objlevel').parentNode.style.display = 'block';
            level.onchange = function() {
                if(level.value == 1) {
                    document.getElementById('short_reply').parentNode.style.display = 'block';
                    document.getElementById('long_reply').parentNode.style.display = 'block';
                    document.getElementById('file1').parentNode.parentNode.style.display = 'block';
                    document.getElementById('file2').parentNode.parentNode.style.display = 'block';
                } else {
                    document.getElementById('short_reply').parentNode.style.display = 'none';
                    document.getElementById('long_reply').parentNode.style.display = 'none';
                    document.getElementById('file1').parentNode.parentNode.style.display = 'none';
                    document.getElementById('file2').parentNode.parentNode.style.display = 'none';
                }
            }
            
        } else {
            document.getElementById('objlevel').parentNode.style.display = 'none';
            document.getElementById('short_reply').parentNode.style.display = 'none';
            document.getElementById('long_reply').parentNode.style.display = 'none';
            document.getElementById('file1').parentNode.parentNode.style.display = 'none';
            document.getElementById('file2').parentNode.parentNode.style.display = 'none';
        }
    }
    
</script>
@endsection