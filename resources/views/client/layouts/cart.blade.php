<div class="panel panel-default">
    <div class="panel-heading">Cart</div>

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

                    
                        <li id="li_otherAddress" style="display: none;">
                            @if ( count($otherAddress) > 0 )
                                <select id="selectAddress">
                                    <option value="-1">Seleccionar otra direccion</option>
                                    @foreach ( $otherAddress  as $address )
                                    <option value="{{$address->address}}">{{$address->address}}</option>
                                    @endforeach
                                </select>
                            @endif
                            <label> Agregar direccion </label> 
                            <input type="text" id="newAddress" name="newAddress">
                         
                        </li>
                    

                    <li id="mainAddress">Delivery para: <span id="spanAddress">{{ $mainAddress }} </span><button id="editAddressCart">Editar</button></li>
                    <li>Horario de entrega:</li>
                    <select id="schedule_order"> 
                    <!-- crear horarios de restaurants y mostrar rango cada 1 hora -->
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
                        @if ($has_complete_data_user)
                        <button id='do_order'>Realizar pedido</button>
                        @else
                        <label>Por favor complete su direccion antes de pedir</label>
                        <a href="/profile/{{Auth::user()->id}}">Completar informacion</a>
                        @endif

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