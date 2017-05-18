@extends('client.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
        </div>
    </div>
</div>

<div id="sidebar" class="col-md-4">
    @include('client.sidebar')
</div>
@endsection
