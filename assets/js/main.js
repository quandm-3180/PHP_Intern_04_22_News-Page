window.addEventListener("DOMContentLoaded", function () {

    function header() {
        var header = document.querySelector(".header");
        window.addEventListener("scroll", function () {
            var y = window.scrollY;
            if (y > 100) {
                header.classList.add("active");
            } else {
                header.classList.remove("active");
            }
        });
    }

    function nav() {
        var nav_bar = document.getElementsByClassName("navbar");
        var nav_menu = document.getElementsByClassName("nav-menu");
        var close = document.getElementsByClassName("close");
        var check = "check1";
        nav_bar[0].addEventListener("click", function () {
            nav_menu[0].classList.add("active");
            nav_bar[0].classList.add("active");
        });
        close[0].addEventListener("click", function () {
            nav_menu[0].classList.remove("active");
            nav_bar[0].classList.remove("active");
        });
    }

    $(document).ready(function(){
        $(".filter-button").click(function(){
            var btn = $(".filter-button")
           
            var value = $(this).attr('data-filter');  
            // $(this).addClass(".active")
            if(value == "all")
            {   
                $('.filter').show('1000');
            }
            else
            {
                $(".filter").not('.'+value).hide('3000');
                $('.filter').filter('.'+value).show('3000');         
            }
        });
    
    });

    function btn(){
        var btn = document.querySelectorAll(".btn");
        btn.forEach(function(item, idx, arr){
            item.addEventListener("click",function(){
                for( var i = 0; i < btn.length; i++){
                    btn[i].classList.remove("active")
                }
                item.classList.add("active")
            })
        })
    
    }
    

    new WOW().init();

    $("#thumbnail-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });

    $("#testimonial-carousel.style-01").owlCarousel({
        dots: true,
        loop: true,
        margin: 30,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 2,
            },
        },
    });

    $('#testimonial-carousel.style-02').owlCarousel({
        autoplay: true,
        dots: false,
        loop:true,
        margin:30,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:2
            }
        }
    })

    $("#team-carousel").owlCarousel({
        // autoplay: true,
        dots: false,
        loop: true,
        margin: 30,
        nav: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            800: {
                items:2,
            },
            1000: {
                items: 4,
            },
            1024 : {
                items:4,
            }
        },
    });

    $("#blog-carousel").owlCarousel({
        autoplay: true,
        dots: false,
        loop: true,
        margin: 30,
        nav: false,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 1,
            },
        },
    });

    header();
    nav();
    btn();
    
    var slide = document.querySelectorAll(".slide");
    var title = document.querySelectorAll(".nav-title>.title");
    slide[0].classList.add("active");
    title[0].classList.add("active");
    function slider() {
        // Click Change Slide
        title.forEach(function (item, idx, arr) {
            var index = idx;
            item.addEventListener("click", function () {
                for (var i = 0; i < title.length; i++) {
                    title[i].className = "title";
                    slide[i].className = "slide";
                }
                item.classList.add("active");
                slide[index].classList.add("active");
                clearTime();
            });
        });

        // Auto Slide
        function autoSlider() {
            var active_slide = document.querySelector(".active.slide");
            var active_title = document.querySelector(".active.title");
            for (var i = 0; i < title.length; i++) {
                title[i].className = "title";
                slide[i].className = "slide";
            }

            if (active_slide.nextElementSibling == null) {
                slide[0].classList.add("active");
                title[0].classList.add("active");
            } else {
                active_slide.nextElementSibling.className = "slide active";
                active_title.nextElementSibling.className = "title active";
            }
        }
        var setTime = setInterval(autoSlider, 8000);

        // Next Slide
        var next = document.querySelector(".next");
        var prev = document.querySelector(".prev");
        next.addEventListener("click", function () {
            var active_slide = document.querySelector(".active.slide");
            var active_title = document.querySelector(".active.title");
            if (active_slide.nextElementSibling != null) {
                for (var i = 0; i < title.length; i++) {
                    title[i].className = "title";
                    slide[i].className = "slide";
                }
                active_slide.nextElementSibling.className = "slide active";
                active_title.nextElementSibling.className = "title active";
            }
            clearTime();
        });

        prev.addEventListener("click", function () {
            var active_slide = document.querySelector(".active.slide");
            var active_title = document.querySelector(".active.title");
            if (active_slide.previousElementSibling != null) {
                for (var i = 0; i < title.length; i++) {
                    title[i].className = "title";
                    slide[i].className = "slide";
                }
                active_slide.previousElementSibling.className = "slide active";
                active_title.previousElementSibling.className = "title active";
            }
            clearTime();
        });

        // ClearTime
        function clearTime() {
            clearInterval(setTime);
            setTime = setInterval(autoSlider, 8000);
        }
    }

    slider();


});
