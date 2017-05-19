<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if( count($products_cart) )
                        <div id="cart">
                            <ul>
                            @if ( count($products_cart) > 1 )
                                <li>
                                    <button prod-id="" class='removeProd'>Remove All</button>
                                </li>
                            @endif

                            
                            @foreach ($products_cart as $product)
                                <li>
                                <select prod-id="{{$product->id}}" name="cart_count" id="cart_count">
                                    @for ($i = 1; $i < 10; $i++)
                                        @if ( $product->count == $i )
                                            <option selected value={{$i}}>{{$i}}</option>
                                        @else
                                            <option value={{$i}}>{{$i}}</option>
                                        @endif
                                    @endfor
                                </select>
                                     {{$product->title}} ( {{$product->description}} ) ${{$product->totalPrice}}
                                    <button prod-id="{{$product->id}}" class='removeProd'>x</button>
                                </li>
                            @endforeach
                            <li>
                                SubTotal ${{$subTotal}}
                            </li>
                            </ul>

                            <ul>
                                <li>
                                    <select id="selectTypeAddress">
                                        <option value="-1">Seleccione retiro</option>
                                        <option value="local">Retiro en local</option>
                                        <option selected value="delivery">Delivery</option>
                                    </select>
                                </li>

                                @if ( count($otherAddress) > 0 )
                                    <li id="li_otherAddress" style="display: none;">
                                        <select id="selectAddress">
                                            @foreach ( $otherAddress  as $address )
                                            <option value="{{$address->id}}">{{$address->address}}</option>
                                            @endforeach
                                        </select>
                                    </li>
                                @endif 

                                <li>Delivery para: {{ $mainAddress }} <button id="editAddressCart">Editar</button></li>
                                <li>Horario de entrega:</li>
                                <select> <!-- crear horarios de restaurants y mostrar rango cada 1 hora -->
                                    <option>Lo antes posible</option>
                                    <option>12:00</option>
                                    <option>13:00</option>
                                </select>

                                <li>
                                    Aclaraciones                                    
                                </li>
                                <li>
                                    <input id="comment_order" type="textarea">
                                </li>
                                <li>
                                    <button id='do_order'>Realizar pedido</button>
                                </li>

                            </ul>
                            
                        </div>
                    @else
                        <div id="cart">
                            <p>Con Hambre?</p>
                            <p>Tu pedido esta vacio</p>
                            <p>Realiza tu pedido</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>