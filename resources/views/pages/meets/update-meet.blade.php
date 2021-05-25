@extends('layouts.master')
@section('content')
    
        
<section>
    <div class="box-item">
        <div class="box-item-head">
        <h3 class="title">تعديل الحدث</h3>
        </div><!-- End Box-Item-Head -->
        
        <div class="box-item-content">
        <form class="form" id="upload_form" enctype="multipart/form-data" method="POST" action="{{route('update-meet', ['id' => $meet->id])}}">

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
                                <label>عنوان الحدث</label>
                                <input class="form-control" type="text" name="title" value="{{$meet->title}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-12-->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>رابط الحدث</label>
                                <input class="form-control" style="font-family: sans-serif" type="text" name="link" value="{{$meet->link}}">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-12-->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>تفاصيل الحدث</label>
                                <textarea class="form-control" name="details" rows="4">{{ $meet->details }}</textarea>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-12-->

                        <div class="col-md-4">
                            <div class="form-group"><br>
                                <label>تفعيل الحدث</label>
                                <br>
                                <label for=""><input type="checkbox" name="status"  @if($meet->status) checked @endif  data-toggle="toggle"></label>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                    </div><!--End Row-->
                </div><!--End Form-body-->
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn" type="submit"> تعديل الحدث <i class="fa fa-pencil" style="margin-right: 10px"> </i></button>
                        </div><!--End Col-->
                    </div><!--End Row-->
                </div><!--End Form-action-->
            </form><!-- End row -->
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->


@endsection