@if(isset($last_orders))
<div class="panel panel-default">
    <div class="panel-heading">Last Orders</div>

    <div class="panel-body">
        @foreach ($last_orders as $order)
            {{ $order->created_at }}
            {{ $order->restaurant->name }}

        @endforeach
    </div>
</div>
@endif