$(document).ready(function(){
    $('#menu').slicknav({
        label: '',
        closedSymbol: '<i class="fa-solid fa-chevron-right"></i>',
        openedSymbol: '<i class="fa-solid fa-chevron-down"></i>',
        duration: 400,
    });
});


$(document).ready(function (){
    var currentDomain = window.location.origin
    $('.slicknav_menu').prepend('<a href="/"><img class="logo-mobile" src="' + currentDomain + '/themes/images/vlute_icon36.png" alt="Website Logo" /></a>');
    $('.slicknav_btn').empty();
    $('.slicknav_btn').prepend('<svg style="width: 1.4em; height: 1.4em; vertical-align: -.125em; fill: #FFFFFF; margin-top: 7px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>');
})




