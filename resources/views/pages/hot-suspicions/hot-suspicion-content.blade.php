
@extends('layouts.master')
@section('content')

<style>
    .fa-file {
        font-size: 35px;
        color: #93c73e;
        margin-right: 10px
    }

    .book-cont h3 a {
        color: #93c73e;
    }
</style>

<section>
    <div class="box-item">
        <div class="box-item-head">
            <h3 class="title">{{$suspicion->suspicion}}</h3>
            <i class="fa fa-angle-down"></i>
        </div><!-- End Box-Item-Head -->
        <div class="box-item-content">
            <form class="form" id="upload_form" method="POST" action="{{route('post-update-hot-suspicion-content', ['id' => $suspicion->id])}}" enctype="multipart/form-data">
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
                            <div class="form-group ar">
                                <label> نص الشبُهة الساخنة</label>
                                <input type="text" name="suspicion" class="form-control" value="{{$suspicion->suspicion}}">
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->
            
                        <div class="col-md-12">
                            <div class="form-group ar">
                                <label>الرد المُختصر</label>
                            <textarea name="short_reply" class="form-control summernote" id="short_reply" cols="30" rows="6">{!! html_entity_decode($suspicion->short_reply) !!}</textarea>
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->

                        <div class="col-md-12">
                            <div class="form-group ar">
                                <label>الرد المٌطول</label>
                                <textarea name="long_reply" class="form-control summernote" id="long_reply" cols="30" rows="10">{!! html_entity_decode($suspicion->long_reply) !!}</textarea>
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->


                        <div class="col-md-12">
                            <div class="form-group ar">
                                <label class="lead">الفيديو</label>
                                <button class="custom-btn pull-right video-toglgloer"> تعديل الفيديو</button>
                                <button class="custom-btn pull-right video-button" style="display: none"> الفيديو المٌحمل</button>
                                <div class="video-player" width="50%">
                                    <div style="margin:auto">
                                        @if($suspicion->video_url)
                                            <video  height="300" controls  style="border: 3px solid #033230;">
                                                <source src="{{url('storage/uploads/videos/hot-suspicions/1.mp4')}}">
                                            </video>
                                        @else 
                                            <h3>لا يوجد فيدو مُرفق!</h3>
                                        @endif
                                    </div>
                                </div>
                                
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->
                        
                        <div class="col-md-12">
                            <div class="form-group video-upload" style="display: none">
                                <label >الفيديو</label>
                                <div class="choose-img">
                                    <input type="file" name="file1" id="file1">
                                    <p>اضغط لتحميل الفيديو</p>
                                </div><!-- End Choose-Img -->
                            </div><!-- End Form-Group -->
                        </div>

                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="lead">الكتاب:</label>
                                    <div class="book-cont">
                                        <h3>اسم الكتاب: 
                                            @if($suspicion->book_url)<strong><a target="_blank" href="{{url('storage/uploads/books/hot-suspicions/AAT BIO.pdf')}}">{{$book_name}}</a></strong><i class="fa fa-file"></i>
                                            @else
                                                لا يوجد كتاب مٌرفق!
                                            @endif
                                        </h3>
                                    </div>

                                    <button class="custom-btn pull-right book-toglgloer"> تعديل الكتاب</button>
                                    <button class="custom-btn pull-right book-button" style="display: none"> الكتاب المٌحمل</button>
                                </div>
                            </div>
                         
                        <div class="col-md-12">
                            <div class="form-group book-upload" style="display: none">
                                <label>الكتاب</label>
                                <div class="choose-img">
                                    <input type="file" name="file2" id="file2">
                                    <p>اضغط لتحميل الكتاب</p>
                                </div><!-- End Choose-Img -->
                                  <h3 id="status"></h3>
                                  <p id="loaded_n_total"></p>
                                </div><!--End upload-action-->
                            </div><!-- End Form-Group -->
                        </div>
                    </div><!--End Row-->                   
                    
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn pull-right" type="submit"> تعديل الشبهة</button>
                        </div><!--End Col-->
                    </div><!--End Row-->
                </div><!--End Form-action-->
            </form><!-- End row -->
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->

<script src="{{asset('assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script>
    $('.video-toglgloer').on('click', function(event) {
        event.preventDefault();
        $('.video-player').hide();
        $('.video-upload').show();
        $(this).hide();
        $('.video-button').show();
    });

    $('.video-button').on('click', function(event) {
        event.preventDefault();
        $('.video-player').show();
        $('.video-upload').hide();
        $(this).hide();
        $('.video-toglgloer').show();
        $('.video-upload').hide();
    });

    $('.book-toglgloer').on('click', function(event) {
        event.preventDefault();
        $('.book-player').hide();
        $('.book-upload').show();
        $(this).hide();
        $('.book-button').show();
    });

    $('.book-button').on('click', function(event) {
        event.preventDefault();
        $('.book-player').show();
        $('.book-upload').hide();
        $(this).hide();
        $('.book-toglgloer').show();
        $('.book-upload').hide();
    });
</script>

@endsection