//JQuery Mobile
$.mobile.autoInitializePage = false

// jQuery to collapse the navbar on scroll
function collapseNavbar() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
}

$(window).scroll(collapseNavbar);
$(document).ready(collapseNavbar);


// Sidecollapse navbar
var sideslider = $('[data-toggle=collapse-side]');
var sel = sideslider.attr('data-target');
var cont = sideslider.attr('data-container');
sideslider.click(function(event){
    $(sel).toggleClass('in');
    $(cont).toggleClass('in');
    $(sideslider).toggleClass('toggled');
});
$(cont).click(function(event){
    if($(this).hasClass('in')){
        $(sel).toggleClass('in');
        $(cont).toggleClass('in');
        $(sideslider).toggleClass('toggled');
        event.stopPropagation();
    }

});
$(window).on("swiperight",function(){
    if($(cont).hasClass('in')){
        $(sel).toggleClass('in');
        $(cont).toggleClass('in');
        $(sideslider).toggleClass('toggled');
        event.stopPropagation();
    }
});
$(window).on("swipeleft",function(){
    if(!($(cont).hasClass('in'))){
        $(sel).toggleClass('in');
        $(cont).toggleClass('in');
        $(sideslider).toggleClass('toggled');
        event.stopPropagation();
    }
});



// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = '#'+$(this).attr('href').split('#')[1];
       
        if($($anchor).length>0){
            $('html, body').stop().animate({
                scrollTop: $($anchor).offset().top
            }, 800, 'easeInOutExpo',function(){
   
                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = $anchor;
            });
            event.preventDefault();
        }
        
            
    });
    
});
$(document).ready(function() { 
    var $anchor = $('#' + window.location.hash.replace('#', ''));
    if($($anchor).length>0) {
        $('html, body').stop().animate({
            scrollTop: $($anchor).offset().top
        }, 800, 'easeInOutExpo');
        event.preventDefault();
    }
});;

// Handle scroll
$(document).on("scroll",function(event){
        var scrollPos = $(document).scrollTop();
        $('.navbar a.page-scroll').each(function () {
            var currLink = $(this);
            var refElement = $('#'+currLink.attr("href").split('#')[1]);
            if($(refElement).length>0){
                if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                    $('.navbar a.page-scroll').removeClass("active");
                    currLink.addClass("active");

                }
            }
            
        });
    }
);































// Google Maps Scripts
var map = null;
// When the window has finished loading create our google map below
google.maps.event.addDomListener(window, 'load', init);
google.maps.event.addDomListener(window, 'resize', function() {
    map.setCenter(new google.maps.LatLng(global.info.gps.lat, global.info.gps.lng));
});

function init() {
    // Basic options for a simple Google Map
    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var mapOptions = {
        // How zoomed in you want the map to start at (always required)
        zoom: 15,

        // The latitude and longitude to center the map (always required)
        center: new google.maps.LatLng(global.info.gps.lat, global.info.gps.lng), // New York

        // Disables the default Google Maps UI components
        scrollwheel: false,
        draggable: false,

        // How you would like to style the map. 
        // This is where you would paste any style found on Snazzy Maps.
      
    };

    // Get the HTML DOM element that will contain your map 
    // We are using a div with id="map" seen below in the <body>
    var mapElement = document.getElementById('map');

    // Create the Google Map using out element and options defined above
    map = new google.maps.Map(mapElement, mapOptions);

    // Custom Map Marker Icon - Customize the map-marker.png file to customize your icon
    var image = 'assets/img/map-marker.png';
    var myLatLng = new google.maps.LatLng(global.info.gps.lat, global.info.gps.lng);
    var beachMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
    });
}
