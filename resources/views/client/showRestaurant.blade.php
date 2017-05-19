@extends('client.layouts.app')

@section('content')
	<div class="container">
	
    <div class="row">
	<input type="hidden" id="r_id" value="{{$restaurant->id}}">
	@foreach ($restaurant->categories as $category)
		<h2>{{ $category->name }}</h2>
		<hr>

		@foreach ( $restaurant->products as $p )
			@if ($p->category == $category)
				<div>
					{{ csrf_field() }}

					<p>{{ $p->title }}</p> 
					<p>{{ $p->price }}</p>
					<p>{{ $p->description }}</p>
					<input type="number" value="1" min="1" id="prod-count-{{$p->id}}">
					<button class="add-product-btn">agregar</button>
				</div>
				<br>
			@endif
		@endforeach

	@endforeach

	
	</div>
	</div>
<hr>

<div id="sidebar" class="col-md-4">
	@include('client.layouts.cart')
</div>
@endsection
