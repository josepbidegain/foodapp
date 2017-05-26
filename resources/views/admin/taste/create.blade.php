<div id="success_create" class="alert alert-success fade in" style="display: none;">Taste created succesfully</div>
<div id="error_create" class="alert alert-danger fade in" style="display: none;">Error to create the Taste</div>

<form id="createTasteForm" class="form-horizontal">
    {{ csrf_field() }}
    
    <input type="hidden" name="product_id" value="{{$product->id}}">

    <label for="create_taste" class="col-md-4 control-label">Create Taste (can put separated by coma, ex: Morron, Aceitunas)</label>
    <div class="form-group{{ $errors->has('taste') ? ' has-error' : '' }}">
        <label for="taste" class="col-md-4 control-label">Taste</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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