'use strict';
module.exports = function(api) {
	api.cache(false);

	const presets = [[
		'@babel/preset-env', {
			targets: {
				firefox: '48',
				ie: '10',
				opera: '12'
			}
		}
	]];
	return {
		plugins: [],
		presets
	};
};
