$(function () {
    $('.tap-target').tapTarget();
    $('.parallax').parallax();
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.materialboxed').materialbox();
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });
    $('.dropdown-trigger').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: true,
        hover: true,
        coverTrigger: false
    });
});
