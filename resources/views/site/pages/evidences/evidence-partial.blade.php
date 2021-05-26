
@foreach($sucpicionChilds as $child)
    <tr data-id="{{$child->id}}" data-leaf="{{count($child->childrenEvidences) ? 0 : 1}}"  data-parent="{{$dataParent}}" data-level = "{{++$dataLevel}}" style="color: #a48020">
        <td data-column="name" data-leaf="{{count($child->childrenEvidences) ? 0 : 1}}" style="border-top:none; cursor: pointer">
            @if(count($child->childrenEvidences))
                <i class="fa fa-folder" style="padding-left: 5px"> </i>{{$child->title}}
                @else 
                <i class="fa fa-file" style="padding-left: 5px"> </i>
            @endif
            @if(!(count($child->childrenEvidences)))
                {{$child->title}}
            @endif
        </td>
    </tr>
    @if(count($child->childrenEvidences))
        @include('site.pages.evidences.evidence-partial',['sucpicionChilds' => $child->childrenEvidences, 'dataParent' => $child->id , 'dataLevel' => $dataLevel])

    @endif
@endforeach
