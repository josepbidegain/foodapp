@foreach ($products as $product)
  	<tr>
	    <td>{{ $product->id }}</td>
	    <td>{{ $product->restaurant->name }}</td>
	    <td>{{ $product->category->name }}</td>
	    <td>{{ $product->title }}</td>
	    <td>{{ $product->description }}</td>
	    <td>{{ $product->price }}</td>
	    @if ($product->active)
	    <td>Active</td>
	    @else
	    <td>Inactive</td>
	    @endif
		<td>a b c</td>
  	</tr>				      
@endforeach