@extends('admin.layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-body">
                <button id="showCreateForm" class="success">Create</button>
                
                <div id="createContainer" style="display: none;">
					@include('admin.order.create')
				</div>
	
			    <div class="row">
			        <div class="panel panel-primary filterable">
			            <div class="panel-heading">
			                <h3 class="panel-title">Orders</h3>
			                <div class="pull-right">
			                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			                </div>
			            </div>
			            <table class="table">
			                <thead>
			                    <tr class="filters">
			                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Provider" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Title" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Description" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Price" disabled></th>                        
			                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>                        
			                    </tr>
			                </thead>
			                <tbody id="data-orders">
							    
							    @foreach ($orders as $order)
							      <tr>
							        <td>{{ $order->id }}</td>
							        <td>{{ $order->restaurant->name }}</td>
							        <td>{{ $order->client->name }}</td>
							        <td>{{ $order->status }}</td>        
							        @if ($order->confirmed)
							        <td>Confirmed</td>
							        @else
							        <td>Unconfirmed</td>
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

