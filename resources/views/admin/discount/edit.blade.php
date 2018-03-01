@extends('admin.layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">

                <div id="success_update" class="alert alert-success fade in" style="display: none;">Discount updated succesfully</div>
<div id="error_update" class="alert alert-danger fade in" style="display: none;">Error to update the Discount</div>

                   <form id="editDiscountForm" class="form-horizontal">
					    {{ csrf_field() }}
					    <input type="hidden" name="discount_id" id="discount_id" value="{{$discount->id}}">
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

						    <div class="form-group{{ $errors->has('percent') ? ' has-error' : '' }}">
						        <label for="percent" class="col-md-4 control-label">Percent</label>

						        <div class="col-md-6">
						            <input id="percent" type="text" class="form-control" name="percent" value="{{ old('percent',$discount->percent) }}" required autofocus>

						            @if ($errors->has('percent'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('percent') }}</strong>
						                </span>
						            @endif
						        </div>
						    </div>

						    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
						        <label for="start_date" class="col-md-4 control-label">Start Date</label>

						        <div class="col-md-6">
						            <input id="start_date" type="text" class="form-control" name="start_date" value="{{ old('start_date',$discount->start_date) }}" required autofocus date>

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
						            <input id="end_date" type="text" class="form-control" name="end_date" value="{{ old('end_date',$discount->end_date) }}" required>

						            @if ($errors->has('end_date'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('end_date') }}</strong>
						                </span>
						            @endif
						        </div>
						    </div>
							
							<input type="hidden" name="range_limit" value="0"/>

						    <div class="form-group{{ $errors->has('range_limit') ? ' has-error' : '' }}">
						        <label for="range_limit" class="col-md-4 control-label">Range Limit</label>

						        <div class="col-md-6">
						            <input id="range_limit" type="checkbox" class="form-control" name="range_limit" value="{{ old('range_limit',$discount->range_limit) }}">

						            @if ($errors->has('range_limit'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('range_limit') }}</strong>
						                </span>
						            @endif
						        </div>
						    </div>

						    <div class="form-group{{ $errors->has('min_value') ? ' has-error' : '' }}">
						        <label for="min_value" class="col-md-4 control-label">Min Value</label>

						        <div class="col-md-6">
						            <input id="min_value" type="text" class="form-control" name="min_value" value="{{ old('min_value',$discount->min_value) }}" autofocus>

						            @if ($errors->has('min_value'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('min_value') }}</strong>
						                </span>
						            @endif
						        </div>
						    </div>

						    <div class="form-group{{ $errors->has('max_value') ? ' has-error' : '' }}">
						        <label for="max_value" class="col-md-4 control-label">Max value</label>

						        <div class="col-md-6">
						            <input id="max_value" type="text" class="form-control" name="max_value" value="{{ old('max_value',$discount->max_value) }}" autofocus>

						            @if ($errors->has('max_value'))
						                <span class="help-block">
						                    <strong>{{ $errors->first('max_value') }}</strong>
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