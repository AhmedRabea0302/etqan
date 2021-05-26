
@foreach($discussionChilds as $child)
    <tr data-id="{{$child->id}}"  data-parent="{{$dataParent}}" data-level = "{{++$dataLevel}}">
        <td data-column="name">
            <a href="" class="btn btn-info delete-button" style="float: left"> <i class="fa fa-trash"></i></a>
            <a href="" class="btn btn-info edit-button" style="float: left" data-toggle="modal" data-target="#myModal"> <i class="fa fa-pencil"></i></a>

            @if(count($child->childrenDiscussions))
            <i class="fa fa-folder"> </i>
            @else 
            <i class="fa fa-file"> </i>
            @endif
            @if(!(count($child->childrenDiscussions)))
                <a href="{{route('discussion-content', ['id'=> $child->id])}}" style="color: #fff">{{$child->title}}</a>
            @endif
        </td>
    </tr>
    @if(count($child->childrenDiscussions))
        @include('pages.discussions.discussion-partial',['discussionChilds' => $child->childrenDiscussions, 'dataParent' => $child->id , 'dataLevel' => $dataLevel])
    @endif
@endforeach

{{-- @else 
<tr data-id="{{$child->id}}" data-parent="{{$dataParent}}" data-level="{{$dataLevel}}">
    <td class="reply-text" data-column="name">
        @if($discussion->link)
            <div class="col-md-12">
                <div class="form-group ar">
                    <label style="color: #fff">رابط الفيديو</label>
                    <input readonly name="title" value="{{$discussion->link}}" class="form-control  video-link" type="text"/>
                </div><!-- End Form-Group -->
            </div><!-- End col -->
        @endif
        
        <hr width="100%" style="height: 2px; background: #fff; border: none">
        <div class="col-md-12">
            <div class="form-group ar">
                <label style="color: #fff">الفيديو</label>
                <div class="video-player">
                    <video width="100%" height="300" controls >
                        <source src="{{url('storage/uploads/videos/discussions')}}/{{$discussion->video_name}}">
                    </video>
                </div>
            </div><!-- End Form-Group -->
        </div><!-- End col -->
        
        <hr width="100%" style="height: 2px; background: #fff; border: none">
        <div class="col-md-12">
            <div class="form-group ar">
                <label style="color: #fff">وصف تفصيلي للفيديو</label>
                <textarea readonly name="details" class="form-control video-details" rows="6" style="color: #fff">
                    {!! html_entity_decode($discussion->details) !!}
                </textarea>
            </div><!-- End Form-Group -->
        </div><!-- End col -->
    </td>
</tr>
{{-- @else 
@include('pages.suspicions.suspicion-reply',['suspicion' => $child, 'dataParent' => $child->id, 'dataLevel' => $dataLevel]) --}}
