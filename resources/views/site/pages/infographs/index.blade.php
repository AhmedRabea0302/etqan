@extends('site.layouts.master')
@section('content')
        <!-- SLIDER SECTION ====================================================== -->
        <section class="infographs-slider">
            <div class="container">
                <div class="row">
                   @foreach ($infographs as $infograph)
                    <div class="col-md-4">
                        <div class="one-info">
                            <img src="{{ url('storage/uploads/images/infographs') }}{{ '/' . $infograph->image_name }}" class="img-responsive img-center" alt="">
                            
                        </div>
                        <div class="caption">
                            <p class="">{{ $infograph->caption }}</p>
                        </div>
                    </div>   
                   @endforeach
                </div>
            </div>
        </div>
    </section>

    <script>
        let img = document.querySelectorAll('.infographs-slider .one-info img');
        img.forEach(image => {
            image.addEventListener('click', event => {
                let imageUrl = event.target.getAttribute('src');
                console.log(imageUrl);
                window.open(imageUrl, 'viewin')
            });
        });
    </script>
        
@endsection