@extends('admin.layouts.app')

@section('content')

            <div class="panel panel-default">
                
                <div class="panel-body">
    
			    <div class="row">
			        <div class="panel panel-primary filterable">
			            <div class="panel-heading">
			                <h3 class="panel-title">History</h3>
			                <div class="pull-right">
			                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			                </div>
			            </div>
			            <table class="table">
			                <thead>
			                    <tr class="filters">
			                    	<th><input type="text" class="form-control" placeholder="#" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Date" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="User" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Action" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Model" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Model ID" disabled></th>			                        
			                    </tr>
			                </thead>
			                <tbody id="data-history">
							    
							    @foreach ($history as $item)
							      <tr>
							      	  <td>{{ $item->id }}</td>
								      <td>{{ $item->created_at }}</td>
								      @if ( !empty($item->user['name']) )
								      	<td>{{ $item->user['name'] }}</td>
								      @else
								      	<td>System</td>
								      @endif
								      <td>{{ $item->event }}</td>
								      <td>{{ $item->auditable_type }}</td>
								      <td>{{ $item->auditable_id }}</td>	      	     
							      </tr>
							    @endforeach

							    </tbody>
			            </table>
			            
			            <div class="pagination" style="float: right;">

			            	{{ $history->render() }}
			            </div>	
			            
			            
			        </div>
			    </div>

                </div>
            </div>
      
@endsection

