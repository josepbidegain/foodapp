$( document ).ready(function() {
    console.log( "client  js ready!" );

	$(document).on("click", '.removeProd', function(event) { 
		var pId = $(this).attr('prod-id');
		var r_id =  $("#r_id").val();
    	var token = $(document).find('meta[name=csrf-token]').attr('content');    	

		$.ajax({
    		url: '/remove-product-from-cart',
    		method: 'POST',
    		dataType: 'json',
    		data: {restaurant_id: r_id, prod_id: pId, _token: token },
    		success: function(response){console.log(response);
	 			var html = '<ul>';
	 			$.each(response.products, function(index,product) {
	            	//console.log(index,product);            		
					html+="<li><input type='number' value='"+response.data[product.id] + "' /> " +product.title + "("+ product.description +")" + " " + (product.price * response.data[product.id] ) +"<button prod-id='"+product.id+"' class='removeProd'>x</button></li>";
	            });

				html += "</ul>";
				$("#cart").html(html);
    		},
    		error:function(error){
    			//console.log(error);
    		}

    	});
	});

    $(".add-product-btn").click(function(){
    	
    	var r_id =  $("#r_id").val();
    	var prod_id = $(this).parent().find('input[type=number]').attr('id').split("-")[2];    	
    	var count = $(this).parent().find('input[type=number]').val();
    	var token =  $(this).parent().find( 'input[name=_token]' ).val();

    	$.ajax({
    		url: '/add-product-to-cart',
    		method: 'POST',
    		dataType: 'json',
    		data: {restaurant_id: r_id, product_id: prod_id, number: count, _token:token },
    		success: function(response){
	 			var html = '<ul>';
	 			$.each(response.products, function(index,product) {
	            	//console.log(index,product);            		
					html+="<li><input type='number' value='"+response.data[product.id] + "' /> " +product.title + "("+ product.description +")" + " " + (product.price * response.data[product.id] ) +"<button prod-id='"+product.id+"' class='removeProd'>x</button></li>";
	            });

				html += "</ul>";
				$("#cart").html(html);
    		},
    		error:function(error){
    			//console.log(error);
    		}

    	});
    });
});