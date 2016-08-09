(function($, root){

	var pluginName = "carousel",
		defaults = {
			itemVisible: 3
		};

	function Plugin(el, options){
		this.el = $(el);

		this._options = $.extend(defaults, options);
		this._defaults = defaults;
		this._pluginName = pluginName;		
		
		this.initialize.apply(this, arguments);
	}
	Plugin.prototype = {
		carousel: [],
		items: [],
		itemsCount: 0,
		itemWidth: 0,
		currentItem: 0,
		initialize: initialize,
		_events: _events,
		handleArrow: handleArrow,
		setStyles: setStyles,
		checkRange: checkRange,
		changeItem: changeItem
	}

	function initialize(){
		this._events();

		this.carousel = this.el.find(".carousel");
		this.items = this.el.find(".carousel-item");
		this.itemsCount = this.items.length;

		this.setStyles();
	}
	function _events(){
		this.el.on("click", ".arrow", $.proxy(this.handleArrow, this));
		$(root).on("resize", $.proxy(this.setStyles, this));
	}
	function handleArrow(e){
		e.preventDefault();
		var target = $(e.target).closest(".arrow");

		target.hasClass("left") ? this.currentItem-- : this.currentItem++;
		this.checkRange();
		this.changeItem();
	}
	function setStyles(){
		this.itemWidth = this.el.width() / this._options.itemVisible;

		this.items.css({ width: this.itemWidth });
		this.carousel.css({ width: this.itemWidth * this.itemsCount });
	}
	function checkRange(){
		if(this.currentItem >= this.itemsCount - this._options.itemVisible){
			this.currentItem = this.itemsCount - this._options.itemVisible;
		} else if(this.currentItem <= 0){
			this.currentItem = 0;
		}
	}
	function changeItem(){
		var transform = getVendor("transform");

		this.carousel.css({
			transform: "translateX("+ this.currentItem * this.itemWidth * -1 +"px)"
		});
	}

	$.fn[pluginName] = function(options){
		return this.each(function(){
			if(!$.data(this, "plugin_" + pluginName)){
				$.data(this, "plugin_" + pluginName, new Plugin(this, options));
			}
		});
	}

	function getVendor(property){
		var style = document.createElement("div").style,
			vendors = ["ms", "O", "Moz", "Webkit"], i;

		if(style[property] == "") return property;

		property = property.charAt(0).toUpperCase() + property.slice(1);
		for(i = 0; i < vendors.length; i++){
			if(style[vendors[i] + property] == "") return vendors[i] + property;
		}
	}

})(jQuery, window);