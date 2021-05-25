<optgroup style="text-indent: 65px">
    @foreach($marsadChilds as $child)
         dd($child); 
        <option style="text-indent: 65px" value="{{$child->id}}">{{$child->marsad}}</option>
        @if(count($child->childrenMarsads))
            @include('pages.marsads.marsads-optiongroup-partial',['marsadChilds' => $child->childrenMarsads])
        @endif
    @endforeach
</optgroup>
<hr style="background: #f12; height: 2px">
