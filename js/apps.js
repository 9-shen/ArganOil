(function($){

// Page loading
$(window).load(function(){
    
    $(".loading").fadeOut(1000);
    $("body").css("overflow","auto");
  });

  // Scroll to top
  var scrollTop = $("#scroll");

  $(window).scroll(function(){


    if($(this).scrollTop() >= 700){

        scrollTop.show();
    }else {
        scrollTop.hide();
    }

    scrollTop.click(function(){

      $("html,body").animate({scrollTop:0}, 600)

    });

  });

  // Wow.Js
  new WOW().init();

  // carousel our sponsor
  $("#owl").owlCarousel({
 
      autoPlay: 3000, //Set AutoPlay to 3 seconds
 
      items : 5,
      dots : false,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
 
  });

})(jQuery);