<div id="success_create" class="alert alert-success fade in" style="display: none;">Category created succesfully</div>
<div id="error_create" class="alert alert-danger fade in" style="display: none;">Error to create the Restaurant</div>

<form id="createCategoryForm" class="form-horizontal">
    {{ csrf_field() }}
    
    <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">

    <label for="create category" class="col-md-4 control-label">Create Category (can put separated by coma, ex: Pizzas, Sandwiches)</label>
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input id="name_category" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
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