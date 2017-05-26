@extends('admin.layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-body">
                <button id="btnShowCreateForm" class="success">Create</button>
                
                <div id="createContainer" style="display: none;">
					@include('admin.promotion.create')
				</div>
	
			    <div class="row">
			        <div class="panel panel-primary filterable">
			            <div class="panel-heading">
			                <h3 class="panel-title">Promotions</h3>
			                <div class="pull-right">
			                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			                </div>
			            </div>
			            <table class="table">
			                <thead>
			                    <tr class="filters">
			                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Restaurant" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Name" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Description" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Price" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Start" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="End" disabled></th>                        
			                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>  
			                        <th><input type="text" class="form-control" placeholder="Actions" disabled></th>                       
			                    </tr>
			                </thead>
			                <tbody id="data-promotions">
							    
							    @foreach ($promotions as $p)
							      <tr>
							        <td><a href="/admin/promotions/{{ $p->id }}/edit">{{ $p->id }}</a></td>
							        <td>{{ $p->restaurant->name }}</td>       
							        <td>{{ $p->name }}</td>
							        <td>{{ $p->description }}</td>
							        <td>{{ $p->price }}</td>
							        <td>{{ $p->start_date }}</td>
							        <td>{{ $p->end_date }}</td>							        
									@if ($p->active)
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

