@extends('layouts.master')
@section('content')  
<style>

.infograps{
  --background-dark: #2d3548;
  --text-light: rgba(255,255,255,0.6);
  --text-lighter: rgba(255,255,255,0.9);
  --spacing-s: 8px;
  --spacing-m: 16px;
  --spacing-l: 24px;
  --spacing-xl: 32px;
  --spacing-xxl: 64px;
  --width-container: 1200px;
}

.infograps{
  border: 0;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.infograps{
  height: 100%;
  font-size: 14px;
}

.infograps{
  height: 100%;
}

.hero-section{
  align-items: flex-start;
  background-image: linear-gradient(15deg, #03312f  0%, #2a6973 150%);
  display: flex;
  min-height: 100%;
  justify-content: center;
  padding: var(--spacing-xxl) var(--spacing-l);
}

.card-grid{
  display: grid;
  grid-template-columns: repeat(1, 1fr);
  grid-column-gap: var(--spacing-l);
  grid-row-gap: var(--spacing-l);
  max-width: var(--width-container);
  width: 100%;
}

@media(min-width: 540px){
  .card-grid{
    grid-template-columns: repeat(2, 1fr); 
  }
}

@media(min-width: 960px){
  .card-grid{
    grid-template-columns: repeat(4, 1fr); 
  }
}

.card{
  list-style: none;
  position: relative;
}

.card:before{
  content: '';
  display: block;
  padding-bottom: 150%;
  width: 100%;
}

.card__background{
  background-size: cover;
  background-position: center;
  border-radius: var(--spacing-l);
  bottom: 0;
  filter: brightness(0.75) saturate(1.2) contrast(0.85);
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  transform-origin: center;
  trsnsform: scale(1) translateZ(0);
  transition: 
    filter 200ms linear,
    transform 200ms linear;
    border: 3px solid #93c73e;
}

.card:hover .card__background{
  transform: scale(1.05) translateZ(0);
  filter: brightness(1)
}

.card-grid:hover > .card:not(:hover) .card__background{
  filter: brightness(0.5) saturate(0) contrast(1.2) blur(20px);
}

.card__content{
  left: 0;
  padding: var(--spacing-l);
  position: absolute;
  top: 0;
}

.card__category{
  color: var(--text-light);
  font-size: 0.9rem;
  margin-bottom: var(--spacing-s);
  text-transform: uppercase;
}

.card__heading{
  color: var(--text-lighter);
  font-size: 1.9rem;
  text-shadow: 2px 2px 10px rgba(0,0,0,1);
  line-height: 1.4;
}

.card__content button.btn-info {
  float: right;
  background: #93c73e;
}

.card__content button.btn-danger {
  float: left;
  background: #d9534f;
}

.card__content button.btn-info, .card__content button.btn-danger {
  position: relative;
  top: 200px;
  border: none;
  font-size: 12px;
  transition: all ease-in-out 0.3s;
}

.card__content button.btn-info:hover {
  background: #3c763d;
}

.card__content button.btn-danger:hover {
  background: #851e1a;
}


</style>
<section>
    <div class="box-item">
        <div class="box-item-head">
        <h3 class="title">إضافة إنفوجرافيك</h3>
        </div><!-- End Box-Item-Head -->
        
        <div class="box-item-content">
        <form class="form" id="upload_form" enctype="multipart/form-data" method="POST" action="{{route('add-infograph')}}">

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
                                <label> الإنفوجرافيك</label>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>وصف الإنفوجرافيك</label>
                                <input class="form-control" type="text" name="caption">
                            </div><!--End Form-group-->
                        </div><!--End Col-md-6-->
                        
                    </div><!--End Row-->
                </div><!--End Form-body-->
                <div class="form-action">
                    <div class="row">
                        <div class="col-xs-12">
                            <button class="custom-btn" type="submit"> إضافة <i class="fa fa-plus" style="margin-right: 10px"> </i></button>
                        </div><!--End Col-->
                    </div><!--End Row-->
                </div><!--End Form-action-->
            </form><!-- End row -->
        </div><!-- End Box-Item-Content -->
    </div><!-- End Box-Item -->
</section><!--End Section-->

    <div class="box-item infograps">
        <div class="box-item-head">
            <h3 class="title">الإنفوجرافيك المُضافة</h3>
        </div><!-- End Box-Item-Head -->
        
        <div class="box-item-content"> 
          <section class="hero-section">
              <div class="card-grid">
                  @foreach ($infographs as $infograph)
                      <a class="card" href="#">
                          <div class="card__background" style="background-image: url({{url('storage/uploads/images/infographs')}}/{{ $infograph->image_name}})"></div>
                          <div class="card__content">
                            <h3 class="card__heading">{{$infograph->caption}}</h3>
                            <form action="{{route('get-update-infograph', ['id' => $infograph->id])}}" method="GET">
                              <button class="btn btn-info" type="submit">تعديل <i class="fa fa-pencil"></i></button>
                            </form>
                            <form action="{{route('post-delete-infograph', ['id' => $infograph->id])}}" method="POST">
                              {{csrf_field()}}
                              <button class="btn btn-danger" type="submit">حذف <i class="fa fa-trash"></i></button>
                            </form>
                          </div>
                      </a>
                  @endforeach
              <div>
          </section>
        </div>

        <div class="form-action">
          <div class="row">
              <div class="col-xs-12">
                <h3>بسم الله </h3>
              </div><!--End Col-->
          </div><!--End Row-->
        </div><!--End Form-action-->
        
    </div>
    <script>ajax.open("POST", "../../../assets/js/file_upload_parser.php");</script>
@endsection