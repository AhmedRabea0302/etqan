
@foreach($sucpicionChilds as $child)
    <tr data-id="{{$child->id}}" data-leaf="{{count($child->childrenSuspicions) ? 0 : 1}}"  data-parent="{{$dataParent}}" data-level = "{{++$dataLevel}}" style="color: #a48020">
        <td data-column="name" data-leaf="{{count($child->childrenSuspicions) ? 0 : 1}}" style="border-top:none; cursor: pointer">
            @if(count($child->childrenSuspicions))
                <i class="fa fa-folder" style="padding-left: 5px"> </i>{{$child->suspicion}}
                @else 
                <i class="fa fa-file" style="padding-left: 5px"> </i>
            @endif
            @if(!(count($child->childrenSuspicions)))
                {{$child->suspicion}}
            @endif
        </td>
    </tr>
    @if(count($child->childrenSuspicions))
        @include('site.pages.suspicions.suspicion-partial',['sucpicionChilds' => $child->childrenSuspicions, 'dataParent' => $child->id , 'dataLevel' => $dataLevel])

    @endif
@endforeach
