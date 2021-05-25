<optgroup style="text-indent: 65px; padding-right: 30px">
    @foreach($sucpicionChilds as $child)
        <option style="text-indent: 65px" value="{{$child->id}}">{{$child->suspicion}}</option>
        @if(count($child->childrenSuspicions))
        <optgroup style="text-indent: 65px; padding-right: 30px">

            @include('pages.suspicions.suspicion-optiongroup-partial',['sucpicionChilds' => $child->childrenSuspicions])
        </optgroup>
        @endif
    @endforeach
</optgroup>
