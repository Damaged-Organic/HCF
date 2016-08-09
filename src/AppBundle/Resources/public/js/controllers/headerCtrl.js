var app = app || {};

app.HeaderCtrl = (function($, root){

	function HeaderCtrl(){
		this.el = $("#header");
		this.initialize.apply(this, arguments);
	}
	HeaderCtrl.prototype = {
		initialize: initialize,
		_events: _events,
		handleScroll: handleScroll
	}

	function initialize(){
		this._events();
	}
	function _events(){
		$(root).on("scroll", $.proxy(this.handleScroll, this));
	}
	function handleScroll(e){
		var yPos = $(root).scrollTop();

		yPos >= root.innerHeight ? this.el.addClass("full") : this.el.removeClass("full");
	}

	return HeaderCtrl;

})(jQuery, window);