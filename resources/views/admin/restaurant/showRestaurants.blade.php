@extends('admin.layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-body">
                <button id="showCreateForm" class="success">Create</button>
                
                <div id="createContainer" style="display: none;">
					@include('admin.restaurant.create')
				</div>
	
			    <div class="row">
			        <div class="panel panel-primary filterable">
			            <div class="panel-heading">
			                <h3 class="panel-title">Restaurants</h3>
			                <div class="pull-right">
			                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			                </div>
			            </div>
			            <table class="table">
			                <thead>
			                    <tr class="filters">
			                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Name" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Lastname" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Phone" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Address" disabled></th>                        
			                        <th><input type="text" class="form-control" placeholder="Email" disabled></th>                        
			                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>                       
			                        <th><input type="text" class="form-control" placeholder="Actions" disabled></th>                       
			                    </tr>
			                </thead>
			                <tbody id="data-restaurants">
							    
							    @foreach ($restaurants as $restaurant)
							      <tr>
							        <td><a href="/admin/restaurants/{{ $restaurant->id }}/edit">{{ $restaurant->id }}</a></td>
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

							    </tbody>
			            </table>
			        </div>
			    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

