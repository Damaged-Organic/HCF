var app = app || {};

$(function(){

	$("#user-phone").mask("+380 (00) 000-00-00");
	new app.OrderCtrl();
});