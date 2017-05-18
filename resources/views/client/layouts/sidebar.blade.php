<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if( count($products_cart) )
                        <div id="cart">
                        @foreach ($products_cart as $product)
                            {{ $product->title }} <br>
                        @endforeach
                            
                        </div>
                        muestro productos
                    @else
                        <div id="cart">vacio</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>