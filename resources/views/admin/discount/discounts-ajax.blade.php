@foreach ($discounts as $discount)
  <tr>
    <td><a href="/admin/discount/{{ $discount->id }}/edit">{{ $discount->id }}</a></td>
    <td>{{ $discount->restaurant->name }}</td>       
    <td>{{ $discount->percent }}</td>
    <td>{{ $discount->start_date }}</td>
    <td>{{ $discount->end_date }}</td>
    @if ($discount->range_limit)
    	<td>Special</td>
    @else
    	<td>Common</td>
    @endif
    
	@if ($discount->active)
    <td>Active</td>
    @else
    <td>Inactive</td>
    @endif       
    <td>a b c</td>
  </tr>				      
@endforeach