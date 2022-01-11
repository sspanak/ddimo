'use strict';
module.exports = function(api) {
	api.cache(false);

	const presets = [[
		'@babel/preset-env', {
			'targets': {
				'android': '4.4',
				'ie': '10',
				'ios': '7'
			}
		}
	]];
	return {
		plugins: [],
		presets
	};
};
