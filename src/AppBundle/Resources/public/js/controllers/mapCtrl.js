var app = app || {};

app.MapCtrl = (function($, root){

	"use strict";

	function MapCtrl(){
		this.el = $("#map");
		this.initialize.apply(this, arguments);
	}
	MapCtrl.prototype = {
		map: {},
		marker: {},
		_coords: {},
		initialize: initialize,
		setupMap: setupMap,
		styleMap: styleMap,
		setupMarker: setupMarker
	}

	function initialize(){
		this._coords = new google.maps.LatLng(50.4600451, 30.5231005);
		this.setupMap();
		this.setupMarker();
	}
	function setupMap(){
		var mapOptions = {
			zoom: 16,
			disableDoubleClickZoom: false,
			panControl: false,
			scaleControl: false,
			streetViewControl: false,
			zoomControl: false,
			mapTypeControl: false,
			center: this._coords
		};
		this.map = new google.maps.Map(this.el[0], mapOptions);
		this.styleMap();
	}
	function styleMap(){
		var styles = [
			{
				featureType: "all",
				elementType: "all",
				stylers: [
					{ hue: "#004876" },
					{ saturation: 0 },
					{ gamma: 1.25 }
				]
			}
		];
		this.map.setOptions({styles: styles})
	}
	function setupMarker(){
		var icon = {
			url: "/bundles/app/images/pin.png",
			size: new google.maps.Size(30, 30)
		};

		this.marker = new google.maps.Marker({
			position: this._coords,
			animation: google.maps.Animation.DROP,
			icon: icon
		});
		this.marker.setMap(this.map);
	}

	return MapCtrl;

})(jQuery, window);
