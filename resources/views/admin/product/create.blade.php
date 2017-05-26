<div id="success_create" class="alert alert-success fade in" style="display: none;">Product created succesfully</div>
<div id="error_create" class="alert alert-danger fade in" style="display: none;">Error to create the Product</div>


<form id="createProductForm" class="form-horizontal" enctype ="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-md-4 control-label">Title</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

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
            <textarea id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus></textarea>

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
            <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required>

            @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="type" class="col-md-4 control-label">Restaurant</label>

        <div class="col-md-6">
            <select id="restaurant_select" class="form-control" name="restaurant">
                <option value="-1">Select Restaurant</option>
                @foreach ($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="categories_container" class="form-group" style="display: none;">
        <label for="type" class="col-md-4 control-label">Category</label>

        <div class="col-md-6">
            <select id="categories_restaurant" class="form-control" name="category">
                
            </select>
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