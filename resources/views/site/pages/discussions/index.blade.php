@extends('site.layouts.master')
@section('content')
<style>
    .table tr td {
        border-top: none
    }
</style>
    <!-- TREE SECTION ====================================================== -->
    <section class="main">
        <div class="container">
            <div class="row">
                <br>
                <div class="col-md-4 right-box">
                    <table id="tree-table" class="table">
                        <tbody>
                            <input type="text" name="" id="searchTree" class="form-control" placeholder="إبحث في الشجرة">
                            @if(!count($discussions))
                                <p class="lead text-center">لا توجد مناظرات</p>
                            @endif
                            @foreach($discussions as $discussion)
                                <tr data-id="{{$discussion->id}}" data-leaf="{{count($discussion->childrenDiscussions) ? 0 : 1}}" data-parent="0" data-level="1" style="color: #232323;">
                                    <td data-column="name" data-leaf="{{count($discussion->childrenDiscussions) ? 0 : 1}}" style=" border-top: none">
                                        @if(count($discussion->childrenDiscussions))
                                            <i class="fa fa-folder"> </i>
                                        @else 
                                            <i class="fa fa-file"> </i>
                                        @endif 
                                        {{$discussion->title}}
                                    </td>
                                </tr>
                                @if(count($discussion->childrenDiscussions))
                                    @include('site.pages.discussions.discussion-partial',['discussionChilds' => $discussion->childrenDiscussions, 'dataParent' => $discussion->id , 'dataLevel' => 1])
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
    
                <div class="col-md-8 leftbox">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="subject-content">
                                <div class="subject-content-share">
                                    <div class="alert alert-success success-favorite-message" style="display: none; margin-right: 15px">
                                        <p class=""></p>
                                    </div>
                                    <div class="subject-header col-md-8">
                                        <h2></h2>
                                    </div>

                                    <div class="subject-share col-md-4">
                                        <ul class="list-unstyled">

                                            @if(auth()->guard('auth-site')->check())
                                                <li class="read-later"><a href="#"><i class="fa fa-clock-o"></i></a></li>
                                            @endif

                                            @if(auth()->guard('auth-site')->check())
                                                <li class="add-favorite" data-id=""><a href="#"><i class="fa fa-star"></i></a></li>
                                            @endif
                                            <li class="share-content" data-id=""><a href="#"><i class="fa fa-share-alt"></i></a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="subject-content-text">
                                    <p class="lead no-text text-center" style="margin-top: 180px">قم بإختيار مناظرة !</p>
                                </div>

                                <div class="subject-content-controls">

                                    <div class="row">
                                        <div class="subject-options">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <div class="short-reply">
                                                        <i class="fa fa-link"></i> 
                                                    </div>
                                                    <span>رد مختصر</span>
                                                </li>
            
                                                <li>
                                                    <div class="long-reply">
                                                        <i class="fa fa-align-right"></i> 
                                                    </div>
                                                    <span>رد مطول</span>
                                                </li>
            
                                                <li>
                                                    <div class="video-url" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-video-camera"></i> 
                                                    </div>
                                                    <span>فيديو</span>
                                                </li>
            
                                                <li>
                                                    <div class="book-url"  data-toggle="modal" data-target="#BookModal">
                                                        <i class="fa fa-book"></i> 
                                                    </div>
                                                    <span>كتاب</span>
                                                </li>

                                                <li>
                                                    <div class="comments-icon"  class="comments-icon"  data-id="" data-toggle="modal" data-target="#commentsModal">
                                                        <i class="fa fa-comment"></i> 
                                                    </div>
                                                    <span>التعليقات</span>
                                                </li>
            
                                                <button class="btn btn-info full-screen"><i class="fa fa-expand"></i></button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>

    <!-- Video Modal -->
    <div id="myModal" class="modal videomodal fade" role="dialog">
        <div class="modal-dialog box-item">

            <!-- Modal content-->
            <div class="modal-content">
                
                <a class="modal-header box-item-head">
                    <h4>فيديو الشبهة</h4>
                </a>
                
                <div id="video-parent" class="modal-body  box-item-content">
                
                </div>
            </div>

        </div>
    </div>

    <!-- BOOK MODAL -->
    <div id="BookModal" class="modal bookmodal fade" role="dialog">
        <div class="modal-dialog box-item">

            <!-- Modal content-->
            <div class="modal-content">
                
                <a class="modal-header box-item-head">
                    <h4>كتاب عن الشبهة</h4>
                </a>
                
                <div class="modal-body  box-item-content">
                    <div class="book-shower"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Comments Modal -->
    <div id="commentsModal" class="modal fade" role="dialog">
        <div class="modal-dialog box-item">

            <!-- Modal content-->
            <div class="modal-content" style="background: transparent; box-shadow: none; border: none">
                
                <div class="row">
                    <div class="comments">
                        <h2 style="display: none">التعليقات</h2>
                        <ul class="list-unstyled">

                        </ul>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <div class="row">
                    <div class="add-comment-form">
                        <form action="" method="POST">
                            <div class="alert alert-success success-message" style="display: none">
                                <p class=""></p>
                            </div>
                            @if(!auth()->guard('auth-site')->check())
                                <p class="lead"> 
                                    للتمكن من إضافة تعليق من فضلك قم بتسجيل الدخول أولا!
                                    <a class="comment-login" href="{{route('site-login')}}">تسجيل الدخول</a>
                                </p>
                            @endif
                            @if(auth()->guard('auth-site')->check())
                                <div class="form-group">
                                    <textarea rows="3" name="comment" id="comment" class="form-control" required></textarea>
                                </div>

                                <button class="btn btn-default" type="submit">إضافة تعليق <i class="fa fa-plus"></i></button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{asset('assets/site/js/jquery.js')}}"></script>
    <script src="{{asset('assets/site/js/treeView.min.js')}}"></script>

    <script>

        // Content Text Vars
        let subHeader  = document.querySelector('.subject-header h2');
        let textshower = document.querySelector('.subject-content-text');
        let commentsSection =  document.querySelector('.comments');

        // Get Comments
        let commentsIcon = document.querySelector('.comments-icon');
        let commentsUl = document.querySelector('.comments ul');
        let commentTitle = document.querySelector('.comments h2');
        commentTitle.classList.remove('no-comments');

        // Add Comment Form
        let addCommentForm = document.querySelector('.add-comment-form');
        addCommentForm.style.display = 'none';

        let shortReply, longReply, videoUrl, bookUrl, marsadUrl, bookName, comments, $id;

        // Subject Whiten Background Color
        subHeader.parentElement.style.background = '#fff';

        if(subHeader.innerText == '') {
            $('.subject-options').css('display', 'none');
            $('.subject-share').css('display', 'none');
        }

        $('tr').on('click', function(event) {
            $(this).addClass('glyphicon-chevron-left:before');
        });

        $('tr td').on('click', function(event) {

            $id = $(this).parent().attr('data-id');
            $leaf = $(this).attr('data-leaf');
            commentTitle.classList.remove('no-comments');
            addCommentForm.style.display ='none';

            // RESET VARS
            videoUrl = '';
            bookUrl  = '';

            if($leaf == 1 ) {

                // Set The Selected Object Color
                $('tr td[data-leaf="1"]').css({color: '#a48020', borderBottom: '1px solid #a48020'});
                $(this).css({color: '#5d991d', borderBottom: '2px solid #5d991d'});


                // set Share Icon data-id
                document.querySelector('.share-content').setAttribute('data-id', $id);


                // Resetig Comments Section Data
                commentsUl.innerHTML = '';
                commentTitle.innerText = '';

                $.ajax({
                    type: "GET",
                    url: '{{url('/discussion/')}}' + '/' + $id, // This is what I have updated
                }).done(function( data ) {
                    let suspicion = data;

                    // Set the subject headersubHeader
                    subHeader.textContent = suspicion.title;

                    // Set The Header Background
                    // subHeader.parentElement.style.background = '#a48020';
                    
                    // Set the subject Content
                    textshower.innerHTML = suspicion.short_reply;
                    shortReply = suspicion.short_reply;
                    longReply  = suspicion.long_reply;
                    videoUrl   = suspicion.video_url;
                    bookUrl    = suspicion.book_url;

                    // GET BOOK NAME 
                    if(bookUrl != '') {
                        bookName = bookUrl.split('/').pop();
                    }
                    
                    marsadUrl  = 'http://marasad.com';

                    // Show Options Box
                    $('.subject-options').css('display', 'block');

                    // Show Share Box
                    $('.subject-share').css('display', 'block');

                }).error((msg) => console.log(msg));
            
            }
        });

        $('.short-reply').on('click', function() {
            if(shortReply != '') {
                textshower.innerHTML = shortReply;
            }
        });

        $('.long-reply').on('click', function() {
            if(longReply != '') {
                textshower.innerHTML = longReply;
            }
        });

        $('.video-url').on('click', function() {
            console.log('VIDEO URLXXXX: ', videoUrl);
            let videoParent = document.getElementById('video-parent');
            if(videoUrl != '') {
                
                let $videoPlayer = `
                    <video id="theVideo"  class="video-shower" controls="" autoplay="" name="media">
                        <source src="${videoUrl}" type="video/mp4">
                    </video>
                `;
                
                videoParent.innerHTML  = $videoPlayer;
                // console.log('MODAL XXXXX:', modal.classList);
            } else {
                videoParent.innerHTML = `<p class="lead text-center" style="margin-top: 20px">لايوجد فيديو للشبهة!</p>`;
            }
        });

        // Book Url 
        $('.book-url').on('click', function() {
            if(bookUrl != '') {
                document.querySelector('.bookmodal .modal-content').innerHTML = `
                    <p class="lead" style="color: #a48020; margin-top: 20px">اسم الكتاب: <a href="${bookUrl}" target="_blank">${bookName}</a></p>
                `;
            } else {    // SET MODAL TO NO BOOK HERE
                document.querySelector('.bookmodal .modal-content').innerHTML = 
                `<p class="lead text-center" style="font-size: 22px; margin-top: 20px">لايوجد كتاب للشبهة!</p>`; 
            }
        });

        commentsUl.innerHTML = '';
        
        $(commentsIcon).on('click', function() {
            commentsUl.innerHTML = '';
            commentTitle.style.display = 'none';
            commentTitle.classList.add('no-comments');
            addCommentForm.style.display = 'block';

            $.ajax({
                url: '{{url('/discussion-comments')}}' + '/' + $id,
                type: 'GET',
            }).done(function(data) {
                
                commentsSection.style.display = 'block';
                comments = data;
                if(comments.length != 0) {
                    commentTitle.style.display = 'block';
                    commentTitle.innerHTML = `
                        التعليقات
                        <span class="pull-right comments-number"><i class="fa fa-comment"></i>${comments.length}</span>
                    `;
                    comments.forEach( c => {
                        let comment = document.createElement('li');
                        comment.innerHTML = `
                            <div class="one-comment" data-id="${c.id}">
                                
                                <p class="">
                                    <div class="comment-text">
                                        <div>
                                            <img src="${c.image_url ? c.image_url : '{{url("/storage/uploads/images/app_users/avatar.jpg")}}'}" class="img-responsive img-center comment-img">
                                            <p class="comment-user-name">${c.user_name} ${c.country != null ? `<span> (${c.country} - ${c.city})</span>`: ''}</p>
                                        </div>
                                        <p class="comment">
                                            ${c.comment}
                                            <div class="comment-date">
                                                <i class="fa fa-calendar"></i>
                                                <span>${c.date}</span>
                                            </div>    
                                        </p>
                                    </div>
                                </p>                               
                                <ul class='list-unstyled'>
                                    
                                </ul>
                                <br>
                                
                                <div class="reply-form">
                                </div>
                                <div class="reply-button-parent">
                                    <div class="alert alert-success success-reply-message" style="display: none">
                                        <p class=""></p>
                                    </div>
                                    @if(auth()->guard('auth-site')->check())
                                        <textarea id="reply-input" class="form-control" rows="1" required></textarea>
                                        <button class="btn btn-default" type="submit">رد</button>
                                    @endif
                                </div>
                            </div>
                        `;
                        // Append Comment
                        commentsUl.appendChild(comment);
                        // Append Comment replies
                        if(c.comment_replies.length !== 0) {
                                console.log('REPLIES XXX: ', c.comment_replies);
                                c.comment_replies.forEach(r => {
                                let replyText = document.createElement('li'); 
                                replyText.innerHTML = `
                                    <p class="">
                                        <div class="reply-text">
                                            <div>
                                                <img src="${r.image_url ? r.image_url : '{{url("/storage/uploads/images/app_users/avatar.jpg")}}'}" class="img-responsive img-center comment-img">
                                                <p class="comment-user-name">${r.user_name} ${r.country != null ? `<span> (${r.country} - ${r.city})</span>`: ''}</p>    
                                            </div>
                                            ${r.reply}
                                            <p class="reply-date">
                                                <i class="fa fa-calendar"></i>
                                                <span>${r.date}</span>
                                            </p>    
                                        </div>
                                    </p>
                                `;
                                comment.childNodes[1].children[5].appendChild(replyText);
                                replyText.parentNode.classList.add('comment-replies');
                                
                            });
                        }
                        
                    });
                    window.scrollBy({
                        left: 0,
                        top: 250,
                        behavior: 'smooth'
                    });
                    console.log('COMMENTSXXX: ', comments);
                        document.querySelectorAll('.one-comment').forEach(comment => {
                            comment.addEventListener('click', event => {
                                let elements = Array.from(event.target.childNodes);
                                // console.log(elements[10]);
                                if(event.target.tagName == 'BUTTON') {
                                    console.log('Button Sib',  event.target.previousElementSibling);
                                    replyParent = event.target.parentElement.parentElement;
                                    reply = event.target.previousElementSibling.value;
                                    if(elements[10]) {
                                        // reply = event.target.previousElementSibling.value;
                                        replyRealParent = replyParent.querySelector('.comment-replies');
                                        console.log('Reply Parent',replyRealParent);

                                        addReply(reply, replyRealParent);
                                    } else {
                                        // reply = event.target.previousElementSibling.value;
                                        console.log(comment);
                                        comment.innerHTML += `<div class="comment-replies"></div>`;
                                        replyRealParent = replyParent.querySelector('.comment-replies');
                                        console.log('Reply Parent',replyRealParent);

                                        // comment.innerHTML += '<div class"reply-form commnet-replies">هنا الريبلاي</div>';
                                        addReply(reply, replyRealParent, replyParent);
                                    }
                                    
                                }
                            });
                        });
                        
                } else {
                    commentTitle.style.display = 'block';
                    commentTitle.classList.add('no-comments');
                    commentTitle.innerText = 'لا توجد تعليقات على هذا الموضوع بعد';
                    window.scrollBy({
                        left: 0,
                        top: 250,
                        behavior: 'smooth'
                    });
                }
                
            }).error(function(error) {
                console.log('Error', error)
            });
        });

        // Subject content Full Screen
        $full = document.querySelector('.subject-content-text');
        fullButton = document.querySelector('.full-screen');
        fullButton.addEventListener('click', function(){
            $full.style.backgroundColor = '#fff';
            $full.style.padding = '5px';
            $full.requestFullscreen();
        });


        // Add Comment
        $('.add-comment-form form').submit(function(e) {
            e.preventDefault();
            let commentValue = $('#comment').val();
            $.ajax({
                type: "POST",
                url: '{{url('discussion-add-comment')}}', // This is what I have updated
                data: {subject_id: $id, comment: commentValue, _token: '{{csrf_token()}}'}
            }).done(function( data ) {
                console.log('COMMENT ADDED SUCCESS: ', data);

                let comment = document.createElement('li');
                comment.innerHTML = `
                    <div class="one-comment">
                        <img src="${data.image_url ? data.image_url : '{{url("/storage/uploads/images/app_users/avatar.jpg")}}'}" class="img-responsive img-center comment-img">
                        <p class="comment-user-name">${data.user_name} ${data.country != null ? `<span> (${data.country} - ${data.city})</span>`: ''}</p>
                        <p class="">
                            <div class="comment-text">
                                ${data.comment}
                                <p class="comment-date">
                                    <i class="fa fa-calendar"></i>
                                    <span>${data.date}</span>
                                </p>
                            </div>
                        </p>                               
                        <ul class='list-unstyled'>
                            
                        </ul>
                    </div>
                `;
                
                $('.success-message').css('display', 'block');
                document.querySelector('.success-message p').innerText = 'تم إضافة تعليقك بنجاح';
                document.querySelector('#comment').value = '';
                commentsUl.appendChild(comment);

                setTimeout(() => {
                    $('.success-message').css('display', 'none');
                    document.querySelector('.success-message p').innerText = '';
                    document.querySelector('#comment').value = '';
                }, 2000)
            }).error((msg) => {
                // $('.success-message').css('display', 'block');
                // document.querySelector('.success-message p').innerText = 'من فضلك ادخل نص التعليق!';
            });

        });

        // Add Reply
        let addReply = function(replyText, replytParent, replyCommentGetter) {
            // let replyValue = $('#reply-input').val();
            console.log('Reply getter id commentXXXXXX: ',replyCommentGetter);
            let commentId  = replyCommentGetter.getAttribute('data-id');
            let repliesUl  = document.querySelector('.comment-replies');
            console.log('COMMENT ID: ', commentId);
            $.ajax({
                type: "POST",
                url: '{{url('/discussion-add-reply')}}', // This is what I have updated
                data: {subject_id: $id, reply: replyText, _token: '{{csrf_token()}}', comment_id: commentId}
            }).done(function( data ) {
                console.log('REPLY ADDED SUCCESS: ', data);

                let reply = document.createElement('li');
                reply.innerHTML = `
                    <div class="one-comment">
                        <img src="${data.image_url ? data.image_url : '{{url("/storage/uploads/images/app_users/avatar.jpg")}}'}" class="img-responsive img-center comment-img">
                        <p class="comment-user-name">${data.user_name} ${data.country != null ? `<span> (${data.country} - ${data.city})</span>`: ''}</p>
                        <p class="">
                            <div class="comment-text">
                                ${data.reply}
                                <p class="comment-date">
                                    <i class="fa fa-calendar"></i>
                                    <span>${data.date}</span>
                                </p>
                            </div>
                        </p>                               
                        <ul class='list-unstyled'>
                            
                        </ul>
                    </div>
                `;
                
                replytParent.appendChild(reply);
        
                }).error((msg) => {
                // console.log(msg);
                // $('.success-message').css('display', 'block');
                // document.querySelector('.success-reply-message p').innerText = 'من فضلك ادخل نص التعليق!';
            });
        }

        // Add to Favorite
        $('.add-favorite').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{url('/add-fav-discussion')}}/' + $id,
                type: 'POST',
                data: {_token: '{{ csrf_token()}}'}
            }).done((data) => {
                console.log(data);
                document.querySelector('.success-favorite-message').style.display = 'block';
                document.querySelector('.success-favorite-message p').innerText  = data.message;
                setTimeout(() => {
                    document.querySelector('.success-favorite-message').style.display = 'none';
                }, 4000);
                
            }).error((err) => {
                console.log(err.message);
            });
    
        });

        // Read Later
        $('.read-later').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{url('/read-discussion-later')}}/' + $id,
                type: 'POST',
                data: {_token: '{{ csrf_token()}}'}
            }).done((data) => {
                console.log(data);
                document.querySelector('.success-favorite-message').style.display = 'block';
                document.querySelector('.success-favorite-message p').innerText  = data.message;
                setTimeout(() => {
                    document.querySelector('.success-favorite-message').style.display = 'none';
                }, 4000);
                
            }).error((err) => {
                console.log(err.message);
            });
    
        });
        
        
        $('.share-content').on('click', function(e) {
            // Get Share Content page
            e.preventDefault();
            $.ajax({
                url: '{{url('/nosrah-discussion-content')}}/' + $id,
                type: 'GET',
            }).done(() => {
                window.open(`nosrah-discussion-content/${$id}`, '_blank');
            }).error(() => {

            });
    
        });

        // Filter The tree
        $('#searchTree').on('keyup', event => {
            let searchText = event.target.value;
            updatePicksTable(searchText);
            console.log(searchText);
        });

        function updatePicksTable(searchValue) {
            let picksTableRows = Array.from(document.querySelectorAll('#tree-table tr td'));
            console.log('ROWS: ', picksTableRows);
            matchedRows = picksTableRows.filter(row => {         
                return row.innerText.match(searchValue.toUpperCase());
            })
            picksTableRows.forEach(r => {
                if(!matchedRows.includes(r)) {
                    r.style.display = 'none';
                } else {
                    r.style.display = 'block';
                }
            });
            console.log('M ROWS', matchedRows);
        }



    </script>

@endsection