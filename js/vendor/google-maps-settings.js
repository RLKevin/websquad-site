// style with https://mapstyle.withgoogle.com/

(function ($) {
	function render_map($el) {
		var $markers = $el.find(".marker");
		var sw = Math.max(
			document.documentElement.clientWidth,
			window.innerWidth || 0
		);
		var isDraggable = sw < 800 ? false : true;
		var args = {
			zoom: 12,
			center: new google.maps.LatLng(0, 0),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: false,
			disableDefaultUI: true, // a way to quickly hide all controls
			scaleControl: false,
			zoomControl: false,
			draggable: isDraggable,
			styles: [
				{
					elementType: "geometry",
					stylers: [
						{
							color: "#f5f5f5",
						},
					],
				},
				{
					elementType: "labels.icon",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#616161",
						},
					],
				},
				{
					elementType: "labels.text.stroke",
					stylers: [
						{
							color: "#f5f5f5",
						},
					],
				},
				{
					featureType: "administrative.land_parcel",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "administrative.land_parcel",
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#bdbdbd",
						},
					],
				},
				{
					featureType: "poi",
					elementType: "geometry",
					stylers: [
						{
							color: "#eeeeee",
						},
					],
				},
				{
					featureType: "poi",
					elementType: "labels.text",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "poi",
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#757575",
						},
					],
				},
				{
					featureType: "poi.business",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "poi.park",
					elementType: "geometry",
					stylers: [
						{
							color: "#e5e5e5",
						},
					],
				},
				{
					featureType: "poi.park",
					elementType: "labels.text",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "poi.park",
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#9e9e9e",
						},
					],
				},
				{
					featureType: "road",
					elementType: "geometry",
					stylers: [
						{
							color: "#ffffff",
						},
					],
				},
				{
					featureType: "road.arterial",
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#757575",
						},
					],
				},
				{
					featureType: "road.highway",
					elementType: "geometry",
					stylers: [
						{
							color: "#dadada",
						},
					],
				},
				{
					featureType: "road.highway",
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#616161",
						},
					],
				},
				{
					featureType: "road.local",
					elementType: "labels",
					stylers: [
						{
							visibility: "off",
						},
					],
				},
				{
					featureType: "road.local",
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#9e9e9e",
						},
					],
				},
				{
					featureType: "transit.line",
					elementType: "geometry",
					stylers: [
						{
							color: "#e5e5e5",
						},
					],
				},
				{
					featureType: "transit.station",
					elementType: "geometry",
					stylers: [
						{
							color: "#eeeeee",
						},
					],
				},
				{
					featureType: "water",
					elementType: "geometry",
					stylers: [
						{
							color: "#c9c9c9",
						},
					],
				},
				{
					featureType: "water",
					elementType: "labels.text.fill",
					stylers: [
						{
							color: "#9e9e9e",
						},
					],
				},
			],
		};
		var map = new google.maps.Map($el[0], args);
		var mobilePan = sw < 800 ? -100 : -200;
		map.markers = [];
		$markers.each(function () {
			add_marker($(this), map);
		});
		center_map(map);
		map.panBy(mobilePan, 40);
	}

	function add_marker($marker, map) {
		var latlng = new google.maps.LatLng(
			$marker.attr("data-lat"),
			$marker.attr("data-lng")
		);
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			icon: template + "/img/icons/marker.svg",
		});
		map.markers.push(marker);
		if ($marker.html()) {
			var infowindow = new google.maps.InfoWindow({
				content: $marker.html(),
			});
			google.maps.event.addListener(marker, "click", function () {
				infowindow.open(map, marker);
			});
		}
	}
	function center_map(map) {
		var bounds = new google.maps.LatLngBounds();
		$.each(map.markers, function (i, marker) {
			var latlng = new google.maps.LatLng(
				marker.position.lat(),
				marker.position.lng()
			);
			bounds.extend(latlng);
		});
		if (map.markers.length == 1) {
			map.setCenter(bounds.getCenter());
			// Deze zoom!
			// map.setZoom( 20 );
		} else {
			map.fitBounds(bounds);
		}
	}
	$(document).ready(function () {
		$(".map__map").each(function () {
			render_map($(this));
		});
	});
})(jQuery);
