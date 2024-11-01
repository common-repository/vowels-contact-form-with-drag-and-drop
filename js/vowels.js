(function (d, w) {
	var c = d.className;
	d.className = c + (c && ' ') + 'vowels-js';
	w.vowelsforminc = {
		preloadedImages: [],
		preload: function (images, prefix) {
			for (var i = 0; i < images.length; i++) {
				var elem = document.createElement('img');
				elem.src = prefix ? prefix + images[i] : images[i];
				w.vowelsforminc.preloadedImages.push(elem);
			}
		},
		instance: null,
		logic: {}
	};
})(document.documentElement, window);
