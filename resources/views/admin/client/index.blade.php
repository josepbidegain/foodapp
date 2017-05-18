@extends('admin.layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                
                <div class="panel-body">
                <button id="showCreateForm" class="success">Create</button>
                
                <div id="createContainer" style="display: none;">
					@include('admin.client.create')
				</div>
                
                <!-- <table class="table table-hover">
				    <thead>
				    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
                        <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Last Name" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Username" disabled></th>
                    </tr>
				      <tr>
				        <th>Firstname</th>
				        <th>Lastname</th>
				        <th>Email</th>
				        <th>Actions</th>
				      </tr>
				    </thead>
				    <tbody id="data-users">
				    
				    @foreach ($users as $user)
				      <tr>
				        <td>{{ $user->name }}</td>
				        <td>{{ $user->lastname }}</td>
				        <td>{{ $user->email }}</td>
				        <td>a b c</td>
				      </tr>				      
				    @endforeach

				    </tbody>
				  </table>
				  -->
	
			    <div class="row">
			        <div class="panel panel-primary filterable">
			            <div class="panel-heading">
			                <h3 class="panel-title">Clients</h3>
			                <div class="pull-right">
			                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			                </div>
			            </div>
			            <table class="table">
			                <thead>
			                    <tr class="filters">
			                        <th><input type="text" class="form-control" placeholder="#" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="First Name" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Last Name" disabled></th>
			                        <th><input type="text" class="form-control" placeholder="Email" disabled></th>                        
			                    </tr>
			                </thead>
			                <tbody id="data-clients">
							    
							    @foreach ($users as $user)
							      <tr>
							        <td>{{ $user->id }}</td>
							        <td>{{ $user->name }}</td>
							        <td>{{ $user->lastname }}</td>
							        <td>{{ $user->email }}</td>
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

