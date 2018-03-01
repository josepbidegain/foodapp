$( document ).ready(function() {
    console.log( "client  js ready!" );

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('input[name="_token"]').attr('value') }
    });


	$(document).on("click", '.removeProd', function(event) {
		
        var r_id =  $("#r_id").val();
        var prod_id = $(this).attr('prod-id');
		
        sendAjaxPost(r_id,prod_id,null,"remove");
	});

    $(document).on("click", ".add-product-btn" ,function(){
    	
    	var r_id =  $("#r_id").val();
    	var prod_id = $(this).parent().find('input[type=number]').attr('id').split("-")[2];    	
    	var count = $(this).parent().find('input[type=number]').val();
    	//var token =  $(this).parent().find( 'input[name=_token]' ).val();
        sendAjaxPost(r_id,prod_id,count,"add");
    	
    });

    $(document).on("change","#cart_count", function(){
        var r_id =  $("#r_id").val();
        var prod_id = $(this).attr("prod-id"); 
        var count = $(this).val();
        
        sendAjaxPost(r_id,prod_id,count,"manage");

    });

    $(document).on("change","#selectTypeAddress", function(){
        console.log('cambia entrega');
        if ( $(this).val() == 'local' ){
            $(document).find("#mainAddress").hide();
            $(document).find("#li_otherAddress").hide();
        }else{
            $(document).find("#mainAddress").show();
        }
    });

    $(document).on("click","#editAddressCart", function(){
        $(document).find("#li_otherAddress").show();
        $(this).hide();
    });

    $(document).on("change", "#selectAddress", function(){
        $("#li_otherAddress").hide();
        $("#spanAddress").html($("#selectAddress").val() );
    });
    
    $(document).on("click", "#do_order", function(){

        if ( $("#selectTypeAddress") == -1 ){
            return false;
        }/*
        #schedule_order
        #comment_order
        #selectAddress
        if ( $("#selectTypeAddress") == 'delivery'){
            var destination = 
        }
*/
        $.ajax({
            url: "/do_order",
            method:"POST",
            data: {},
            dataType: "json",
            success: function(response){
                console.log(response);
            },
            error: function(error){

            }
        })
    });

    function sendAjaxPost(r_id,prod_id,count,type){
        var ajax_url = "";

        switch (type){
            case "add" :
                ajax_url = "/add-product-to-cart";
                break;

            case "remove":
                ajax_url = "/remove-product-from-cart";  
                break;

            case "manage":
                ajax_url = "/manage-product-from-cart";
                break;

            case "do_order":
                ajax_url = "/do_order";
                break;
        }

        $.ajax({
            url: ajax_url,
            method: 'POST',
            dataType: 'json',
            data: {restaurant_id: parseInt(r_id), product_id: parseInt(prod_id), number: parseInt(count) },
            success: function(response){
                console.log(response);

                if (response.products.length){
                    
                    var html = '<ul>';
                    
                    if ( response.products.length > 1 ){
                        html += '<li><button prod-id="" class="removeProd">Remove All</button></li>';
                    }
                    
                    $.each(response.products, function(index,product) { 
                        console.log(product.afterDiscount);
                        //console.log(index,product);                   
                        html+="<li><select prod-id='"+product.id+"' name='cart_count' id='cart_count'>";
                        
                        for ( var i = 1; i <= 10; i++){
                            if (response.data[product.id] == i){
                                html += "<option selected value="+i+">"+i+"</option>";
                            }else{
                                html += "<option value="+i+">"+i+"</option>";
                            }

                        }           
                                    
                        html +="</select>";
                        if (product.afterDiscount != 0){ 
                            var showPriceCart = product.afterDiscount * response.data[product.id];
                        }else{
                            var showPriceCart = product.price * response.data[product.id];
                        }
                        html += product.title + " ( "+ product.description +" )" + " $" + showPriceCart +"<button prod-id='"+product.id+"' class='removeProd'>x</button></li>";
                    });
                    html += "<li> Sub Total:  $ "+response.subTotal+"</li>";
                    html += "</ul>";

                    html += "<ul>\
                        <li>\
                            <select id='selectTypeAddress'>\
                                <option value='-1'>Seleccione retiro</option>\
                                <option value='local'>Retiro en local</option>\
                                <option selected value='delivery'>Delivery</option>\
                            </select>\
                        </li>";
                            
                        html += "<li id='li_otherAddress' style='display: none;'>";
                        if ( response.otherAddress.length ){

                            html+="<select id='selectAddress'>\
                            <option value='-1'>Seleccionar otra direccion</option>";

                                for ( var i = 0; i < response.otherAddress.length; i++ ){
                                    html += "<option value="+response.otherAddress[i]['id']+">"+response.otherAddress[i]['address']+"</option>";
                                }                 
                            html += "</select>";
                        }
                        html+= "<label> Agregar direccion </label>\
                            <input type='text' id='newAddress' name='newAddress'>\
                            </li>";    
                        
                        
                        html += "<li id='mainAddress'>Delivery para: <span id='spanAddress'>" + response.mainAddress +"</span><button id='editAddressCart'>Editar</button></li>\
                        <li>Horario de entrega:</li>\
                        <!-- crear horarios de restaurants y mostrar rango cada 1 hora -->\
                        <li>\
                        <select>\
                            <option>Lo antes posible</option>\
                            <option>12:00</option>\
                            <option>13:00</option>\
                        </select>\
                        </li>\
                        <li>Aclaraciones</li>\
                        <li><input id='comment_order' type='textarea'></li>\
                        <li><button id='do_order'>Realizar pedido</button></li>\
                    </ul>";
                        $("#mainAddress").show();
            
                }else{
                    html = "<p>Con Hambre?</p>\
                            <p>Tu pedido esta vacio</p>\
                            <p>Realiza tu pedido</p>";
                }
                
                $("#cart").html(html);
            },
            error:function(error){
                //console.log(error);
            }

        });
    }
});