$(document).ready(function(){

	var rtl = false;
    if($("html").attr("lang") == 'ar'){
         rtl = true;
    }
    /*header-fixed*/
    $(window).scroll(function(){
            
        if ($(window).scrollTop() >= 100) {
            $('#header').addClass('fixed-header');
        }
        else {
            $('#header').removeClass('fixed-header');
        }
              
    });
    $('.scroll, .mmenu a').on('click', function () {
        
        $('html, body').animate({
           
            scrollTop: $('#' + $(this).data('value')).offset().top
           
        }, 1000);
        
        $("body,html").removeClass('menu-toggle');
        
        $(".hamburger").removeClass('active');
        
    });
    /*open menu*/
    $(".hamburger").click(function(){
        $("body,html").addClass('menu-toggle');
        $(".hamburger").addClass('active');
    });
    $(".m-overlay").click(function(){
        $("body,html").removeClass('menu-toggle');
        $(".hamburger").removeClass('active');
    });
    
    /*faq*/

    $(document).on('click','.zmdi-chevron-up,.zmdi-chevron-down',function(){
        $(this).parent().next().slideToggle(400);
        if ($(this).hasClass("zmdi zmdi-chevron-up")) {
            $(this).removeClass('zmdi zmdi-chevron-up').addClass('zmdi zmdi-chevron-down');
        }else{
            $(this).removeClass('zmdi zmdi-chevron-down').addClass('zmdi zmdi-chevron-up');
        }
    });


    $(document).on('click','.faqText',function(){
        $(this).parent().next().slideToggle(400);
        if ($(this).next().hasClass("zmdi zmdi-chevron-up")) {
            $(this).next().removeClass('zmdi zmdi-chevron-up').addClass('zmdi zmdi-chevron-down');
        }else{
            $(this).next().removeClass('zmdi zmdi-chevron-down').addClass('zmdi zmdi-chevron-up');
        }
    });
    
    /*niceScroll*/
    $(".content-body, .list-cart").niceScroll({
        cursorcolor: "#fff !important",
        cursorwidth: "30px"
    });
    
    
    
    /*cart-menu*/
    $(".toggle-nav").click(function(){
        if ($("body,html").hasClass('over-hide')) {
            $("body,html").removeClass('over-hide');
        } else {
            $("body,html").addClass('over-hide');
        }
    });
    $(function() {
        $('.toggle-nav').click(function(e) {
            if ($('.cart-menu').hasClass('show-cart')) {
                $('.cart-menu').removeClass('show-cart');
            } else {
                $('.cart-menu').addClass('show-cart');
            }
        });
    });
    

    
    /*slider*/
    
        $("#slider-testi").owlCarousel({
	        loop: true,
            margin: 0,
            rtl: true,
            singleItem:true,
            responsiveClass: true,
            items: 1,
            dots: false,
            nav: true,
            navText:['<i class="zmdi zmdi-chevron-left"></i>','<i class="zmdi zmdi-chevron-right"></i>'],
            autoplay:true
	    });
    
        $("#course-slider").owlCarousel({
            loop: true,
            margin: 0,
            rtl: true,
            singleItem:true,
            responsiveClass: true,
            items: 1,
            dots: true,
            nav: false,
            autoplay:true
        });
                
        $("#team-slider").owlCarousel({
            loop: true,
            margin: 10,
            rtl: true,
            singleItem:true,
            responsiveClass: true,
            responsive:{
                0:{
                    items:1,
                },
                460:{
                    items:2,
                },
                767:{
                    items:2,
                },
                
                992:{
                    items:4,
                }

            },
            dots: true,
            nav: false,
            autoplay:true
        });
    
        $("#instructors-slider").owlCarousel({
            loop: true,
            margin: 0,
            rtl: true,
            singleItem:true,
            responsiveClass: true,
            items: 1,
            dots: true,
            nav: false,
            autoplay:true
        });
    
});




/*Decrease & Increase*/    
var minimum_quanitiy=$(".jsQuantityDecrease").attr("minimum"),
productQuantity=minimum_quanitiy;
$(document).on("click",".jsQuantityDecrease",function(){
    var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    quantity = quantity * 1;
    var newQuantity = quantity - 1;
    $(this).parent().find('input[name="count-quat1"]').val(newQuantity);
    if (newQuantity <2) {
        $(this).parent().find(".jsQuantityDecrease").addClass("disabled");

    } else{
         $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
         $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");
    }
}),

$(document).on("click",".",function(){
    var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    quantity = quantity * 1;
    var newQuantity = quantity + 1;
    $(this).parent().find('input[name="count-quat1"]').val(newQuantity);
    if (newQuantity >=10) {
        
        $(this).parent().find(".jsQuantityIncrease").addClass("disabled");
        $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    } else{
         $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");

    }
    
});



