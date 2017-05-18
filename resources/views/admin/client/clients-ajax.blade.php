@foreach ($clients as $client)
  <tr>
  	<td>{{ $client->id }}</td>
    <td>{{ $client->name }}</td>
    <td>{{ $client->lastname }}</td>
    <td>{{ $client->email }}</td>
    <td>a b c</td>
  </tr>				      
@endforeach