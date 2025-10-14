$(document).ready(function(){
	/*header-fixed*/
    /*header-fixed*/
    $(window).scroll(function(){

        if ($(window).scrollTop() >= 100) {
            $('.bt-header').addClass('fixed-header');
        }
        else {
            $('.bt-header').removeClass('fixed-header');
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


    /*cart-menu*/
	$(function() {
		$('.btn-contact').click(function() {
				toggleNav();
			});
		});
		function toggleNav() {
			if ($('.aside-contact').hasClass('show-aside')) {
				$('.aside-contact').removeClass('show-aside');
			} else {
				$('.aside-contact').addClass('show-aside');
			}

			if ($('body').hasClass('over-hidden-body')) {
				$('body').removeClass('over-hidden-body');
			} else {
				$('body').addClass('over-hidden-body');
			}

		}
    $('.close-aside').click(function() {
            $('.aside-contact').removeClass('show-aside');
            $('body').removeClass('over-hidden-body');
    });

    /*page-scroll*/

    $(function() {
        $(document).on('click', 'a.page-scroll', function(event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $($anchor.attr('href')).offset().top-0
            }, 600, 'easeInOutExpo');
            event.preventDefault();
        });
    });

    //
    $('#home_slider').owlCarousel({
        loop: false,
        margin: 0,
        rtl: true,
        singleItem:true,
        responsiveClass: true,
        items:1,
        dots: true,
        nav: false,
        autoplay: true,
        autoHeight: true
    });

    $('#categoris_slider').owlCarousel({
        loop: false,
        margin: 10,
        rtl: true,
        // singleItem:true,
        nav: false, // this removes arrows

        responsiveClass: true,
        responsive:{
            0:{
                items:3,
            },
            470:{
                items:3,
            },
            650:{
                items:3,
            },
            767:{
                items:3,
            },
            991:{
                items:5,
            },
            1199:{
                items:5,
            }

        },
        dots: true,
        // nav: true,
        navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
        autoplay: false
    });


    $('#venders_slider').owlCarousel({
        loop: false,
        margin: 10,
        rtl: true,
        // singleItem:true,
        nav: false, // this removes arrows

        responsiveClass: true,
        responsive:{
            0:{
                items:3,
            },
            470:{
                items:3,
            },
            650:{
                items:3,
            },
            767:{
                items:3,
            },
            991:{
                items:5,
            },
            1199:{
                items:5,
            }

        },
        dots: true,
        // nav: true,
        navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
        autoplay: false
    });

    $('#similar_slider').owlCarousel({
        loop: false,
        margin: 20,
        rtl: true,
        singleItem:true,
        responsiveClass: true,
        responsive:{
            0:{
                items:1,
            },
            470:{
                items:1,
            },
            650:{
                items:1,
            },
            767:{
                items:1,
            },
            991:{
                items:4,
            },
            1199:{
                items:4,
            }

        },
        dots: false,
        nav: true,
        navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
        autoplay: false
    });


    $(".jsQuantityDecrease").click(function() {
        var quantity = $(this).parent().find('input[name="count-quat1"]').val();
        quantity =  parseInt(quantity);
        var newQuantity = quantity - 1;

        var minQty = $(this).parent().find('input[name="count-quat1"]').attr("min");
        var maxQty = $(this).parent().find('input[name="count-quat1"]').attr("max");

        $(this).parent().find('input[name="count-quat1"]').val(newQuantity);


        if (newQuantity <= minQty) {
            $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
            $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");
        }
        else if (newQuantity > minQty) {
            $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
            $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");
        }
        else{
            $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
            $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");

        }


    });
    $(".jsQuantityIncrease").click(function() {
        var quantity = $(this).parent().find('input[name="count-quat1"]').val();
        quantity =  parseInt(quantity);
        var newQuantity = quantity + 1;

        var minQty = $(this).parent().find('input[name="count-quat1"]').attr("min");
        var maxQty = $(this).parent().find('input[name="count-quat1"]').attr("max");

        $(this).parent().find('input[name="count-quat1"]').val(newQuantity);

        if (newQuantity >= maxQty) {
            // $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
            $(this).parent().find(".jsQuantityIncrease").addClass("disabled");
        }
        else if (newQuantity < maxQty) {
            $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
            $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");
        }

        else{
            $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
            $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");

        }
    });
    $('input[name="count-quat1"]').on("keyup", function() {
        var quantity = $(this).val();
        quantity =  parseInt(quantity);

        var minQty = $(this).attr("min");
        var maxQty = $(this).attr("max");


        if(quantity <= minQty){
            $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
            $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");
        }
        else if(quantity >= maxQty){
            $(this).val(maxQty);
            $(this).parent().find(".jsQuantityIncrease").addClass("disabled");
            $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
        }else{
            $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
            $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");
        }
    });



});


 /*Decrease & Increase*/


    // $(document).on("click",".jsQuantityDecrease",function () {
    //     var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    //     quantity = quantity * 1;
    //     var newQuantity = quantity - 1;
    //     var minQty = $(this).attr("minimum");
    //     var maxQty = $(this).attr("max");

    //     // alert($(this).attr("max"));
    //     // alert(newQuantity);
    //     $(this).parent().find('input[name="count-quat1"]').val(newQuantity);
    //     if (newQuantity == 1) {
    //         $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
    //         $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");

    //     } else{

    //         $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    //         // $(this).parent().find(".jsQuantityIncrease").addClass("disabled");
    //     }
    // }),

    // $(document).on("click",".jsQuantityIncrease",function () {
    //     var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    //     quantity = quantity * 1;
    //     var newQuantity = quantity + 1;
    //     var maxQty = $(this).attr("max");
    //     // alert(maxQty);

    //     $(this).parent().find('input[name="count-quat1"]').val(newQuantity);

    //     if (newQuantity >= maxQty) {
    //         // $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    //         $(this).parent().find(".jsQuantityIncrease").addClass("disabled");
    //     }
    //     else if (newQuantity < maxQty) {
    //         $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    //         $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");
    //     }

    //     else{
    //         $(this).parent().find(".jsQuantityDecrease").addClass("disabled");
    //         $(this).parent().find(".jsQuantityIncrease").removeClass("disabled");

    //     }
    // })

    // change
    // $(document).on("click",".jsQuantityIncrease",function () {
    //     var quantity = $(this).parent().find('input[name="count-quat1"]').val();
    //     console.log($(".jsQuantityIncrease").attr("max"));
    //     quantity = quantity * 1;
    //     var newQuantity = quantity + 1;
    //     $(this).parent().find('input[name="count-quat1"]').val(newQuantity);
    //     console.log(' quantity :::'+newQuantity);

    //     if (newQuantity >=$(".jsQuantityIncrease").attr("max")) {
    //         $(this).parent().find(".jsQuantityDecrease").removeClass("disabled");
    //     } else{
    //          $(this).parent().find(".jsQuantityIncrease").addClass("disabled");
    //     }
    // })



