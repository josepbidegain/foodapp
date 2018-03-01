@extends('admin.layouts.app')

@section('content')

            <div class="panel panel-default">
                
                <div class="panel-body">
                <button id="btnShowCreateForm" class="success">Create</button>
                
                <div id="createContainer" style="display: none;">
					@include('admin.product.create')
				</div>
	
			    <div class="row">
			        <div class="panel panel-primary filterable">
			            <div class="panel-heading">
			                <h3 class="panel-title">Products</h3>
			                <div class="pull-right">
			                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			                </div>
			            </div>
			            <table class="table">
			                <thead>
			                    <tr class="filters">
			                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Restaurant" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Category" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Title" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Description" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Price" disabled></th>                        
			                        <th><input type="text" class="form-control" placeholder="Recomendated" disabled></th>                        
			                        <th><input type="text" class="form-control" placeholder="Status" disabled></th>                        
			                        <th><input type="text" class="form-control" placeholder="Actions" disabled></th>                        
			                    </tr>
			                </thead>
			                <tbody id="data-products">
							    
							    @foreach ($products as $product)
							      <tr>
							        <td>{{ $product->id }}</td>
							        <td>{{ $product->restaurant->name }}</td>
							        <td>{{ $product->category->name }}</td>
							        <td>{{ $product->title }}</td>
							        <td>{{ $product->description }}</td>
							        <td>{{ $product->price }}</td>
							        @if ($product->recomendated)
							        <td>Yes</td>
							        @else
							        <td>No</td>
							        @endif

							        @if ($product->active)
							        <td>Active</td>
							        @else
							        <td>Inactive</td>
							        @endif
							        <td>
							         <a href="/admin/products/{{$product->id}}/edit">
 										<i class='glyphicon glyphicon-edit'></i>
 									 </a>
									<a href="/admin/products/{{ $product->id}}">
 										<i class='glyphicon glyphicon-trash'></i>
 									 </a>
							        a b c</td>
							      </tr>				      
							    @endforeach

							    </tbody>
			            </table>
			            
			            <div class="pagination" style="float: right;">
			            	{!! $products->render() !!}	
			            </div>	
			            
			            
			        </div>
			    </div>

                </div>
            </div>
      
@endsection

