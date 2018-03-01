@extends('admin.layouts.app')

@section('content')


            <div class="panel panel-default">
                
                <div class="panel-body">
                <button id="btnShowCreateForm" class="success">Create</button>
                
                <div id="createContainer" style="display: none;">
					@include('admin.discount.create')
				</div>
	
			    <div class="row">
			        <div class="panel panel-primary filterable">
			            <div class="panel-heading">
			                <h3 class="panel-title">Discounts</h3>
			                <div class="pull-right">
			                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			                </div>
			            </div>
			            <table class="table">
			                <thead>
			                    <tr class="filters">
			                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Restaurant" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Percent" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Start" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="End" disabled></th>                        
			                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>  
			                        <th><input type="text" class="form-control" placeholder="Actions" disabled></th>                       
			                    </tr>
			                </thead>
			                <tbody id="data-discounts">
							    
							    @foreach ($discounts as $discount)
							      <tr>
							        <td><a href="/admin/discounts/{{ $discount->id }}/edit">{{ $discount->id }}</a></td>
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

							    </tbody>
			            </table>
			        </div>
			    </div>

                </div>
            </div>
      
@endsection

