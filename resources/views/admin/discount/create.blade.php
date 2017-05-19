<div id="success_create" class="alert alert-success fade in" style="display: none;">Discount created succesfully</div>
<div id="error_create" class="alert alert-danger fade in" style="display: none;">Error to create the Discount</div>

<form id="createDiscountForm" class="form-horizontal">
    {{ csrf_field() }}
    <input type="hidden" name="restaurant_id" value="{{$restaurant->id}}">

    <div class="form-group{{ $errors->has('percent') ? ' has-error' : '' }}">
        <label for="percent" class="col-md-4 control-label">Percent</label>

        <div class="col-md-6">
            <input id="percent" type="text" class="form-control" name="percent" value="{{ old('percent') }}" required autofocus>

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
            <textarea id="start_date" type="text" class="form-control" name="start_date" value="{{ old('start_date') }}" required autofocus></textarea>

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