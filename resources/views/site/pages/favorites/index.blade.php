@extends('site.layouts.master')
@section('content')

<section class="favorites">
    <div class="container">
        <div class="row">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">شبهات</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">شبهات ساخنة</a></li>
                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">أدلة</a></li>
                <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">مناظرات</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="home">
                    @foreach($favSuspicions as $fav)
                        <p>{{$fav->suspicion}}</p>
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane fade" id="profile">شبهات ساخنة
                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                        @foreach($favHotSuspicions as $fav)
                            <p>{{$fav->suspicion}}</p>
                        @endforeach
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="messages">أدلة
                    @foreach($favEevidences as $fav)
                        <p>{{$fav->title}}</p>
                    @endforeach
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">مناظرات
                    @foreach($favDiscussions as $fav)
                        <p>{{$fav->title}}</p>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

@stop