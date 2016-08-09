var app = app || {};

app.OrderCtrl = (function($, root){

	function OrderCtrl(){
		this.el = $("#content");
		this.initialize.apply(this, arguments);
	}
	OrderCtrl.prototype = {
		form: null,
		responseHolder: null,
		formData: {},
		orderService: {},
		initialize: initialize,
		_events: _events,
		handleForm: handleForm,
		handleSuccess: handleSuccess,
		handleFail: handleFail,
		handleClose: handleClose,
		setMessage: setMessage
	}

	function initialize(){
		this.orderService = new app.OrderService();
		this.form = $("#order-form");
		this.responseHolder = $("#response");
		
		this.form.validate();
		this._events();
	}
	function _events(){
		this.form.on("submit", $.proxy(this.handleForm, this));
		$(root).on({
			"order.success": $.proxy(this.handleSuccess, this),
			"order.fail": $.proxy(this.handleFail, this)
		});
		this.responseHolder.on("click", $.proxy(this.handleClose, this));
	}
	function handleForm(e){
		e.preventDefault();
	
		if(!this.form.valid()) return;
		this.formData = this.form.serializeArray();
		this.el.addClass("active");
		this.orderService.request(this.formData);
	}
	function handleSuccess(e){
		this.el.removeClass("active");
		this.form[0].reset();

		this.setMessage();
	}
	function handleFail(e){
		this.el.removeClass("active");
		this.setMessage();
	}
	function handleClose(e){
		if($(e.target).closest(".inner").length <= 0 || $(e.target).hasClass("close-message")){
			this.responseHolder.removeClass("active");
		}
	}
	function setMessage(){
		this.responseHolder.html('\
			<div class="inner">\
				<p>'+ this.orderService.response.message +'</p>\
				<span class="icon icon-close close-message"></span>\
			</div>\
		');

		if(this.orderService.response.invoice){
			this.responseHolder.find(".inner").append('<div class="link-button"><a href="'+ this.orderService.response.invoice +'">Посмотреть счет</a></div>');
		}
		this.responseHolder.addClass("active");
	}

	return OrderCtrl;

})(jQuery, window);