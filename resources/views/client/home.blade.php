@extends('client.layouts.app')

@section('content')




  <div class="item">
  @foreach ($restaurants as $restaurant)

    <a href="/restaurants/{{$restaurant->id}}/{{$restaurant->slug}}">

    <div class="row-fluid">
      <div class="span4 dish-item">
        <header>
          <h3 class="text-center">{{$restaurant->name}} {{$restaurant->user->lastname}}</h3>
        </header>
        <figure class="border">
          <img src="/uploads/{{$restaurant->logo}}" alt="{{$restaurant->slug}}">
        </figure>
        <article class="text-item text-center">
          <header>
            <h3><i class="wheel icon-tablet"></i>Fully Responsive</h3>
          </header>
          
          <p>{{$restaurant->phone}}</p>
          <p>{{$restaurant->address}}</p>
        
          <a href="#">Read more</a>
        </article>
      </div>
    </div>
    </a>
  @endforeach
</div>

<!--
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @foreach ($restaurants as $restaurant)
                        
                        <a href="/restaurants/{{$restaurant->id}}/{{$restaurant->slug}}">

                            <div class="row">
                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">
                                  <img src="/uploads/{{$restaurant->logo}}" alt="{{$restaurant->slug}}">
                                  <div class="caption">
                                    <h3>{{$restaurant->name}} {{$restaurant->user->lastname}}</h3>
                                    <p>{{$restaurant->phone}}</p>
                                    <p>{{$restaurant->address}}</p>
                                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </a>

                    @endforeach
                </div>
            </div>
-->
@endsection
