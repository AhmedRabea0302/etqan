@extends('site.layouts.master')
@section('content')

    <section class="main share-section">

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
    
                    <div class="leftbox">
                        <div class="row">
                            <div class="subject-header col-md-12">
                                <h2> @if($suspicion) {!! $suspicion->suspicion !!} @endif </h2>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-12">
                                <p class="lead leada">الرد المختصر</p>
                                <div class="subject-content">
                                   @if($suspicion)  {!! $suspicion->short_reply !!} @endif
                                </div>
                            </div>

                            <div class="subject-options">
                                <ul class="list-unstyled">
                                    <button class="btn btn-info full-screen" title="شاشة كاملة"><i class="fa fa-expand"></i></button>
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <p class="lead leada">الرد المطول</p>
                                <div class="subject-content">
                                    @if($suspicion)  {!! $suspicion->long_reply !!} @endif
                                </div>
                            </div>

                            <div class="subject-options">
                                <ul class="list-unstyled">
                                    <button class="btn btn-info full-screen" title="شاشة كاملة"><i class="fa fa-expand"></i></button>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group ar">
                                <label class="lead">الفيديو</label>
                                <div class="video-player">
                                    <div style="margin:auto">
                                        @if($suspicion->video_url)
                                            <video  height="300" controls >
                                                <source src="{{url('storage/uploads/videos/suspicions/1.mp4')}}">
                                            </video>
                                        @else 
                                            <h3 class="no-book">لا يوجد فيدو مُرفق!</h3>
                                        @endif
                                    </div>
                                </div>
                                
                            </div><!-- End Form-Group -->
                        </div><!-- End col -->
                        
                        <div class="col-md-12">
                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <br><br>
                                    <label class="lead">الكتاب:</label>
                                    <div class="book-cont">
                                        <h3>اسم الكتاب: 
                                            @if($suspicion->book_url)<strong><a target="_blank" href="{{url('storage/uploads/books/suspicions/AAT BIO.pdf')}}" class="no-book">{{$book_name}}</a></strong><i class="no-book fa fa-file"></i>
                                            @else
                                                لا يوجد كتاب مٌرفق!
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>
                         
                        </div><!--End Row-->                   
                    
    
                        <div class="row">
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="comments">
                            <h2 class="comments-header">التعليقات</h2>
                            @if($suspicionComments)
                                <ul class="list-unstyled">
                                    <div class="comments">
                                        
                                        @foreach ($suspicionComments as $comment)
                                            <div class="one-comment" data-id="${c.id}">
                                        
                                                <p class="">
                                                    <div class="comment-text">
                                                        <div>
                                                            <img src="{{$comment->image_url ? $comment->image_url : url("/storage/uploads/images/app_users/avatar.jpg") }}" class="img-responsive img-center comment-img">
                                                            <p class="comment-user-name">{{$comment->user_name}}</p>
                                                        </div>
                                                        <p class="comment">
                                                            {{$comment->comment}}
                                                            <div class="comment-date">
                                                                <i class="fa fa-calendar"></i>
                                                                <span>{{$comment->date}}</span>
                                                            </div>    
                                                        </p>
                                                    </div>
                                                </p>                               
                                                @if(count($comment->comment_replies))
                                                    <ul class='list-unstyled'>
                                                        <div class="comment-replies">
                                                            @foreach ($comment->comment_replies as $reply)
                                                                <li>
                                                                    <p class="">
                                                                        <div class="reply-text">
                                                                            <div>
                                                                                <img src="{{$reply->image_url ? $reply->image_url : url("/storage/uploads/images/app_users/avatar.jpg") }}" class="img-responsive img-center comment-img">
                                                                                <p class="comment-user-name">{{$reply->user_name}}</p>    
                                                                            </div>
                                                                            {{$reply->reply}}
                                                                            <p class="reply-date">
                                                                                <i class="fa fa-calendar"></i>
                                                                                <span>{{$reply->date}}</span>
                                                                            </p>    
                                                                        </div>
                                                                    </p>
                                                                </li>
                                                            @endforeach
                                                        </div>   
                                                    </ul>
                                                @endif
                                                
                                        
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </ul>
                            @else
                                <h2 class="no-comments">لا توجد تعليقات على هذا الموضوع!</h2>
                            @endif
                        </div>
                    </div>
    
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('assets/site/js/jquery.js')}}"></script>
    <!—- ShareThis BEGIN -—>
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5ff329610b50bc00198f439d&product=sticky-share-buttons" async="async"></script>
    <!—- ShareThis END -—>

    <script>
        let fullButtons = document.querySelectorAll('.full-screen');
        fullButtons.forEach( fullButton => {
            fullButton.addEventListener('click', () => {
                console.log(fullButton.parentElement.parentElement.previousElementSibling.children[1].requestFullscreen());
            });
        });

    </script>
@endsection