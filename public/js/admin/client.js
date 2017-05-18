$( document ).ready(function() {
    console.log( "ready!" );
    
    $('#showCreateForm').click(function(){
        $("#createContainer").fadeIn('slow');
        $("#showCreateForm").hide();
    });

    $('#cancelButton').click(function(){
        $("#createContainer").fadeOut();
        $("#showCreateForm").show();
    })
    

    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('input[name="_token"]').attr('value') }
    });
    

    $("#createClientForm").submit(function(event){
        event.preventDefault();
        
        $.ajax({
            method : 'POST',
            url : '/admin/clients/create',
            dataType: 'json',
            data : $("#createClientForm").serialize(),
            success : function(response){                
                $("#createClientForm").fadeOut("slow");
                $("#success_create").fadeIn().fadeOut(3000);
                $("#showCreateForm").show();
                $("#data-clients").html(response.data);
            },
            error : function(response){
                $("#error_create").fadeIn();
            }

        })
        
    });

    $("#createRestaurantForm").submit(function(event){
        event.preventDefault();
        
        var token =  $('#createRestaurantForm').find( 'input[name=_token]' ).val();
        var formData = new FormData();
        formData.append("logo", $('#logo').get(0).files[0]);
        formData.append("_token", token);
        $('#createRestaurantForm input').each(function(){
            formData.append($(this).attr('name'),$(this).val());
        });
        
        $.ajax({
            method : 'POST',
            url : '/admin/restaurants',
            dataType: 'json',
            data : formData,//$("#createRestaurantForm").serialize(),
            contentType: false,
            processData: false,
            success : function(response){                
                $("#createRestaurantForm").fadeOut("slow");
                $("#success_create").fadeIn().fadeOut(3000);
                $("#showCreateForm").show();
                $("#data-restaurants").html(response.data);
            },
            error : function(response){
                $("#error_create").fadeIn();
            }

        })
        
    });

    $("#createProductForm").submit(function(event){
        event.preventDefault();
        
        $.ajax({
            method : 'POST',
            url : '/admin/products/create',
            dataType: 'json',
            data : $("#createProductForm").serialize(),
            success : function(response){                
                $("#createProductForm").fadeOut("slow");
                $("#success_create").fadeIn().fadeOut(3000);
                $("#showCreateForm").show();
                $("#data-products").html(response.data);
            },
            error : function(response){
                $("#error_create").fadeIn();
            }

        })
        
    });


    //load categories from restoran in select for create a product
    $('#restaurant_select').change(function(){
        $.get({
            url:'/admin/categories-by-restaurant',
            dataType: 'json',
            data: { restaurant_id : $("#restaurant_select").val() },
            success: function(response){console.log(response)
                var html = '';
                for (var i=0; i<response.length; i++){
                    html+='<option value="'+response[i].id+'">'+response[i].name+"</option>" 
                }
                $("#categories_restaurant").html(html);
                $("#categories_container").fadeOut().fadeIn();
            },
            error:function(response){

            }

        })
    });


    $("#createCategoryForm").submit(function(event){
        event.preventDefault();
        
        $.ajax({
            method : 'POST',
            url : '/admin/category',
            dataType: 'json',
            data : $("#createCategoryForm").serialize(),
            success : function(response){                
                $("#createCategoryForm").fadeOut("slow");
                $("#success_create").fadeIn().fadeOut(3000);
                $("#data-products").html(response.data);
            },
            error : function(response){
                $("#error_create").fadeIn();
            }

        })
        
    });

});



/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});