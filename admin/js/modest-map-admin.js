(function() {
	'use strict';

	function ConfigMap() {

		const self = this;

	    this.register_alpine_data = function (data) {
	    	self.alpine_data = data;
	    };

	    this.setup = function () {
	    	var latlng = [0.0, 0.0];
	    	var zoom = 1;
	    	if (self.alpine_data) {
	    		latlng = [self.alpine_data.lat, self.alpine_data.lng];
	    		zoom = self.alpine_data.zoom;
	    	}

			var map = L.map('map').setView(latlng, zoom);

			L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
			    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
			}).addTo(map);

			var popup = L.popup({closeButton: false, content: 'Drag Me!'});

			var marker = L.marker(latlng, {draggable:'true'}).addTo(map)
			    .bindPopup(popup)
			    .openPopup();

	      	map.on('zoomend', function () {
	      		self.alpine_data.zoom = map.getZoom();
		    });

		    marker.on('move', function (event) {
	      		self.alpine_data.lat = event.latlng.lat;
	      		self.alpine_data.lng = event.latlng.lng;
		    });
		};
	}

  window.WPModestMapPlugin = new ConfigMap();

  // onload waits for Leaflet to load
  if (window.addEventListener) {
    window.addEventListener('load', window.WPModestMapPlugin.setup, false);
  } else if (window.attachEvent) {
    window.attachEvent('onload', window.WPModestMapPlugin.setup);
  }

})();
