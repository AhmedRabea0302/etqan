
@foreach($evidenceChilds as $child)
    <tr data-id="{{$child->id}}"  data-parent="{{$dataParent}}" data-level = "{{++$dataLevel}}">
        <td data-column="name">
            <a href="" class="btn btn-info delete-button" style="float: left"> <i class="fa fa-trash"></i></a>
            <a href="" class="btn btn-info edit-button" style="float: left" data-toggle="modal" data-target="#myModal"> <i class="fa fa-pencil"></i></a>

            @if(count($child->childrenEvidences))
            <i class="fa fa-folder"> </i>
            @else 
            <i class="fa fa-file"> </i>
            @endif
            @if(!(count($child->childrenEvidences)))
                <a href="{{route('evidence-content', ['id'=> $child->id])}}" style="color: #fff">{{$child->title}}</a>
            @endif
        </td>
    </tr>
    @if(count($child->childrenEvidences))
        @include('pages.evidences.evidence-partial',['evidenceChilds' => $child->childrenEvidences, 'dataParent' => $child->id , 'dataLevel' => $dataLevel])
    @endif
@endforeach
