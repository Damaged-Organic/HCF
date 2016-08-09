var app = app || {};


$(function(){

	$("#countdown").countdown({
		onTimeUpdate: function(el, d, h, m, s){},
		onTimeEnd: function(el){
			el.remove();
		},
		onCreate: function(el){
			el.find(".days").append("<p>дни</p>");
			el.find(".hours").append("<p>часы</p>");
			el.find(".minutes").append("<p>минуты</p>");
			el.find(".seconds").append("<p>секунды</p>");
		}
	});
	$(".carousel-holder").carousel();

	new app.HeaderCtrl();
});