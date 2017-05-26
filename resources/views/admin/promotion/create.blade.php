<div id="success_create" class="alert alert-success fade in" style="display: none;">Promotion created succesfully</div>
<div id="error_create" class="alert alert-danger fade in" style="display: none;">Error to create the Promotion</div>

<form id="createPromotionForm" class="form-horizontal">
    {{ csrf_field() }}
    
    <div class="form-group">
        <label for="type" class="col-md-4 control-label">Promotion</label>

        <div class="col-md-6">
            <select id="restaurant_select" class="form-control" name="restaurant_id">
                <option value="-1">Select Restaurant</option>
                @foreach ($restaurants as $restaurant)
                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
            <input id="description" type="textarea" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

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
            <input id="price" type="text" class="form-control" name="price" value="{{ old('price') }}" required autofocus>

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
            <input id="start_date" type="date" class="form-control" name="start_date" value="{{ old('start_date') }}" required autofocus date>

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
            <input id="end_date" type="text" class="form-control" name="end_date" value="{{ old('end_date') }}" required>

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
                Create
            </button>
            <button id="cancelButton" class="btn btn-primary">
                Cancel
            </button>
        </div>
        
    </div>

</form>