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



});



// footer dropdown





$(document).ready(function(){

  

    //$(".acc-head").click( function(){

    //    $(this).toggleClass("arrow");

    //    $(this).next(".holder").toggle("slow");       

    //});

    

  $( function() {

    $( "#accordion" ).accordion();

      //$( "#accordion" ).accordion({'collapsible':true,'active':false});



  } );

     
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





var select_all = document.getElementById("select_all"); //select all checkbox

var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items



//select all checkboxes

select_all.addEventListener("change", function(e){

    for (i = 0; i < checkboxes.length; i++) {

        checkboxes[i].checked = select_all.checked;

    }

});





for (var i = 0; i < checkboxes.length; i++) {

    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change

        //uncheck "select all", if one of the listed checkbox item is unchecked

        if(this.checked == false){

            select_all.checked = false;

        }

        //check "select all" if all checkbox items are checked

        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){

            select_all.checked = true;

        }

    });



   


}











