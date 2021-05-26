<optgroup style="text-indent: 65px">
    @foreach($sucpicionChilds as $child)
        <option style="text-indent: 65px" value="{{$child->id}}">{{$child->suspicion}}</option>
        @if(count($child->childrenSuspicions))
            @include('pages.hot-suspicions.suspicion-hot-optiongroup-partial',['sucpicionChilds' => $child->childrenSuspicions])
        @endif
    @endforeach
</optgroup>
<hr style="background: #f12; height: 2px">
