@extends('admin.layouts.app')

@section('content')

@include('admin.category.create')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                   <form id="createRestaurantForm" class="form-horizontal" enctype ="multipart/form-data">
    				{{ csrf_field() }}

					    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					        <label for="name" class="col-md-4 control-label">Name</label>

					        <div class="col-md-6">
					            <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$restaurant->name) }}" required autofocus>

					            @if ($errors->has('name'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('name') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>

					    <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
					        <label for="lastname" class="col-md-4 control-label">Last Name</label>

					        <div class="col-md-6">
					            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname',$restaurant->user->lastname) }}" required autofocus>

					            @if ($errors->has('lastname'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('lastname') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>

					    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
					        <label for="phone" class="col-md-4 control-label">Phone</label>

					        <div class="col-md-6">
					            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone',$restaurant->phone) }}" required autofocus>

					            @if ($errors->has('phone'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('phone') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>

					    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
					        <label for="address" class="col-md-4 control-label">Address</label>

					        <div class="col-md-6">
					            <input id="address" type="text" class="form-control" name="address" value="{{ old('address',$restaurant->address) }}" required autofocus>

					            @if ($errors->has('address'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('address') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>


					    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

					        <div class="col-md-6">
					            <input id="email" type="email" class="form-control" name="email" value="{{ old('email',$restaurant->user->email) }}" required>

					            @if ($errors->has('email'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('email') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>

					    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					        <label for="password" class="col-md-4 control-label">Password</label>

					        <div class="col-md-6">
					            <input id="password" type="password" class="form-control" name="password">

					            @if ($errors->has('password'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('password') }}</strong>
					                </span>
					            @endif
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

					        <div class="col-md-6">
					            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
					        </div>
					    </div>

					    <div class="form-group">
					        <label for="imageInput">Logo</label>
					        <input data-preview="#preview" name="logo" type="file" id="logo">
					        <img class="col-sm-6" id="preview"  src="/uploads/{{$restaurant->logo}}" ></img>        
					    </div>

					    <div class="form-group">
					        <div class="col-md-6 col-md-offset-4">
					            <button id="createButton" type="submit" class="btn btn-primary">
					                Create
					            </button>
					            <button id="cancelButton" class="btn btn-primary">
					                Cancel
					            </button>
					        </div>
					        
					    </div>

					</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection