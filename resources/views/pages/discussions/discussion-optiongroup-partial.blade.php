<optgroup style="text-indent: 65px">
    @foreach($discussionChilds as $child)
        <option style="text-indent: 65px" value="{{$child->id}}">{{$child->title}}</option>
        @if(count($child->childrenSuspicions))
            @include('pages.discussionss.discussionss-optiongroup-partial',['discussionChilds' => $child->childrenDiscussions])
        @endif
    @endforeach
</optgroup>
