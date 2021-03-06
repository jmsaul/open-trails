app.constant("SEGMENT_ENDPOINT", "../../php/api/segment/");
app.service("SegmentService", function($http, SEGMENT_ENDPOINT) {
	this.point = [];

	function getUrl() {
		return(SEGMENT_ENDPOINT);
	}

	function getUrlForId(segmentId) {
		return(getUrl() + segmentId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetchId = function(segmentId) {
		return($http.get(getUrlForId(segmentId)));
	};

	this.fetchSegmentStart = function(segmentStart) {
		return($http.getUrl() + '?SegmentStart=' + segmentStart);
	};

	this.fetchSegmentStop = function(segmentStop) {
		return($http.getUrl() + '?segmentStop=' + segmentStop);
	};

	this.fetchElevationX = function(segmentStartElevation) {
		return($http.getUrl() + '?elevationX=' + segmentStartElevation);
	};

	this.fetchElevationY = function(segmentStopElevation) {
		return($http.getUrl() + '?elevationY=' + segmentStopElevation);
	};

	this.create = function(segments) {
		return ($http.post(getUrl(), segments));
	};

	this.update = function(segmentId, segment) {
		return($http.put(getUrlForId(segmentId), segment));
	};

	this.destroy = function(segmentId) {
		return($http.delete(getUrlForId(segmentId)));
	};

	this.setPoint = function(point) {
		this.point = point;
	};

	this.fetchPoint = function() {
		return(this.point);
	};
});

