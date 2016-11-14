$(document).on("tabsbeforeactivate", "#tabs", function (e, ui) {
    $(ui.newPanel).addClass("in slide").one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
        $(this).removeClass("in slide");
    });
	
	
	
});
/*
$( window ).ready(function() {
var fontSize = $(window).width()/75;

	$('body').css('font-size', fontSize);
});	
	$(window).resize(function() {
		var fontSize = $(window).width()/75;
		$('body').css('font-size', fontSize);
	});*/