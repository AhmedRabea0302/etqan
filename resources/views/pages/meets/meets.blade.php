@extends('layouts.master')
@section('content')
    
<section>
    <div class="box-item">
        <div class="box-item-head">
        <h3 class="title">إضافة رابط حدث</h3>
        </div><!-- End Box-Item-Head -->
        
        <div class="box-item-content">
        <form class="form" id="upload_form" enctype="multipart/form-data" method="POST" action="{{route('add-meet')}}">

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
                                <input class="form-control" type="text" name="title">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-12-->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>رابط الحدث</label>
                                <input class="form-control" style="font-family: sans-serif" type="text" name="link">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-12-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>تاريخ الحدث</label>
                                <input class="form-control" style="font-family: sans-serif" type="date" name="date">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-12-->

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>توقيت الحدث</label>
                                <input class="form-control" style="font-family: sans-serif" type="time" name="time">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-12-->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>تفاصيل الحدث</label>
                                <textarea class="form-control" name="details" rows="4"></textarea>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-12-->

                        <div class="col-md-4">
                            <div class="form-group"><br>
                                <label>تفعيل الحدث</label>
                                <br>
                                <label for=""><input type="checkbox" name="status"  data-toggle="toggle"></label>
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->

                    </div><!--End Row-->
                </div><!--End Form-body-->
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn" type="submit"> إضافة حدث <i class="fa fa-plus" style="margin-right: 10px"> </i></button>
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
            <h3 class="title">الأحداث المُضافة</h3>
            <i class="fa fa-angle-down"></i>
        </div><!-- End Box-Item-Head -->
        <div class="box-item-content">
            <table class="table table-striped" id="sample_editable_1">
                <thead>
                    <tr>
                        <th>عنوان الحدث</th>
                        <th>رابط الحدث</th>
                        <th>تفاصيل الحدث</th>
                        <th>حالة الحدث</th>
                        <th> العمليات </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($meets as $meet)
                        <tr>
                            <td>{{$meet->title}}</td>
                            <td class="meet-link">
                                {{$meet->link}}
                            </td>
                            <td>
                               {{substr($meet->details,0, 80)}} ...
                            </td>
                            <td>
                                <span class="label @if($meet->status == 0)  label-danger @elseif($meet->status == 1) label-success @endif">
                                    <i class="fa fa-times"></i>
                                    @if($meet->status == 0)  غير مفعل @elseif($meet->status == 1) مفعل @endif
                                </span>
                            </td>
                            <td>
                               <!-- Single button -->
                                <div class="btn-group">
                                    <button type="button" class="custom-btn small dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    إعدادات <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu meets-table">
                                        <form action="{{ route('alter-meet', ['id'=> $meet->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            <li><button type="submit">@if($meet->status == 0)  تفعيل الحدث @elseif($meet->status == 1) تعطيل الحدث @endif</button> </li>
                                        </form>

                                    <li><a href="{{ route('get-update-meet', ['id'=> $meet->id]) }}">تعديل الحدث</a> </li>
                                    
                                    <li><a href="{{route('delete-meet', ['id' => $meet->id])}}">حذف الحدث</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {{-- {!! $meets->render() !!} --}}
                    
                </tbody>
            </table>
            <div lang="rtl">
                {{ $meets->links() }}
            </div>
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->

@endsection