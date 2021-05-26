
@foreach($discussionChilds as $child)
    <tr data-id="{{$child->id}}" data-leaf="{{count($child->childrenDiscussions) ? 0 : 1}}"  data-parent="{{$dataParent}}" data-level = "{{++$dataLevel}}" style="color: #a48020">
        <td data-column="name" data-leaf="{{count($child->childrenDiscussions) ? 0 : 1}}" style="border-top:none; cursor: pointer">
            @if(count($child->childrenDiscussions))
                <i class="fa fa-folder" style="padding-left: 5px"> </i>{{$child->title}}
                @else 
                <i class="fa fa-file" style="padding-left: 5px"> </i>
            @endif
            @if(!(count($child->childrenDiscussions)))
                {{$child->title}}
            @endif
        </td>
    </tr>
    @if(count($child->childrenDiscussions))
        @include('site.pages.discussions.discussion-partial',['discussionChilds' => $child->childrenDiscussions, 'dataParent' => $child->id , 'dataLevel' => $dataLevel])

    @endif
@endforeach
