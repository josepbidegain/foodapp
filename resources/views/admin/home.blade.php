@extends('admin.layouts.app')

@section('content')

<div class="col-md-6 col-md-offset-1">
    <div class="panel-default">
        <div class="panel-heading">Admin Dashboard</div>

        <div class="panel-body">
            Mostrar Ultimas notificaciones
        </div>
    </div>
</div>

<div id="sidebar" class="col-md-3 col-md-offset-1">
    @include('admin.layouts.sidebar')
</div>
@endsection
