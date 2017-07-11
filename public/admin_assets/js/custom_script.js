
$(document).ready(function(){
    
    setTimeout(function () {
        $("#flashmessage").animate({opacity: 1.0}, 1000).fadeOut("900")
    }, 10000
    );
    /*
     *function for delete record
     * param className,idPostName,link,alertMsg
     * 
     */
    
    function deleteRecord(className,idPostName,link,succMsg) {
        $('.'+className).click(function(){
            var id  = $(this).attr('data-id');
            var data    = idPostName+'='+id;
            //var parent      = $(this).parent().parent();
	     var parent      = $(this).parents('tr');
	    
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    url: link,
                    method:'post',
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                    data: data,
                    success: function(msg){
                        if (msg == 'ok') {
                            parent.remove();
                            $("#del_msg").html('<div class="note note-success"><p class="text-green">'+succMsg+'</p></div>');
                        }
			else
			{
			    $("#del_msg").html('<div class="note note-danger"><p class="text-red">Record can not be deleted</p></div>');
			}
                    }
                });
            }
        });
    }
    
    $( "#awarded_to" ).autocomplete({
	    search  : function(){$(this).addClass('autoloader');},
	    open    : function(){$(this).removeClass('autoloader');},
	    source: BASE_URL + '/admin/getadminContractor',
	    minLength: 2,
	    select: function( event, ui ) {
		    
		    if (ui.item.value == 'error') {
			    setTimeout(function(){
			    $('#awarded_to').val('');
			    $("#awarded_to_id" ).val('');
			    $("#awarded_type" ).val('');
			    },10);
		    }else{
			    $( "#awarded_to" ).val( ui.item.label );
			    $( "#awarded_to_id" ).val( ui.item.id );
			    $("#awarded_type" ).val( ui.item.type );
			    
		    }
	    }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
	    return $( "<li>" )
	    .append( item.label)
	    .appendTo( ul );
    };
    
    $( "#choose_bidder" ).autocomplete({
	    search  : function(){$(this).addClass('autoloader');},
	    open    : function(){$(this).removeClass('autoloader');},
	    source: BASE_URL + '/admin/getprojectBidder?pid='+$('#hidden_project_id').val(),
	    minLength: 2,
	    select: function( event, ui ) {
		    
		    if (ui.item.value == 'error') {
			    setTimeout(function(){
			    $("#choose_bidder").val('');
			    $("#bidder_to_id").val('');
			    },10);
		    }else{
			    $("#choose_bidder").val( ui.item.label );
			    $("#bidder_to_id").val( ui.item.id );
			}
	    }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
	    return $( "<li>" )
	    .append( item.label)
	    .appendTo( ul );
    };
    
    $( ".projectIdFromBidder" ).autocomplete({
	    search  : function(){$(this).addClass('autoloader');},
	    open    : function(){$(this).removeClass('autoloader');},
	    source: BASE_URL + '/admin/getProjectId',
	    minLength: 2,
	    select: function( event, ui ) {
		    if (ui.item.value == 'error') {
			    setTimeout(function(){
			    $('.projectIdFromBidder').val('');
			    },10);
		    }else{
			    $( ".projectIdFromBidder" ).val( ui.item.label );
		    }
	    }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
	    return $( "<li>" )
	    .append( item.label)
	    .appendTo( ul );
    };
    
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
    
    $("#productform").validate({
	//ignore: ':hidden:not("textarea[name=product_desc]")',
        rules:{
	    product_link: { required: true,
	    url:true},
        },

    });
    
    $( ".contractor_business_name" ).autocomplete({
	    search  : function(){$(this).addClass('autoloader');},
	    open    : function(){$(this).removeClass('autoloader');},
	    source: BASE_URL + '/admin/getOnlyContractor',
	    minLength: 2,
	    select: function( event, ui ) {
		    if (ui.item.value == 'error') {
			    ui.item.value  = '';
			    $(this).find( ".contractor_business_name" ).val( ui.item.label );        
			    $(this).next( ".contractor_id" ).val('');
		    }else{
			    $(this).find( ".contractor_business_name" ).val( ui.item.label );
			    $(this).next( ".contractor_id" ).val( ui.item.id );
		    }
	    }
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
    
	    return $( "<li>" )
	    .append( item.label)
	    .appendTo( ul );
    };
    
    /***** Start of Article Validation *****/
    $("#article_form").validate({
	
        rules:{
            topic_id : "required",
	    article_title : "required",
            author : "required",
            //article_desc : "required",
            status : "required"                 
        },
        messages: {
        }
    });
    
    $("#ads_edit_form").validate({
	
        rules:{
            ad_name : "required",
	    ad_link : {
		
		required:true,
                url:true
	    },
            
            ad_status : "required"                 
        },
        messages: {
	    
	    ad_link : {
                url:'Please enter proper url.'
	    },
	    
        }
    });
    
    /***** End of Article Validation *****/
     
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
    
    deleteRecord('delete','owner_id',ADMIN_URL+'/business-owner/delete','Business owner deleted successfully.');
    
    deleteRecord('user_delete','user_id',ADMIN_URL+'/user/delete','User deleted successfully.');
    
    deleteRecord('business_profile_delete','business_profile_id',ADMIN_URL+'/user/business_profile_delete','Business Profile deleted successfully.');
    
    deleteRecord('product_delete','product_id',ADMIN_URL+'/product/delete','Product deleted successfully.');
    
    deleteRecord('article_delete','article_id',ADMIN_URL+'/article/delete','Article deleted successfully.');
    
    deleteRecord('store_category_delete','store_category_id',ADMIN_URL+'/store-category/delete','Category deleted successfully.');
    
    deleteRecord('service_category_delete','service_category_id',ADMIN_URL+'/service-category/delete','Category deleted successfully.');
    
    deleteRecord('coupon_delete','coupon_id',ADMIN_URL+'/coupon/delete','Coupon deleted successfully.');
    
    deleteRecord('event_delete','event_id',ADMIN_URL+'/event/delete','Event deleted successfully.');
    
    deleteRecord('post_cat_delete','post_cat_id',ADMIN_URL+'/category/delete','Category deleted successfully.');
    
    deleteRecord('post_delete','post_id',ADMIN_URL+'/post/delete','Post deleted successfully.');
    
    deleteRecord('service_delete','service_id',ADMIN_URL+'/service/delete','Service deleted successfully.');
    

    
    
    $("#coupon_form").validate({
        rules:{
            coupon_code : "required",
            coupon_title : "required",
            coupon_discount : "required",
            coupon_expiry : "required"                
        },
        messages: {
        }
    });
    
        $("#forumform").validate({
        rules:{
            topic_title : "required",
             desc : "required",
                 
        },
        messages: {
        }
    });
    
    
    $("#post_form").validate({
        rules:{
            post_title : "required"                
        },
        messages: {
        }
    });
    
    
    $("#post_category_form").validate({
        rules:{
            category_name : "required"                
        },
        messages: {
        }
    });
    
    
    $(function() {
			 var nowDate = new Date();
			 var from 	= new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0,0);
			 
			 //$('#datetimepicker1').datepicker('setDate',nowDate);
			 $('#datetimepicker1').datetimepicker({
					autoclose:true,
					startDate: from,
					disableEntry: true,
		
			 })
			 .on('changeDate', function(selected){
					startDate = new Date(selected.date.valueOf());
					startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
					$('#datetimepicker2').datetimepicker('setStartDate', new Date(startDate.getTime()+1*24*60*60*1000) );
					//$('#datetimepicker2').datepicker('setEndDate', new Date(startDate.getTime()+14*24*60*60*1000) );
					$( "#datetimepicker2" ).datetimepicker('show');
			 }); 
			 //$('#datetimepicker2').datepicker('update', new Date());
			 $('#datetimepicker2').datetimepicker({
					autoclose:true,
					startDate:from,
					disableEntry: true
			 })
			 .on('changeDate', function(selected){
					
			 });
			 
	  });
    
    /*post section
     *
     */
    
    $("#post_image_add").click(function(){
        $("#dvPreview").html("");
        $('#myModal').modal('hide');
        var file = $('#post_image').val();
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        if (regex.test(file.toLowerCase())) {
            
            if (typeof (FileReader) != "undefined") {
                $("#dvPreview").show();
                $("#dvPreview").append("<img />");
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#dvPreview img").attr("src", e.target.result).width(250).height(200);
                }
                reader.readAsDataURL($("#post_image")[0].files[0]);
            }
            else{
                alert("This browser does not support FileReader.");
            }
        }
        else {
            alert("Please upload a valid image file.");
        }
        
        
        if ($("#dvPreview").length >0) {
            $("#add_featured").hide();
            $("#remove_featured").show();
        }
        
        //if ($("#post_image").val().length >0) {
        //    alert('ok');
        //}
        
    });
    
    
    if ($("#dvPreview").length > 0 ) {
        $("#add_featured").hide();
        $("#remove_featured").show();
    }
    else{
         $("#add_featured").show();
         $("#remove_featured").hide();
    }
    
    $("#remove_featured").click(function(){
        $("#post_image").val('');
        $("#dvPreview").empty();
        $("#add_featured").show();
        $("#remove_featured").hide();
    });
    
    
    $(".form-validate").validate({
        errorPlacement: function(error, element)
        {
            error.insertAfter(element);
        }
    });
    
    
    $('.residential, .commercial').css('display','none');
    $('.error_lebel').text('');
   
    if($("input:radio[name='licensed_contractor']").is(":checked")){
   
    if($("input[name='licensed_contractor']:checked").val() == 'Yes')
    {
	$('.residential, .commercial').css('display','block');
	//if($('#residential').val() == '' && $('#commercial').val() == '')
	//{
	//    $('.error_lebel').text('Please enter Commercial Or Residential').css('color','red');
	//    $('.customer-create').prop('disabled', true);
	//}
	
	
    }
    else if ($("input[name='licensed_contractor']:checked").val() == 'No') {
	$('.residential, .commercial').css('display','none');
	$('.customer-create').prop('disabled', false);
	$('.error_lebel').text('');
    }
   }
   
   $('input:radio[name="licensed_contractor"]').change(function(){
    if ($(this).val() == 'Yes')
    {
	 $('.residential, .commercial').css('display','block');

	
    }
    else if ($(this).val() == 'No') {
	$('.residential, .commercial').css('display','none');
	$('.customer-create').prop('disabled', false);
	$('.error_lebel').text('');
    }
    //console.log($(this).val());
   });
   
//   $('.customer-create').click(function(){
//    
//    if($('#residential').val() == '' && $('#commercial').val() == '')
//    {
//	    $('.error_lebel').text('Please enter Commercial Or Residential').css('color','red');
//	    $('.customer-create').prop('disabled', true);
//    }
//    
//    
//   });
   
   $('#residential, #commercial').keyup(function(){
   
         if($('#residential').val() != '' || $('#commercial').val() != '')
	 {
	   
	    $('.customer-create').prop('disabled', false);
	    $('.error_lebel').text('');
	 }
	 else
	 {
	     $('.error_lebel').text('Please enter Commercial Or Residential').css('color','red');
	    $('.customer-create').prop('disabled', true);
	 }
   });
   
   $('#permit').blur(function(){
    $('#permit').parents(".state-success" ).removeClass('state-success');
    var permit_value = $(this).val();
    var building_id  = $('input[name="building_id"]').val();
    $.ajax({
	url:ADMIN_URL+"/permit-exist",
	type:"POST",
	dataType : 'JSON',
	beforeSend: function() {
	    $('.add_icon').html('<i class="fa fa-refresh fa-spin"></i>');
	},
	data:{"permit_value":permit_value,_token: CSRF_TOKEN,'building_id':building_id},
	success:function(msg){
	    if (msg != null) {
		
		$('#permit').parent().parent('.form-group').removeClass('has-success');
		$('#permit').parent().parent('.form-group').addClass('has-error');
		$('.add_icon').html('<i class="fa fa-times tooltips" data-container="body" data-original-title="You look OK!" data-hover="tooltip"></i>');
		var show_msg = '';
		$.each(msg,function(index , value){
		    show_msg += '<a href="'+value+'" target="_blank" >'+value+'</a><br>';
		});
		$('.exist_permit').html(show_msg);
	    }else{
		
		$('#permit').parent().parent('.form-group').removeClass('has-error');
		$('#permit').parent().parent('.form-group').addClass('has-success');
		$('.add_icon').html('<i class="glyphicon glyphicon-ok tooltips" data-container="body" data-original-title="You look OK!" data-hover="tooltip"></i>');
		$('.exist_permit').html('');
	    }
	}
    });
   })
});



function checkEmpty() {


    if($("input:radio[name='licensed_contractor']").is(":checked")){
   
    if($("input[name='licensed_contractor']:checked").val() == 'Yes')
    {

	if($('#residential').val() == '' && $('#commercial').val() == '')
	{
		$('.error_lebel').text('Please enter Commercial Or Residential').css('color','red');
		$('.customer-create').prop('disabled', true);
		 return false;
	}
    }
    }
}

    function statusModifier(type,element){
		var id = $(element).attr('data-id'); 
		//$("#loader_"+id).css("visibility","visible");
		var url ='';
		
		switch (type) { 
				case "ads":	url = ADMIN_URL+"/ads/set-status";									break;
		}
		//$(element).removeClass('label-success');
		//$(element).removeClass('label-warning');
		$(element).find('i').addClass('fa fa-spinner');
		$.ajax({
				url:url,
				type:"POST",
				data:{"id":id,_token: CSRF_TOKEN},
				success:function(msg){
				   
						
						if ($(element).hasClass("label-success")==true) {
								$(element).addClass("label-warning");
								$(element).removeClass("label-success");
								
								$(element).text('Pending');
								$(element).find('i').removeClass('fa fa-spinner');
								
						}
						else if ($(element).hasClass("label-warning")==true) {
								$(element).addClass("label-success");
								$(element).removeClass("label-warning");
								$(element).find('i').removeClass('fa fa-spinner');
								
								$(element).text('Approved');
						}
					
				}
		});
        
    
}