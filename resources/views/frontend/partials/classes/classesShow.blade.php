@extends('frontend.index')


@section("content")
<div class="containerme">

    
    <div class="reserve">
<h1>les images de  {{$classe->name}}</h1>
<a href={{route("reservationClassefront.info",$classe)}}>Reserver</a>
    </div>

    <div id="carouselExampleAutoplaying" class="carousel slide slidecontent" data-bs-ride="carousel">
            <div class="carousel-inner slideitems">
              @foreach ($classe->images as $index => $image)
          <div class="carousel-item  slideimage {{$index == 0 ? "active" : "" }}">
            <img src={{asset('storage/img/classe/' . $image->images)}} class="d-block w-100" alt="...">
          </div>
               @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    
</div>

@endsection
