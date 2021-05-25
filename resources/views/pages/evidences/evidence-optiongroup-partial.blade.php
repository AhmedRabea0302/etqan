<optgroup style="text-indent: 65px">
    @foreach($evidenceChilds as $child)
        <option style="text-indent: 65px" value="{{$child->id}}">{{$child->title}}</option>
        @if(count($child->childrenEvidences))
            @include('pages.evidences.evidence-optiongroup-partial',['evidenceChilds' => $child->childrenEvidences])
        @endif
    @endforeach
</optgroup>
