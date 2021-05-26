
    @foreach($sucpicionChilds as $child)
        <tr data-id="{{$child->id}}"  data-parent="{{$dataParent}}" data-level = "{{++$dataLevel}}">
            <td data-column="name">
                <a href="" class="btn btn-info delete-button" style="float: left"> <i class="fa fa-trash"></i></a>
                <a href="" class="btn btn-info edit-button" style="float: left" data-toggle="modal" data-target="#myModal"> <i class="fa fa-pencil"></i></a>
                @if(count($child->childrenSuspicions))
                <i class="fa fa-folder"> </i>
                @else 
                <i class="fa fa-file"> </i>
                @endif
                @if(!(count($child->childrenSuspicions)))
                    <a href="{{route('hot-suspicion-content', ['id'=> $child->id])}}" style="color: #fff">{{$child->suspicion}}</a>
                @endif
            </td>
        </tr>
        @if(count($child->childrenSuspicions))
            @include('pages.suspicions.suspicion-partial',['sucpicionChilds' => $child->childrenSuspicions, 'dataParent' => $child->id , 'dataLevel' => $dataLevel])
        @else 
        {{-- @else 
            @include('pages.suspicions.suspicion-reply',['suspicion' => $child, 'dataParent' => $child->id, 'dataLevel' => $dataLevel]) --}}
        @endif
    @endforeach
