@foreach ($restaurants as $restaurant)
  <tr>
  	<td>
      <a href="/admin/restaurants/{{ $restaurant->id }}/edit">
      {{ $restaurant->id }}
      </a>
    </td>
    <td>{{ $restaurant->name }}</td>       
    <td>{{ $restaurant->user->lastname }}</td>
    <td>{{ $restaurant->phone }}</td>
    <td>{{ $restaurant->address }}</td>
    <td>{{ $restaurant->user->email }}</td>
    @if ($restaurant->active)
      <td>Active</td>
    @else
      <td>Inactive</td>
    @endif       
<td>a b c</td>
  </tr>				      
@endforeach