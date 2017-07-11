// bx sldier



$(document).ready(function(){

  $('.bxslider').bxSlider();

  
  if($('#horizontalTab').length > 0){

  

    $('#horizontalTab').easyResponsiveTabs({

      type: 'default', //Types: default, vertical, accordion           

      width: 'auto', //auto or any width like 600px

      fit: true,   // 100% fit in a container

      closed: 'accordion', // Start closed if in accordion view

      activate: function(event) { // Callback function if tab is switched

          var $tab = $(this);

          var $info = $('#tabInfo');

          var $name = $('span', $info);

          $name.text($tab.text());

          $info.show();

      }

    });

  }
  
  $('input[name="subscriptionQuarterly[]"]').click(function(){
    
      var totalSubscriptionPrice    = 0;
      if( $('.subscriptionQuarterly:checked').length > 0){
        $('input[name=subscription][value=quarterly]').prop('checked',true);
        $('.subscriptionYearly').prop('disabled',true);
        $('.subscriptionQuarterly:checked').each(function(){
        var unitValue         = $(this).attr('data-attr');
        totalSubscriptionPrice  = totalSubscriptionPrice+parseFloat(unitValue);
        });
        $('#totalSubscriptionFee').html(totalSubscriptionPrice.toFixed(2));
      }else{
        $('#totalSubscriptionFee').html('0.00');
        $('input[name=subscription][value=quarterly]').prop('checked',false);
        $('.subscriptionYearly').prop('disabled',false);
      }
      $('input[name=total_amount]').val($('#totalSubscriptionFee').html());
      
  });

  $('input[name="subscriptionYearly[]"]').click(function(){
    
      var totalSubscriptionPrice    = 0;
      if( $('.subscriptionYearly:checked').length > 0){
      $('input[name=subscription][value=yearly]').prop('checked',true);
      $('.subscriptionQuarterly').prop('disabled',true);
      $('.subscriptionYearly:checked').each(function(){
        var unitValue         = $(this).attr('data-attr');
        totalSubscriptionPrice  = totalSubscriptionPrice+parseFloat(unitValue);
      });
      $('#totalSubscriptionFee').html(totalSubscriptionPrice.toFixed(2));
      }else{
        $('#totalSubscriptionFee').html('0.00');
        $('input[name=subscription][value=yearly]').prop('checked',false);
        $('.subscriptionQuarterly').prop('disabled',false);
      }
      $('input[name=total_amount]').val($('#totalSubscriptionFee').html());
  });


});



// footer dropdown





$(document).ready(function(){
  $( "#accordion" ).accordion();
  $(".accroTitle").on("click", function(e){
      if($(this).parent().has(".accroContainer")) {
        e.preventDefault();
      }
      
      if(!$(this).hasClass("open")) {
        // hide any open menus and remove all other classes
        $(".accroContainer").slideUp(350);
        $(".accroTitle").removeClass("open");
        
        // open our new menu and add the open class
        $(this).next(".accroContainer").slideDown(350);
        $(this).addClass("open");
      }
      
      else if($(this).hasClass("open")) {
        $(this).removeClass("open");
        $(this).next(".accroContainer").slideUp(350);
      }
  }); 
});


$(function () {
    
    
    if ($(".form-report.edit_tab").length > 0) {
	var url = window.location.href;
	var urlArr = url.split('#');
	if (urlArr[1] == 'subscription' || urlArr[1] == 'card_details') {
	    $(".form-report.edit_tab li").removeClass('active');
	    $(".form-report.edit_tab a[href='#"+urlArr[1]+"']").parent().addClass('active');
	    $('.form-report.edit_tab .tab-content .tab-pane').removeClass('in active');
	    $('.form-report.edit_tab .tab-content #'+urlArr[1]).addClass('in active');
	}
    }
    
    $('#select_all:checkbox').change(function () {
     if($('#select_all').is(':checked')) {
         $('input:checkbox').prop('checked','checked');
         $('#print_jobs').css('display', 'inline');
         }
     else {
         $('input:checkbox').removeAttr('checked');
         $('#print_jobs').css('display', 'none');
     };
     
    });
    
    $('.delivery_type').change(function(){
      var type = $(this).val();
      if (type == 'store_location') {
        $('.store_location_show').show();
        $('.local_delivery_show').hide();
      }else if (type == 'local_delivery') {
        $('.store_location_show').hide();
        $('.local_delivery_show').show();
	$('.states_change').trigger('change')
      }else{
        $('.store_location_show').hide();
        $('.local_delivery_show').hide();
      }
      
      $('.states_change').trigger('change');
    });
    
    $('.payment_type').change(function(){
	if ($(this).val() != '') {
	    if($(this).val() == 'cc'){
		$('.card_details').show();
	    }else{
		$('.card_details').hide();
	    }
	}else{
	    $('.card_details').hide();
	}
    });
    
    $('payment_type').trigger('change');
});




$( function() {
  
  var current_link = window.location.href;
  if (current_link.indexOf('planroom-list') != -1 || current_link.indexOf('calendar') != -1) {
    cartView();
  }
  
  if (current_link.indexOf('project-list') != -1 || current_link.indexOf('private-project-list') != -1 || current_link.indexOf('private-project-lists') != -1 || current_link.indexOf('project-lists') != -1 || current_link.indexOf('edit-user-profile') != -1 || current_link.indexOf('edit-company-profile') != -1) {
    privateCartView();
  }
  
  $("#phone").mask("(999) 999-9999");
  $("#fax").mask("(999) 999-9999");
  $("#register_post").validate({
          rules: {
                  password        : {
                                      required: true
                                    },
                  retypepassword  : {
                                      required: true,
                                      //minlength: 6,
                                      equalTo: "#password"
                                    },
                  email           : {
                                      required: true,
                                      email: true
                                    },
                  business_name   : {
                                      required  : true,
                                      reg       : true
                                    },
                  website_url   : {
                                      required  : true,
                                      domain    : true
                                    },                      
                  first_name      : "required",
                  last_name       : "required",
                  terms_of_service: "required",
                  privacy_policy  : "required"
          },
          messages: {
                  first_name      : "Please enter your first name",
                  last_name       : "Please enter your last name",
                  business_name   : {required: "Please enter a business name" },
                  password        : {
                                      required: "Please provide a password",
                                      minlength: "Your password must be at least 6 characters long"
                                    },
                  retypepassword: {
                          required: "Please provide a password",
                          minlength: "Your password must be at least 6 characters long",
                          equalTo: "Please enter the same password as above"
                  },
                  email             : "Please enter a valid email address",
                  terms_of_service  : "Please check terms of service",
                  privacy_policy    : "Please check privacy policy"
          },
          
          submitHandler: function(form) {
            var c = checkStrength($("input[name=password]").val());
                  if (c==true) {
                    form.submit();
                  }
		    
          }
  });
  
  jQuery.validator.addMethod("reg", function(value, element) {
    return this.optional( element ) || /^[a-zA-Z0-9\'\-\. ]+$/.test( value );
  }, 'Business name should be Letters and numbers only');
  
  jQuery.validator.addMethod("domain", function(value, element) {
    return this.optional( element ) || /^[a-z0-9-\.]+\.[a-z]{2,4}/.test( value );
  }, 'Please enter proper url');
  
  
  
$("#login").validate();
$('#credit_card_info').validate();
  
$('#more_info_post').validate({
    rules: {
            'profession[]'  : 'required',
            'division[]'    : "required",
            'trade[]'       : "required"
          },
    messages: {
            'profession[]'  : "Please select at least one in each group",
            'division[]'    : "Please select at least one in each group",
            'trade[]'       : "Please select at least one in each group",
    },
    //errorElement : 'div',
    errorPlacement: function ($error, $element) {
	$("#errorTxt").html($error);
    }
  });

  $('#new_subscription_payment').validate({
    rules: {
            'newSubscribe[]'  : 'required'
          },
    messages: {
            'newSubscribe[]'  : "Please select at least one"
    },
    errorPlacement: function ($error, $element) {
	$("#errorTxt").html($error);
    }
  });
  
  //$("#resendMail").validate();
  
  $("#login_header").validate();
  
  $("#forgotForm").validate();
  $("#free_consultant").validate();
  $('.paymentForm').validate();
  
  $("#edit_profile").validate({

      rules: {
             
              business_name   : {
                                  required  : true,
				  reg       : true
                                },
              first_name      	: "required",
              last_name       	: "required",
	      website_url   	: {
                                      required  : true,
                                      domain    : true
                                    }
            
      },
      messages: {
              first_name      : "Please enter your first name",
              last_name       : "Please enter your last name",
              business_name   : "Please enter a business name",
              
      }
  
  });
  
  $("#password_reset").validate({
    
    rules: {
                password: "required",
                password_confirmation: {
                  equalTo: "#password"
                }
              }
    
  });
  
  $('#chnge_pwd').validate({
    
    
    rules: {
                old_password: {
                  required: true,
                  
                },
                password: {
                  required:true,
                  minlength: 6
                },
                retypepassword: {
                  equalTo: "#password"
                }
              }
    
  });
  
  $("#checkout").validate();
  
  $('input[name=subscription]').click(function(){
    $('#totalSubscriptionFee').html('0.00');
    $('#subscriptin_err_msg').text('');
    var subscription_val = $('input[name=subscription]:checked').val();
    if (subscription_val == 'quarterly') {
      $(".subscriptionQuarterly").prop('checked',false);
      $(".subscriptionQuarterly").prop('disabled',false);
      $(".subscriptionYearly").prop('disabled',true);
    }else if(subscription_val == 'yearly'){
      $(".subscriptionQuarterly").prop('checked',false);
      $(".subscriptionQuarterly").prop('disabled',true);
      $(".subscriptionYearly").prop('disabled',false);
    }
  });
  
  $('.newSubscribe').click(function(){
    $('#newsubscriptionFee').html('0.00');
    $('input[name=newsubscriptionFees]').val('0.00');
    var total_price = 0;
    $('.newSubscribe:checked').each(function(k,v){
	total_price += parseFloat($(v).next('.newClass').text());
    });
    $('#newsubscriptionFee').html(total_price);
    $('input[name=newsubscriptionFees]').val(total_price);
  });
  $('.btn-register').click(function(e){
    
    var subscription = $('input[name=subscription]:checked').length;
    if (subscription > 0) {
      
      //var url = BASE_URL + '/register';
      
      if($("input[type=checkbox]:checked").length != 0){
        $('#subscription-form').submit();
        //$(this).attr('href',url)
      }else{
        $('#subscriptin_err_msg').text('Please check at least one.');
      }
      
    }else{
      
      $('#subscriptin_err_msg').text('Please select the sunscription type.');
      
    }

    
  });
  
  $('#change_view').change(function(){
    
      $('#view_pegi').submit();
      
  });
  
  //$('.planroom_list').DataTable({
  //  "bPaginate"   : false,
  //  "bFilter"     : false,
  //  "bInfo"       : false,
  //  "columnDefs"  : [ {"targets": 0,"orderable": false },{"targets": -1,"orderable": false } ],
  //  "order"       : [[ 1, 'desc' ]]
  //});
  
  //$('.building_list').DataTable({
  //  "bPaginate"   : false,
  //  "bFilter"     : false,
  //  "bInfo"       : false,
  //  "columnDefs"  : [ {"targets": 0,"orderable": false } ],
  //  "order"       : [[ 1, 'desc' ]]
  //});
  //$('.savetrack_list').DataTable({
  //  "bPaginate"   : false,
  //  "bFilter"     : false,
  //  "bInfo"       : false,
  //  "columnDefs"  : [ {"targets": 0,"orderable": false },{"targets":  -1,"orderable": false }],
  //  "order"       : [[ 6, 'desc' ]]
  //});
  //
  $('.private_planroom_list').DataTable({
    "bPaginate"   : false,
    "bFilter"     : false,
    "bInfo"       : false,
    "order"       : [[ 0, 'desc' ]]
  });
  
  
  $( "#autocompleteContractor" ).autocomplete({
          search  : function(){$(this).addClass('autoloader');},
          open    : function(){$(this).removeClass('autoloader');},
          source: BASE_URL + '/getContractor',
          minLength: 2,
          select: function( event, ui ) {
                  
                  if (ui.item.value == 'error') {
                          setTimeout(function(){
                          $('#autocompleteContractor').val('');
                          $("#contractor_id" ).val('');
                          },10);
                  }else{
                          $( "#autocompleteContractor" ).val( ui.item.label );
                          $( "#contractor_id" ).val( ui.item.id );
                          
                  }
          }
  }).autocomplete( "instance" )._renderItem = function( ul, item ) {
          return $( "<li>" )
          .append( item.label)
          .appendTo( ul );
  };

});
function tracking_ajax(project) {
  
  $.ajax({
    url     : BASE_URL+'/tracking',
    type  : 'POST',
    data    : {'project' : project,'_token' : CSRF_TOKEN},
    success : function(msg){
      if (msg == 0) {
        $('.track_button').html('Track This Project!');
        $('.tracking[data-project='+project+']').find('img').attr('src',BASE_URL+'/images/star1.png');
        $('.tracking[data-project='+project+']').attr('data-saved','');
	$('.seen-track[data-project-id='+project+']').remove();
       
      }else{
        $('.track_button').html('This Project is Tracked!');
        $('.tracking[data-project='+project+']').find('img').attr('src',BASE_URL+'/images/star2.png');
        $('.tracking[data-project='+project+']').attr('data-saved','active');
        
      }
    }
  });
  
}
   
   
         
  $('.tracking').click(function(){
     var project = $(this).attr('data-project');
     var is_saved = $(this).attr('data-saved');
     var saved_message = '';
     if(is_saved) {
         saved_message = 'Are you sure want to remove this project from the Saved track lists.<br/>Click OK to confirm.  Click Cancel to stop this action.';
     } else {
         saved_message = 'Are you sure want to add this project in to the Saved track lists.<br/>Click OK to confirm.  Click Cancel to stop this action.';
     }
     var $myDialog = $('<div></div>')
    .html(saved_message)
    .dialog({
                autoOpen: false, 
                resizable: false,
                height: 240,
                modal: true,
                buttons: {
                    "OK": function () {
                     tracking_ajax(project);    
                     $(this).dialog("close");
                     return true;
                     
                    },
                    Cancel: function () {
                     $(this).dialog("close");
                     return false;
                    }
                }  
            });
            
            $myDialog.dialog( "open" );
     
     
     
  });
  
  $('.normalsite').click(function(){
     var track_id = $(this).attr('data-track-id');
     var unread_message = 'Are you sure you want to leave this planroom?';
     var $myDialog = $('<div></div>')
    .html(unread_message)
    .dialog({
                autoOpen: false, 
                resizable: false,
                height: 200,
                modal: true,
                buttons: {
                    "OK": function () {
			window.location.href=BASE_URL+"/normal-site";
                     $(this).dialog("close");
                     return true;
                     
                    },
                    Cancel: function () {
                     $(this).dialog("close");
                     return false;
                    }
                }  
            });
            $myDialog.dialog( "open" );
  });
  
  
  $('.mark_unread').click(function(){
     var track_id = $(this).attr('data-track-id');
     var unread_message = 'Are you sure want to make this project as unread.<br/>Click OK to confirm.  Click Cancel to stop this action.';
     var $myDialog = $('<div></div>')
    .html(unread_message)
    .dialog({
                autoOpen: false, 
                resizable: false,
                height: 240,
                modal: true,
                buttons: {
                    "OK": function () {
                     $.ajax({
                        url     : BASE_URL+'/markAsUnread',
                        type  : 'POST',
                        data    : {'data_track' : track_id,'_token' : CSRF_TOKEN},
                        success : function(result){
                        $('.savetrack_list tr[data-project-id='+result+']').addClass('seen-track');
                        $('#mark_unread_'+result).hide();
                        
                        //$('.savetrack_list tr[data-project-id='+result+']').addClass('seen-track');
                    }
                    })
                        
                     $(this).dialog("close");
                     return true;
                     
                    },
                    Cancel: function () {
                     $(this).dialog("close");
                     return false;
                    }
                }  
            });
            
            $myDialog.dialog( "open" );
     
     
     
  });
  
  
  
    $('.buttonCardDelete').click(function(){
     var unread_message = 'Are you sure to delete Card?.<br/>Click OK to confirm.  Click Cancel to stop this action.';
     var $myDialog = $('<div></div>')
    .html(unread_message)
    .dialog({
                autoOpen: false, 
                resizable: false,
                height: 240,
                modal: true,
                buttons: {
                    "OK": function () {
		    window.location.href=BASE_URL+"/delete_card_info";
                     $(this).dialog("close");
                     return true;
                     
                    },
                    Cancel: function () {
                     $(this).dialog("close");
                     return false;
                    }
                }  
            });
            $myDialog.dialog( "open" );
  });
    
    $('.enabledisable').click(function(){
    var click_link = $(this).attr('data-href');
    var unread_message = 'Are you sure to ??.<br/>Click OK to confirm.  Click Cancel to stop this action.';
    var $myDialog = $('<div></div>')
    .html(unread_message)
    .dialog({
                autoOpen: false, 
                resizable: false,
                height: 240,
                modal: true,
                buttons: {
		    
                    "OK": function () {
		     window.location.href=click_link;
                     $(this).dialog("close");
		     return false;
                     return true;
                     
                    },
                    Cancel: function () {
                     $(this).dialog("close");
                     return false;
                    }
                }  
            });
            $myDialog.dialog( "open" );
  });
    
  
  $('.details_show').click(function(){
    var project = $(this).attr('data-project');
    var page    = $(this).attr('data-page');
    $.ajax({
      url     : BASE_URL+'/details',
      type  : 'POST',
      beforeSend: function() {
        $('.details_loader').addClass('loader');
        $('.details_loader').html('<div><img src='+BASE_URL+'/images/loading.gif'+'></div>');
        //return false;
      },
      data    : {'project' : project,'page' : page, '_token' : CSRF_TOKEN},
      success : function(msg){
        $('.details_loader').removeClass('loader');
        $('.details_loader').html('');
        $('.details_view').html(msg);
        $('#horizontalTab').easyResponsiveTabs();
        if($('.plan_view').length > 3){
          $('.tab-box-hold.plan').addClass('plan-scroll');
        }
        //track
        $('.track_button').click(function(){
          tracking_ajax(project);
        });
        //Close
        $('.close_button').click(function(){
          $('.details_view').html('');
        });
	 //Select All Plan
	
	
        $('.details_view .view_plan_images').click(function(){
                $('.view-pdf-container').html('');
                var file_id = $(this).attr('data-plan-file-id');
		var project_id 	= $(this).attr('data-project');
                getPdfImages('plan',file_id,project_id);
                
                
        });
        $(".view-all-pdf-images").click(function(){
            var file_id 	= $(this).attr('data-cat');
	    var project_id 	= $(this).attr('data-project');
	    
            getPdfImages('category',file_id,project_id);
        })
	
        //Select Plan
        $('.plan_check').click(function(){
	    
	    if ($(this).parents('.checkPlanContainer').find('.plan_check:checked').length == $(this).parents('.checkPlanContainer').find('.plan_check').length) {
		$(this).parents('.checkPlanContainer').find(".plan_check_cat").prop('checked',true);
	    }else{
		$(this).parents('.checkPlanContainer').find(".plan_check_cat").prop('checked',false);
	    }
          
          public_plan_check();
        });
        
	$(".plan_check_cat").click(function(){
	    $(this).parents('.checkPlanContainer').find('input[type=checkbox]').prop('checked',$(this).prop('checked'));
	    public_plan_check();
	});
    $(".all_plans_cat").click(function(){
        $(".checkPlanContainer input[type=checkbox]").prop('checked',$(this).prop('checked'));
        $(".checkPlanContainer input[type=checkbox]").prop('disabled',$(this).prop('checked'));
        public_plan_check();
    })
	
        //Add To Cart
        $('#addToCart').click(function(){
          var checkedValue = '';
          $($('.plan_check:checked')).each(function(){
            checkedValue += $(this).val()+',';
          });
	  var papersize 	= $('#addtocart_papersize_multiselect option:selected').val();
          var all_plans_cat 	= $('.all_plans_cat:checked').length;
          $.ajax({
            url     : BASE_URL+'/addToCart',
            type  : 'POST',
            //dataType : 'JSON',
            beforeSend: function() {
              //$('.details_loader').html('<div><img src='+BASE_URL+'/images/loading.gif'+'></div>');
            },
            data    : {'plan_id' : checkedValue,'papersize' : papersize, '_token' : CSRF_TOKEN,'all_plans_cat':all_plans_cat},
            success : function(msg){
              cartView();
              $('#job_multiorder_cart').hide();
              $('.cart_success').show();
              $('.plan_check').prop('checked',false);
                $('.plan_check_cat').prop('checked',false);
                $(".all_plans_cat").prop('checked',false);
              setTimeout(function(){
		$('.cart_success').hide();
	      }, 10000);
              
            }
          })
        });
        
        /*$('.changes_seen').click(function(){
          var data_track = $(this).attr('data-track-id');
          $.ajax({
              url     : BASE_URL+'/removeFromSaveTrack',
              type  : 'POST',
              data    : {'data_track' : data_track,'_token' : CSRF_TOKEN},
              success : function(result){
                $('.savetrack_list tr[data-project-id='+result+']').removeClass('seen-track');
                $(".changes_seen").hide();
                
              }
            })
        });*/
      }
    });
    
  });
  
  
  function getParameterByName(name, url) {
        if (!url) {
          url = window.location.href;
        }
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
  var project_id = getParameterByName('project_id');
  if (project_id !='') {
    $('.details_show[data-proid='+project_id+']').trigger('click');
  }
  
  function getPdfImages(type,id,project_id){
    $.ajax({
		url     : BASE_URL+'/view-plan-details',
		type  	: 'POST',
		data    : {'file_id' : id, '_token' : CSRF_TOKEN,'type':type,'project_id':project_id},
		dataType:'JSON',
		success : function(result){
		    
            $.fancybox.open(result, {
                   scrolling   	:'no',
                   beforeShow: function() {
                        $(".fancybox-image").attr('data-img',this.id);
                        $(".fancybox-inner").attr('data-img',this.id);
                        $(".fancybox-image").wrap('<a onclick="javascript: bigImageView('+this.id+')" ><div class="image-overlay"></div></a>')
                    },
                    
		    afterShow: function() {
			
			var innerBtnContainer = $("<div/>").addClass('inner-btn-conatiner').prependTo(this.inner);
			var innerBtns = $("<div/>").addClass('buttons').appendTo(innerBtnContainer);
			$("<button class='zoom-out'><img src='/images/zoom_out.png'/></button>").prependTo(innerBtns).click(function() {
			    var image = $('.fancybox-inner').attr('data-img');
			    $(".fancybox-image[data-img="+image+"]").trigger('click');
			});
			$("<button class='zoom-in'><img src='/images/zoom_in.png'/></button>").prependTo(innerBtns).click(function() {
			    var image = $('.fancybox-inner').attr('data-img');
			    $(".fancybox-image[data-img="+image+"]").trigger('click');
			});
			
                setTimeout(function(){
                  //  alert('ss');
                $(".fancybox-inner").css('oveflow','hidden');
                },1000);
		    },
                    afterClose:function(){
                         $(".view-pdf-big-image-container").hide();
                        },
			helpers : {
				thumbs : {
					width: 75,
					height: 50
				}
			}
		    });
	    
		    $(".fancybox-inner").on("contextmenu",function(e){
		       return false;
		    });    
		}
	    });
	    
  }
  
  function bigImageView(image){
    $(".view-pdf-big-image-container .panzoom img").attr('src',$(".fancybox-image[data-img="+image+"]").attr('src'));
    $(".fancybox-image[data-img="+image+"]").attr('href',"#big-image-container");
    var $section = $('#big-image-container');
   // var pos = $eye.position();
    $section.find('.panzoom').panzoom({
      $zoomIn: $section.find(".zoom-in"),
      $zoomOut: $section.find(".zoom-out"),
      $zoomRange: $section.find(".zoom-range"),
      animate: true,
      focal: {
          clientX: $("#big-image-container").width() / 2,
          clientY: $("#big-image-container").height() / 2
      }
      //$reset: $section.find(".reset"),
      //disableXAxis: true
    });
    $(".fancybox-image[data-img="+image+"]").fancybox({
	width : 1000,
		maxWidth	: 1600,
		maxHeight	: 600,
		fitToView	: false,
		//width		: '100%',
		//height		: '100%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		scrolling   	:'no',
        beforeShow: function() {
            $(".panzoom img").wrap('<div class="image-overlay"></div>')
        },
	});
    //$(".fancybox-image[data-img="+image+"]").trigger('click');
         
    //$(".view-pdf-big-image-container").show();
    
    $(".view-pdf-big-image-container").on("contextmenu",function(e){
	return false;
     });  
  }
  
  function public_plan_check(){
	    var plan_length = $('.plan_check:checked').length;
          if (plan_length > 0) {
            $('#job_multiorder_cart').show();
            //$('#job_multiorder_cart').hide();
            $('.total_document').html(plan_length);
            $('#addtocart_papersize_multiselect').change(function(){
              $('#addCartButton').hide();
              if($('#addtocart_papersize_multiselect option:selected').val() != ''){
                $('#addCartButton').show();
              }
            });
          }
	  else{
            $('#job_multiorder_cart').hide();
            $('.total_document').html(0);
          }
  }
  
  function project_details(project_id)
  {
    var project = project_id;
    var page    = '';
    $.ajax({
      url     : BASE_URL+'/details',
      type  : 'POST',
      beforeSend: function() {
        $('.details_loader').addClass('loader');
        $('.details_loader').html('<div><img src='+BASE_URL+'/images/loading.gif'+'></div>');
        //return false;
      },
      data    : {'project' : project,'page' : page, '_token' : CSRF_TOKEN},
      success : function(msg){
        $('.details_loader').removeClass('loader');
        $('.details_loader').html('');
        $('.details_view').html(msg);
        $('#horizontalTab').easyResponsiveTabs();
        //track
        $('.track_button').click(function(){
          tracking_ajax(project);
        });
        //Close
        $('.close_button').click(function(){
          $('.details_view').html('');
        });
        //Select Plan
        $('.plan_check').click(function(){
          var plan_length = $('.plan_check:checked').length;
          if (plan_length > 0) {
            $('#job_multiorder_cart').show();
            //$('#job_multiorder_cart').hide();
            $('.total_document').html(plan_length);
            
            $('#addtocart_papersize_multiselect').change(function(){
              $('#addCartButton').hide();
              if($('#addtocart_papersize_multiselect option:selected').val() != ''){
                $('#addCartButton').show();
              }
            });
          }else{
            $('#job_multiorder_cart').hide();
            $('.total_document').html(0);
          }
          
        });
        
        //Add To Cart
        $('#addToCart').click(function(){
          var checkedValue = '';
          $($('.plan_check:checked')).each(function(){
            checkedValue += $(this).val()+',';
          });
          var papersize = $('#addtocart_papersize_multiselect option:selected').val();
          $.ajax({
            url     : BASE_URL+'/addToCart',
            type  : 'POST',
            //dataType : 'JSON',
            beforeSend: function() {
              //$('.details_loader').html('<div><img src='+BASE_URL+'/images/loading.gif'+'></div>');
            },
            data    : {'plan_id' : checkedValue,'papersize' : papersize, '_token' : CSRF_TOKEN},
            success : function(msg){
              cartView();
              $('#job_multiorder_cart').hide();
              $('.cart_success').show();
              
              setTimeout(function(){ $('.cart_success').hide(); }, 10000);
              
            }
          })
        });
	
	
        
        /*$('.changes_seen').click(function(){
          var data_track = $(this).attr('data-track-id');
          $.ajax({
              url     : BASE_URL+'/removeFromSaveTrack',
              type  : 'POST',
              data    : {'data_track' : data_track,'_token' : CSRF_TOKEN},
              success : function(result){
                $('.savetrack_list tr[data-project-id='+result+']').removeClass('seen-track');
                $(".changes_seen").hide();
                
              }
            })
        });*/
      }
    });
    } 

  
  
  
  
    $('.privateplanroomdetails').click(function(){
    var project = $(this).attr('data-project');
    $.ajax({
      url     : BASE_URL+'/privateplanroomdetails',
      type  : 'POST',
      beforeSend: function() {
        $('.details_loader').addClass('loader');
        $('.details_loader').html('<div><img src='+BASE_URL+'/images/loading.gif'+'></div>');
        //return false;
      },
      data    : {'project' : project,'_token' : CSRF_TOKEN},
      success : function(msg){
        $('.details_loader').removeClass('loader');
        $('.details_loader').html('');
        $('.details_view').html(msg);
        $('#horizontalTab').easyResponsiveTabs();
        
        //Close
        $('.popupClose').click(function(){
          $('.details_view').html('');
        });
        
        //Select Plan
        $('.private_plan_check').click(function(){
          var plan_length = $('.private_plan_check:checked').length;
          private_plan(plan_length);
        });
        $('#select_all_plan').click(function(){
          if($('#select_all_plan').is(':checked')) {
              $('input.private_plan_check[type=checkbox]').prop('checked','checked');
              }
          else {
              $('input.private_plan_check[type=checkbox]').removeAttr('checked');
          };
          var plan_length = $('.private_plan_check:checked').length;
          private_plan(plan_length);
        });
        
        $('#addToCartPrivatePlan').click(function(){
          var checkedValue = '';
          $($('.private_plan_check:checked')).each(function(){
            checkedValue += $(this).val()+',';
          });
          var papersize = $('#addtocart_papersize option:selected').val();
          $.ajax({
            url     : BASE_URL+'/addToCartPrivatePlan',
            type  : 'POST',
            data    : {'plan_id' : checkedValue,'papersize' : papersize, '_token' : CSRF_TOKEN},
            success : function(msg){
              privateCartView();
              $('#privatejob_cart').hide();
              $('.cart_success').show();
              
              setTimeout(function(){ $('.cart_success').hide(); }, 10000);
              
            }
          })
        });

        
      }
    });
    
  });

function private_plan(plan_length) {
          if (plan_length > 0) {
            $('#privatejob_cart').show();
            $('.total_document').html(plan_length);
            
            $('#addtocart_papersize').change(function(){
              $('#addCartButton').hide();
              if($('#addtocart_papersize option:selected').val() != ''){
                $('#addCartButton').show();
              }
            });
          }else{
            $('#privatejob_cart').hide();
            $('.total_document').html(0);
          }
        }
        
  $('.changes_seen').click(function(){
          var data_track = $(this).attr('data-track-id');
          $.ajax({
              url     : BASE_URL+'/removeFromSaveTrack',
              type  : 'POST',
              data    : {'data_track' : data_track,'_token' : CSRF_TOKEN},
              success : function(result){
                $('.savetrack_list tr[data-project-id='+result+']').removeClass('seen-track');
                $("#mark_unread_"+result).css("display", "block");
                
                
              }
            })
        })
  
  function cartView(){
          $.ajax({
            url     : BASE_URL+'/cartView',
            type  : 'POST',
            beforeSend: function() {
              $('.details_loader').html('<div><img src='+BASE_URL+'/images/loading.gif'+'></div>');
            },
            data    : {'_token' : CSRF_TOKEN},
            success : function(msg){
              $('.details_loader').html('');
              $('#cartView').html(msg);
            }
          })
  }
 
  function privateCartView() {
        $.ajax({
            url       : BASE_URL+'/privateCartView',
            type      : 'POST',
            dataType  : 'JSON',
            beforeSend: function() {
              $('.details_loader').html('<div><img src='+BASE_URL+'/images/loading.gif'+'></div>');
            },
            data    : {'_token' : CSRF_TOKEN},
            success : function(result){
              $('.details_loader').html('');
              var msg = '';
              if (result.cart_item > 0) {
                msg += '<p>You have '+result.cart_item+' products in your cart</p>';
                msg += '<a href="'+BASE_URL+'/'+result.company_slug+'/private-planroom-cart">View Cart</a>';
              }else{
                msg += '<p>You have no products in your cart</p>';
              }
              $('#privateCartView').html(msg);
            }
          })
  }
  $(".check_all").click(function(){
     $(this).parents('.registerCheckContainer').find('input[type=checkbox]').prop('checked',true);
  });
  $(".uncheck_all").click(function(){
     $(this).parents('.registerCheckContainer').find('input[type=checkbox]').prop('checked',false);
  });
  
  
$(document).ready(function() {

  $('.userPassword').keyup(function() {
     checkStrength($(this).val());
  });
  //$('#register_post input[type=submit]').click(function() {
  //   checkStrength($(this).val());
  //});
  $('.resetform input[type=submit]').click(function() {
     checkStrength($(this).val());
  });
  
});
function checkStrength(password) {
var strength = 0; var length = 6;
$(".signupForm input[type=submit]").prop('disabled',false);
$('.userPassword').css('border','1px solid #81bc00');
$("#userPasswordErrSpan").empty();

if (password.length >=length) {
    strength += 1;
}else{
     $("#userPasswordErrSpan").append('* At least 6 characters long<br/>')
}
// If it has characters, increase strength value.
if (password.match(/([A-Z])/) ) {
    strength += 1
}else{
    $("#userPasswordErrSpan").append('* At least 1 upper case letter<br/>')
}


// If it has characters, increase strength value.
//if (password.match(/([a-z])/) ) {
//    strength += 1;
//}else{
//    
//    $("#userPasswordErrSpan").append('* At least 1 lower case letter<br/>');
//}
// If it has numbers  increase strength value.
if ( password.match(/([0-9])/)) {
    strength += 1;
}else{
    $("#userPasswordErrSpan").append('* At least 1 number<br/>');
}
// If it has one special character, increase strength value.
//if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
//    strength += 1;
//}else{
//    
//    $("#userPasswordErrSpan").append('* At least one symbol<br/>');
//}

  if (strength != 3) {
      $('.userPassword').css('border','1px solid red');
      $("#userPasswordErrSpan").show();
     // $(".signupForm input[type=submit]").prop('disabled',true);
     return false;
  }else{
      $("#userPasswordErrSpan").hide();
      //$(".signupForm input[type=submit]").prop('disabled',false);
      return true;
  }
}


$(".project_check").click(function(){ 
    var projectChecked = $("input.project_check[type=checkbox]:checked").length;
    if(projectChecked > 0) {
        $('#print_jobs').css('display', 'inline');
    } else {
        $('#print_jobs').css('display', 'none');
    }
    
});

$(".report_check").click(function(){
    var projectChecked = $("input.report_check[type=checkbox]:checked").length;
    if(projectChecked > 0) {
        $('#report_jobs').css('display', 'inline');
    } else {
        $('#report_jobs').css('display', 'none');
    }
    
});

$(".print_check").trigger("click");

///Building details show
  $('.building_details_show').click(function(){
    var item_id = $(this).attr('data-item');
    $.ajax({
      url     : BASE_URL+'/building_details',
      type  : 'POST',
      beforeSend: function() {
        $('.details_loader').addClass('loader');
        $('.details_loader').html('<div><img src='+BASE_URL+'/images/loading.gif'+'></div>');
        //return false;
      },
      data    : {'bid_id' : item_id,'_token' : CSRF_TOKEN},
      success : function(msg){
        $('.details_loader').removeClass('loader');
        $('.details_loader').html('');
        $('.details_view').html(msg);
        $('#horizontalTab').easyResponsiveTabs();
        
        
        //Close
        $('.close_button').click(function(){
          $('.details_view').html('');
        });
      }
    });
    
  });
  
  var building_id = getParameterByName('bid');
  if (building_id !='') {
    $('.building_details_show[data-bid='+building_id+']').trigger('click');
  }
// For dashboard tooltip  
$(document).ready(function(){
    $("span.no-tl-hold").bind("mousemove", function(event) {
        var elm = $(this);
        var num = elm.attr('data-val');
        if(num > 1){
            var xPos = -((event.pageX - elm.offset().left)+200);
        } else {

             var xPos = (event.pageX - elm.offset().left)-10;
        } 
        var yPos = event.pageY - elm.offset().top;
    $(this).find("div.tooltip").css({
    top: yPos + 25 + "px",
    left: xPos+ "px",
    }).show();
    }).bind("mouseout", function() {
    $("div.tooltip").hide();
    });
    
    
    $('.card-edit').keyup(function(){
	$("#card_number_value").val('');
	
	var card_val = $(this).val();
	if (card_val !='') {
	    if($.isNumeric(card_val)) {
		$("#card_number").val(card_val);
		$("#card_number_value").val(card_val);
		$('.error_lebel').text('');
		$('.card-update').prop('disabled', false);
	    }
	    else
	    {
		$('.error_lebel').text('Not a number. Please insert number only').css('color','red');
		$('.card-update').prop('disabled', true);
		
		return false;
	    }
	}
	
    });

    
    $('.residential, .commercial').css('display','none');
    
   
    if($("input:radio[name='licensed_contractor']").is(":checked")){
   
    if($("input[name='licensed_contractor']:checked").val() == 'Yes')
    {
	$('.residential, .commercial').css('display','block');
	
	
	
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
	 //if($('#residential').val() == '' && $('#commercial').val() == '')
	 //{
	 //   $('.error_lebel').text('Please enter Commercial Or Residential').css('color','red');
	 //   $('.customer-create').prop('disabled', true);
	 //}
	 
	
    }
    else if ($(this).val() == 'No') {
	$('.residential, .commercial').css('display','none');
	$('.customer-create').prop('disabled', false);
	$('.error_lebel').text('');
    }
    //console.log($(this).val());
   });
   

   
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


function getEventDate(event) { 
var dateobj = event.start;
var cellYear = dateobj.year();
var cellMonth = ("0" + (dateobj.month() + 1)).slice(-2);
var cellDay = ("0" + dateobj.date()).slice(-2);
date_here = cellYear+'-'+cellMonth+'-'+cellDay;
return date_here;
}
  

$(function(){
 
 if($(".orderProjects").length > 0){
     $(".orderProjects").each(function(){
        var newPlansTxt = '';var plans = [];
        $(this).find('.projectPlans').each(function(i,element){
            plans.push( $(element).attr('data-plan-name') );
        });
        plans = plans.sort();
        $.each(plans,function(ind,ele){
           newPlansTxt += "<tr>";
           newPlansTxt += $(".projectPlans[data-plan-name='"+ele+"']").html();
           newPlansTxt += "</tr>";
        });
        $(this).html(newPlansTxt);
        
    })
 }    
    
})