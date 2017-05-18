<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if( count($products_cart) )
                        <div id="cart">
                            <ul>
                            @foreach ($products_cart as $product)
                                <li>
                                    <input type="number" value="{{$product->id}}" /> {{$product->title}} ( {{$product->description}} ) {{$product->price}} 
                                    <button prod-id="{{$product->id}}" class='removeProd'>x</button>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    @else
                        <div id="cart">Realiza tu pedido</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>