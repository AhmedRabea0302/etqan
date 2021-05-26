@extends('layouts.master')
@section('content')



<section>
    <div class="box-item">
        <div class="box-item-head">
            <h3 class="title">إضافة مرصد</h3>
            <i class="fa fa-angle-down"></i>
        </div><!-- End Box-Item-Head -->
        <div class="box-item-content">
            <form class="form" id="upload_form" method="POST" action="{{route('post-add-marsad')}}" enctype="multipart/form-data">
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
                                <label>اختار الفئة</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">مرصد رئيس</option>
                                    @foreach ($marsads as $marsad)
                                        <option value="{{$marsad->id}}">{!!html_entity_decode( $marsad->marsad)!!}</option>
                                        @if($marsad->childrenMarsads)
                                            @include('pages.marsads.marsads-optiongroup-partial',['marsadChilds' => $marsad->childrenMarsads])
                                        @endif
                                    @endforeach
                                </select>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        
                        <div class="col-md-12">
                            <div class="form-group ar">
                                <label>عنوان المرصد</label>
                                <input name="marsad" class="form-control" type="text" />
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
                                <label>فيديو المرصد</label>
                                <div class="choose-img">
                                    <input type="file" name="file1" id="file1">
                                    <p>اضغط لتحميل الفيديو</p>
                                </div><!-- End Choose-Img -->
                            </div><!-- End Form-Group -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>كتاب عن المرصد</label>
                                <div class="choose-img">
                                    <input type="file" name="file2" id="file2">
                                    <p>اضغط لتحميل الكتاب</p>
                                </div><!-- End Choose-Img -->
                                <div class="upload-action">
                            </div><!-- End Form-Group -->
                        </div>

                    </div><!--End Row-->

                   
                    
                </div><!--End Form-body-->
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn pull-right" type="submit"> إضافة مرصد</button>
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

    let select = document.querySelector('select');
    select.onchange = function() {
        if(select.value == 0) {
            document.getElementById('short_reply').parentNode.style.display = 'none';
            document.getElementById('long_reply').parentNode.style.display = 'none';
            document.getElementById('file1').parentNode.parentNode.style.display = 'none';
            document.getElementById('file2').parentNode.parentNode.style.display = 'none';
        } else {
            document.getElementById('short_reply').parentNode.style.display = 'block';
            document.getElementById('long_reply').parentNode.style.display = 'block';
            document.getElementById('file1').parentNode.parentNode.style.display = 'block';
            document.getElementById('file2').parentNode.parentNode.style.display = 'block';
        }
    }
</script>

@endsection