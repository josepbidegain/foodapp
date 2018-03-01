@extends('admin.layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">

                <div id="success_update" class="alert alert-success fade in" style="display: none;">Promotion updated succesfully</div>
				<div id="error_update" class="alert alert-danger fade in" style="display: none;">Error to update the Promotion</div>

                   <form id="editPromotionForm" class="form-horizontal">
					    {{ csrf_field() }}
					    <input type="hidden" name="promotion_id" id="promotion_id" value="{{$promotion->id}}">
					    <input type="hidden" name="restaurant_id" id="restaurant_id" value="{{$restaurant->id}}">
					        
						<div class="form-group{{ $errors->has('restaurant') ? ' has-error' : '' }}">
					        <label for="restaurant" class="col-md-4 control-label">Restaurant</label>

					        <div class="col-md-6">
					            <input id="restaurant_id" type="text" readonly="true" class="form-control" name="restaurant" value="{{ old('restaurant', $restaurant->name) }}" required autofocus>

					            @if ($errors->has('restaurant'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('restaurant') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>

					    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					        <label for="name" class="col-md-4 control-label">Name</label>

					        <div class="col-md-6">
					            <input id="name" type="text" class="form-control" name="restaurant" value="{{ old('name', $promotion->name) }}" required autofocus>

					            @if ($errors->has('name'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('name') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>

					    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
					        <label for="description" class="col-md-4 control-label">Description</label>

					        <div class="col-md-6">
					            <input id="description" type="text" class="form-control" name="description" value="{{ old('description', $promotion->description) }}" required autofocus>

					            @if ($errors->has('description'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('description') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>

						    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
						        <label for="price" class="col-md-4 control-label">Price</label>

						        <div class="col-md-6">
						            <input id="price" type="text" class="form-control" name="price" value="{{ old('price',$promotion->price) }}" required autofocus>

						            @if ($errors->has('price'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('price') }}</strong>
						                </span>
						            @endif
						        </div>
						    </div>

						    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
						        <label for="start_date" class="col-md-4 control-label">Start Date</label>

						        <div class="col-md-6">
						            <input id="start_date" type="text" class="form-control" name="start_date" value="{{ old('start_date',$promotion->start_date) }}" required autofocus date>

						            @if ($errors->has('start_date'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('start_date') }}</strong>
						                </span>
						            @endif
						        </div>
						    </div>

						    <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
						        <label for="end_date" class="col-md-4 control-label">End Date</label>

						        <div class="col-md-6">
						            <input id="end_date" type="text" class="form-control" name="end_date" value="{{ old('end_date',$promotion->end_date) }}" required>

						            @if ($errors->has('end_date'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('end_date') }}</strong>
						                </span>
						            @endif
						        </div>
						    </div>
							
							
					    <div class="form-group">
					        <div class="col-md-6 col-md-offset-4">
					            <button id="createButton" type="submit" class="btn btn-primary">
					                Edit
					            </button>

					        </div>
					        
					    </div>

					</form>
                </div>
            </div>

@endsection