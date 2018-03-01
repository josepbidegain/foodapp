@extends('admin.layouts.app')

@section('content')
<div id="success_create" class="alert alert-success fade in" style="display: none;">Product edited succesfully</div>
<div id="error_create" class="alert alert-danger fade in" style="display: none;">Error to edit the Product</div>


<form id="editProductForm" class="form-horizontal" enctype ="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">Title</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title',$product->title) }}" required autofocus>

            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-4 control-label">Description</label>

        <div class="col-md-6">
            <textarea id="description" type="text" class="form-control" name="description" required autofocus>
            	{{ old('description',$product->description) }}
            </textarea>

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
            <input id="price" type="text" class="form-control" name="price" value="{{ old('price',$product->price) }}" required>

            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>


    <div class="form-group">
        <label for="restaurant" class="col-md-4 control-label">Restaurant</label>

        <div class="col-md-6">
            <input id="restaurant" type="text" class="form-control" value="{{ old('restaurant',$product->restaurant->name) }}" readonly="">
        </div>
    </div>


    <div class="form-group">
        <label for="category" class="col-md-4 control-label">Category</label>

        <div class="col-md-6">
            <input id="category" type="text" class="form-control" value="{{ old('category',$product->category->name) }}" readonly="">
        </div>
    </div>

    
    <div class="form-group{{ $errors->has('taste') ? ' has-error' : '' }}">
        <label for="taste" class="col-md-4 control-label">Taste</label>

        <div class="col-md-6">
            <input id="taste_name" type="text" class="form-control" name="taste_name" value="{{ old('name') }}" placeholder="can put separated by coma, ex: Morron, Aceitunas" autofocus>

            @if ($errors->has('tast_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('tast_name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="imageInput">Image</label>
        <input data-preview="#preview" name="logo" type="file" id="logo">
        <img class="col-sm-6" id="preview"  src="" ></img>        
    </div>

    <div class="form-group{{ $errors->has('recomendated') ? ' has-error' : '' }}">
        <label for="recomendated" class="col-md-4 control-label">Recomendated</label>

        <div class="col-md-6">
            <input id="recomendated" type="checkbox" class="form-control" name="recomendated" value="{{ old('recomendated') }}">

            @if ($errors->has('recomendated'))
                <span class="help-block">
                    <strong>{{ $errors->first('recomendated') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
        <label for="active" class="col-md-4 control-label">Active</label>

        <div class="col-md-6">
            <input id="active" type="checkbox" class="form-control" name="active" value="{{ old('active') }}">

            @if ($errors->has('active'))
                <span class="help-block">
                    <strong>{{ $errors->first('active') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button id="editButton" type="submit" class="btn btn-primary">
                Update
            </button>
            <button id="cancelButton" class="btn btn-primary">
                Cancel
            </button>
        </div>
        
    </div>

</form>
@endsection