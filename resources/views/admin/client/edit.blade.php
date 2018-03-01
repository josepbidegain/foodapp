@extends('admin.layouts.app')


@section('content')
<div class="panel panel-default">
<div id="success_create" class="alert alert-success fade in" style="display: none;">Client edited succesfully</div>
<div id="error_create" class="alert alert-danger fade in" style="display: none;">Error to edit the Client</div>

<form id="editClientForm" class="form-horizontal">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name',$client->name) }}" required autofocus>

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
            <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname',$client->lastname) }}" required autofocus>

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
            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone',$client->phone) }}" required autofocus>

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
            <input id="address" type="text" class="form-control" name="address" value="{{ old('address',$client->address) }}" required autofocus>

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
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email',$client->email) }}" required readonly>

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
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button id="createButton" class="btn btn-primary">
                Update
            </button>
            <button id="resetPasswordButton" class="btn btn-primary">
                Reset Password
            </button>
            <button id="cancelButton" class="btn btn-primary">
                Cancel
            </button>
        </div>
        
    </div>

    <div id="success_reset" class="alert alert-success fade in" style="display: none;">Sent email to reset password</div>
	<div id="error_reset" class="alert alert-danger fade in" style="display: none;">Error to send email to reset link</div>

</form>

@endsection