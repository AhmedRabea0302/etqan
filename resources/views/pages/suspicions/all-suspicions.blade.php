@extends('layouts.master')
@section('content')

<style>

.table {

}
.glyphicon {
  position: relative;
  float: left;
  top: 1px;
  display: inline-block;
  font-family: 'Glyphicons Halflings';
  font-style: normal;
  font-weight: 400;
  line-height: 1;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.table tbody tr {
    border: 1px solid #8dc641;
    background: #012d2b;
    color: #fff;
    margin-bottom: 5px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    transition: ease-in-out all .3s;
}

.table tbody tr:not([data-level="1"]) {
    background: #000402;
    border-bottom: 1px solid #012d2b;
}

.table tbody tr[data-level="2"]  td {
    padding-right: 70px;
}

.table tbody tr[data-level="3"]  td {
    padding-right: 110px;
}

.table tbody tr[data-level="4"]  td {
    padding-right: 115px;
}

.table tbody tr[data-level="5"]  td {
    padding-right: 120px;
}

.table tbody tr[data-level="6"]  td {
    padding-right: 125px;
}

.table tbody tr[data-level="7"]  td {
    padding-right: 180px;
}

.table tbody tr[data-level="8"]  td {
    padding-right: 200px;
}

.table tbody tr[data-level="9"]  td {
    padding-right: 220px;
}

.table tbody tr:hover {
    background: #8bc340;
    cursor: pointer;
}

.table tbody tr td {
    padding: 10px 12px;
}

.fa-folder {
    padding-left: 10px;
}

.fa-file {
    padding-left: 10px;
}

.table tbody tr td > span {
    float: left;
    direction: rtl;
    top: 7px;
    font-size: 12px;
    font-weight: lighter;
}
.edit-button {
    float: left;
    font-size: 14px;
    padding: 5px 2px;
    border-radius: 5px;
    color: #fff;
    margin-left: 10px;
    background: transparent;
    border: none;
    transition: ease-in-out all 0.2s;
}

.delete-button {
      
    float: left;
    font-size: 14px;
    padding: 5px 2px;
    border-radius: 5px;
    color: rgb(219, 61, 72);
    margin-left: 10px;
    background: transparent;
    border: none;
    transition: ease-in-out all 0.2s;
}


.delete-button:hover, .edit-button:hover {
    transform: scale(1.3);
    background: transparent;
}

.delete-button:focus, .edit-button:focus {
    background: none
}


.modal .modal-header {
    color: #fff;
}

.modal .modal-header button {
    background: #8bc340;
    background: #8bc340;
    padding: 1px 6px;
    border-radius: 5px;
    opacity: 0.75;
    transition: ease-in-out all 0.3s;
}

.modal .modal-header button:hover {
    opacity: 1;
}

.modal .form-action {
    background: #032524;
}


.modal .form-action .button-update {
    padding: 5px 25px;
    border-radius: 4px;
    background: #8bc340;
    color: #fff;
    border: none;
    transition: all ease-in-out .3s;
}

.modal .form-action .button-update:hover {
    background: #3c763d;
}
    

.modal .form-action .button-delete {
    padding: 5px 19px;
    border-radius: 4px;
    background: rgb(219, 61, 72);
    color: #fff;
    border: none;
    transition: all ease-in-out .3s;
}

.modal .form-action .button-delete:hover {
    background: rgb(155, 20, 28);
}

.edit-form {
    display: inline-block;
    margin-left: 10px;
}

</style>

<div class="box-item">
    <div class="box-item-head">
        <h3 class="title">الشبُهات المُضافة</h3>
    </div>
    <div class="box-item-content">
        <div class="alert alert-danger delete-danger" style="display: none">
            <p class=""></p>
        </div>
        <div class="card-body">
            <table id="tree-table" class="table">
                <tbody>
                    @foreach($suspicions as $suspicion)
                        <tr data-id="{{$suspicion->id}}" data-parent="0" data-level="1">
                            <td data-column="name">
                                <button class="btn btn-info delete-button" style="float: left"> <i class="fa fa-trash"></i></button>
                                <button class="btn btn-info edit-button" style="float: left"  data-toggle="modal" data-target="#myModal"> <i class="fa fa-pencil"></i></button>
                                @if(count($suspicion->childrenSuspicions))
                                    <i class="fa fa-folder"> </i>
                                @else 
                                    <i class="fa fa-file"> </i>
                                @endif 
                                {{$suspicion->suspicion}}
                            </td>
                        </tr>
                        @if(count($suspicion->childrenSuspicions))
                            @include('pages.suspicions.suspicion-partial',['sucpicionChilds' => $suspicion->childrenSuspicions, 'dataParent' => $suspicion->id , 'dataLevel' => 1])

                            {{-- @include('pages.suspicions.suspicion-reply',['suspicion' => $suspicion, 'dataParent' => $suspicion->id]) --}}
                        @endif      
                    @endforeach
                </tbody>
            </table>
        </div>   
    </div>
</div>

<!-- Trigger the modal with a button -->
{{-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> --}}

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog box-item">

        <!-- Modal content-->
        <div class="modal-content">
            
            <div class="modal-header box-item-head">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>تعديل الشبهة</h4>
            </div>
            
            <div class="modal-body  box-item-content">
                <div class="alert alert-success success-message" style="display: none">
                    <p class=""></p>
                </div>
                <textarea class="form-control" name="discussion"  id="" cols="30" rows="3"></textarea>
                <br>
                {{-- <textarea id="reply" name="reply" class="form-control summernote" id="" cols="30" rows="4">
                </textarea> --}}
            </div>

            <div class="modal-footer form-action">
                <form method="POST" action="" class="edit-form">
                    
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" name="suspicion-id" id="" value="">
                    <button type="submit" class="btn btn-default button-update">تعديل <i class="fa fa-pencil" style="margin-right: 5px"></i></button>
                </form>                
            </div>
        </div>

    </div>
</div>



<script src="{{asset('assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script>
    $(document).ready(function() {

        $('#tree-table .edit-button').on('click', function() {
            var $suspicion = '';
            console.log('Before Initiation', $suspicion);
            $suspicion = $(this).closest('td').text().trim();
            $('.modal .modal-body textarea[name="discussion"]').val($suspicion);

            $id =  $(this).closest('tr')[0].attributes['data-id'].value;
            $('.modal .modal-footer input[type="hidden"]')[0].value = $id;

            $('.modal .modal-footer .button-update').on('click', function(event) {
                event.preventDefault();
                var $suspicionText = '';
                $suspicionText = $('.modal .modal-body textarea[name="discussion"]').val().trim();

                $data = {suspicion: $suspicionText, id: $id}

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '{{route("post-update-suspicion-title")}}',
                    data: $data,
                    success: function(response)
                    {  
                        $('.success-message').css('display', 'block');
                        $('.success-message p').html(response.message);
                        setTimeout(function() {location.reload()}, 1500);
                        console.log(response); 
                    }

                });
            });

            
        }); 

        $('.modal .modal-footer .button-delete, .table .delete-button').on('click', function(event) {
            $id =  $(this).closest('tr')[0].attributes['data-id'].value;
            
            if (confirm('بحذفك هذه الشبهة ستقوم بحذف الشبهة و كل الشبهات المندرجة تحتها هل تريد الإستمرار؟')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: '{{route("delete-suspicion")}}',
                    data: {id: $id},
                    success: function(response)
                    {  
                        
                        $('.delete-danger').css('display', 'block');
                        $('.delete-danger p').html(response.message);
                        setTimeout(function() {location.reload()}, 1500);
                        // console.log('Thing was saved to the database.');
                    }
                });
            } else {
                // Do nothing!
                // console.log('Thing was not saved to the database.');
            }
        });
    });
</script>

@stop