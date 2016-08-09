var app = app || {};

app.OrderService = (function($, root){

	function OrderService(){
		this.initialize.apply(this, arguments);
	}
	OrderService.prototype = {
		response: {},
		initialize: initialize,
		request: request
	}

	function initialize(){}
	function request(data){
		var self = this;

		$.ajax({
			url: "/order_send",
			type: "POST",
			data: data
		})
		.done(function(response){
			self.response = response;

			$(root).trigger("order.success");
		})
		.fail(function(error){
			self.response = JSON.parse(error.responseText);

			$(root).trigger("order.fail");
		});
	}

	return OrderService;

})(jQuery, window);