$( document ).ready(function() {
    console.log( "client  js ready!" );

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('input[name="_token"]').attr('value') }
    });

	$(document).on("click", '.removeProd', function(event) {
		
        var r_id =  $("#r_id").val();
        var prod_id = $(this).attr('prod-id');
		var count = 0;
    	//var token = $(document).find('meta[name=csrf-token]').attr('content');    	

        sendAjaxPost(r_id,prod_id,count,"remove");
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

    $(document).on("click", "#do_order", function(){
        $.ajax({
            url: "do_order",
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
        }

        $.ajax({
            url: ajax_url,
            method: 'POST',
            dataType: 'json',
            data: {restaurant_id: r_id, product_id: prod_id, number: count },
            success: function(response){
                console.log(response);

                if (response.products.length){
                    
                    var html = '<ul>';
                    
                    if ( response.products.length > 1 ){
                        html += '<li><button prod-id="" class="removeProd">Remove All</button></li>';
                    }
                    
                    $.each(response.products, function(index,product) {
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
                        html += product.title + " ( "+ product.description +" )" + " $" + ( product.price * response.data[product.id] ) +"<button prod-id='"+product.id+"' class='removeProd'>x</button></li>";
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
                        if ( response.otherAddress.length ){
                            html += "<li id='li_otherAddress' style='display: none;'>\
                            <select id='selectAddress'>";
                                for ( var i = 0; i < response.otherAddress.length; i++ ){
                                    html += "<option value="+response.otherAddress[i]['id']+">"+response.otherAddress[i]['address']+"</option>";
                                }                 
                            html += "</select>\
                                    </li>";    
                        }
                        
                        html += "<li>Delivery para: " + response.mainAddress +" <button id='editAddressCart'>Editar</button></li>\
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