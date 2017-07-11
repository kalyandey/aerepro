
$(document).ready(function(){
    
    $("#admin_change_password").validate({
        rules: {
            old_password:{
                required: true,
                minlength: 6
            },
            new_password: {
					required: true,
					minlength: 6
				},
            confirm_password: {
					required: true,
					minlength: 6,
					equalTo: "#new_password"
				},
        },
        messages: {
            old_password:{
                required: "Please provide your old password",
                minlength: "Your password must be at least 6 characters long"
            },
            new_password: {
					required: "Please provide a new password",
					minlength: "Your password must be at least 6 characters long"
				},
				confirm_password: {
					required: "Please confirm your new password",
					minlength: "Your password must be at least 6 characters long",
					equalTo: "Please enter the same password as above"
				}
        }
        
    });
    
    
    $("#admin_profile_update").validate({
        rules: {
            first_name:{
                required: true
            },
            last_name: {
					required: true
				}
        },
        messages: {
            first_name:{
                required: "Please enter first name"
            },
            last_name: {
					required: "Please enter last name"
				}
        }
        
    });
    
    //$("#owner_state_edit").change(function(){
    //    var state_id = $(this).val();
    //    var data        = 'state_id=' + state_id;
    //    $.ajax({
    //        url: ADMIN_URL+'/get_cities_by_state_id',
    //        method:'post',
    //        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
    //        data: data,
    //        beforeSend:function(){
    //            $('#loader').show();
    //        },
    //        success: function(msg){
    //                    
    //                    $('#city_list').html(msg);
    //                    $('#loader').hide();
    //                }
    //        });
    //});
    
    
    $("#business_owner_edit").validate({
        rules:{
            owner_name : "required",
            owner_state : "required",
            owner_city : "required",
            owner_zip : "required",
            owner_address : "required",
            owner_email : {
                            required:true,
                            email:true
                        },
            owner_phone: "required"
                            
        },
        messages: {
        }
    });
    
    $("#business_owner_add").validate({
        rules:{
            owner_name : "required",
            owner_state : "required",
            owner_city : "required",
            owner_zip : "required",
            owner_address : "required",
            owner_email : {
                            required:true,
                            email:true
                        },
            owner_phone: "required"
                            
        },
        messages: {
        }
    });
    
    $("#state_change").change(function(){
        var state_id = $(this).val();
        get_city(state_id);
    });
    
    
    //$('#owner_state_add').trigger('change',function(){
    //    var state_id = $(this).val();
    //    get_city(state_id);
    //});
        
    function get_city(state_id) {
        
        var data        = 'state_id=' + state_id;
        if (state_id != '') {
            $.ajax({
            url: BASE_URL+'/get_cities_by_state_id',
            method:'post',
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            data: data,
            beforeSend:function(){
                $('#loader').show();
            },
            success: function(msg){
                        
                        $('#city_list').html(msg);
                        $('#loader').hide();
                    }
            });
        }
        else{
            $('#city_list').html('<option value="">Please select city</option>');
        }
    }
    
    $('.delete').click(function(){
        var owner_id = $(this).attr('data-id');
        var data        = 'owner_id='+owner_id;
        var parent      = $(this).parent().parent();
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: ADMIN_URL+'/business-owner/delete',
                method:'post',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                data: data,
                success: function(msg){
                    if (msg == 'ok') {
                        parent.remove();
                        $("#del_msg").html('<div class="note note-success"><p class="text-green">Business owner deleted successfully.</p></div>');
                    }
                }
            });
        }
    });
    
    
    $('.user_delete').click(function(){
        var user_id = $(this).attr('data-id');
        var data        = 'user_id='+user_id;
        var parent      = $(this).parent().parent();
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: ADMIN_URL+'/user/delete',
                method:'post',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                data: data,
                success: function(msg){
                    if (msg == 'ok') {
                        parent.remove();
                        $("#del_msg").html('<div class="note note-success"><p class="text-green">User deleted successfully.</p></div>');
                    }
                }
            });
        }
    });
    
    
    
    $("#business_user").validate({
        rules:{
            username : "required",
            user_name : "required",
            user_city : "required",
            user_phone : "required",
            user_state : "required",
            user_email : {
                            required:true,
                            email:true
                        },
            user_zip: "required",
            user_address: "required"
                            
        },
        messages: {
        }
    });
    
    
    $('.clear-search').click(function(){
        $('input[name="search"]').val('');
        $('#searchForm').submit();
    });
    
    $("#product_form").validate({
        rules:{
            product_name : "required",
            category_id : "required",
            product_desc : "required",
            is_featured : "required",
            status : "required"                 
        },
        messages: {
        }
    });
    
    
    $(".product_delete").click(function(){
        var product_id = $(this).attr('data-id');
        var data        = 'product_id='+product_id;
        var parent      = $(this).parent().parent();
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: ADMIN_URL+'/product/delete',
                method:'post',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                data: data,
                success: function(msg){
                    if (msg == 'ok') {
                        parent.remove();
                        $("#del_msg").html('<div class="note note-success"><p class="text-green">Product deleted successfully.</p></div>');
                    }
                }
            });
        }
    });
    
    $("#store_category_form").validate({
        rules:{
            category_name : "required",
            status : "required"              
        },
        messages: {
        }
    });
    
    $("#service_category_form").validate({
        rules:{
            category_name : "required",
            status : "required"              
        },
        messages: {
        }
    });
    
    $(".store_category_delete").click(function(){
        var store_category_id = $(this).attr('data-id');
        var data        = 'store_category_id='+store_category_id;
        var parent      = $(this).parent().parent();
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: ADMIN_URL+'/store-category/delete',
                method:'post',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                data: data,
                success: function(msg){
                    if (msg == 'ok') {
                        parent.remove();
                        $("#del_msg").html('<div class="note note-success"><p class="text-green">Category deleted successfully.</p></div>');
                    }
                }
            });
        }
    });
    
    
    //$(".service_category_delete").click(function(){
    //    var service_category_id = $(this).attr('data-id');
    //    var data        = 'service_category_id='+service_category_id;
    //    var parent      = $(this).parent().parent();
    //    if (confirm("Are you sure you want to delete this?")) {
    //        $.ajax({
    //            url: ADMIN_URL+'/service-category/delete',
    //            method:'post',
    //            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
    //            data: data,
    //            success: function(msg){
    //                if (msg == 'ok') {
    //                    parent.remove();
    //                    $("#del_msg").html('<div class="note note-success"><p class="text-green">Category deleted successfully.</p></div>');
    //                }
    //            }
    //        });
    //    }
    //});
    
    deleteRecord('service_category_delete','service_category_id',ADMIN_URL+'/service-category/delete','Category deleted successfully.');
    
    
    /*
     *function for delete record
     * param className,idPostName,link,alertMsg
     * 
     */
    
    function deleteRecord(className,idPostName,link,alertMsg) {
        $('.'+className).click(function(){
            var id  = $(this).attr('data-id');
            var data    = idPostName+'='+id;
            var parent      = $(this).parent().parent();
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    url: link,
                    method:'post',
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                    data: data,
                    success: function(msg){
                        if (msg == 'ok') {
                            parent.remove();
                            $("#del_msg").html('<div class="note note-success"><p class="text-green">'+alertMsg+'</p></div>');
                        }
                    }
                });
            }
        });
    }
   
});