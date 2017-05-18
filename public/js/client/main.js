$( document ).ready(function() {
    console.log( "client  js ready!" );

    $(".add-product-btn").click(function(){
    	console.log("count: " + $("#prod-count").val());
    	var r_id =  $("#r_id").val();
    	var prod_id = $(this).parent().find('input[type=number]').attr('id').split("-")[2];    	
    	var count = $(this).parent().find('input[type=number]').val();
    	var token =  $(this).parent().find( 'input[name=_token]' ).val();

    	$.ajax({
    		url: '/add-product-to-cart',
    		method: 'POST',
    		dataType: 'json',
    		data: {restaurant_id: r_id, product_id: prod_id, number: count, _token:token },
    		success: function(response){console.log(response);
    			var html = '<ul>';
    			for(var i=0; i < response.length; i++){
    				html+="<li>"+ response[i].product + " - " +response[i].count +"</li>";
    			}
    			html += "</ul>";
    			$("#cart").append("hola");
    		},
    		error:function(error){
    			//console.log(error);
    		}

    	});
    });
});