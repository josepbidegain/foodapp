@extends('client.layouts.app')

@section('content')
	<div class="container">

	<div>
		<p>Info Restaurant</p>
		Distancia, Tiempo de entrega, Costo de envio, pedido minimo
	</div>
	<br>
	@if ($have_discount)
		@foreach ($have_discount as $discount)
		<h1>This restaurant has discount of {{$discount->percent}}%</h1>
		@endforeach
	@endif
	
	@if (count($recomendated_products) > 0)
	<div id="recomendated_products">
		<p>Platos Recomendados</p>
		@foreach ($recomendated_products as $p)
		<div id="prod_containter">
			<div>
				{{ csrf_field() }}

				<p>{{ $p->title }}</p> 
				<p>{{ $p->price }}</p>
				
				<p>{{ $p->afterDiscount }}</p>
				
				<p>{{ $p->description }}</p>
				<input type="number" value="1" min="1" id="prod-count-{{$p->id}}">
				<button class="add-product-btn">agregar</button>
			</div>			
		</div>
		@endforeach
	</div>
	@endif
    <div class="row">
	<input type="hidden" id="r_id" value="{{$restaurant->id}}">
	@foreach ($restaurant->categories as $category)
		<h2>{{ $category->name }}</h2>
		<hr>

		@foreach ( $products as $p )
			@if ($p->category == $category)
				<div>
					{{ csrf_field() }}

					<p>{{ $p->title }}</p> 
					<p>{{ $p->price }}</p>
					
					<p>{{ $p->afterDiscount }}</p>
					
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
