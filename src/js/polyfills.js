if (!Object.values) {
	Object.values = function(obj) {
		return Object.keys(obj).map(function(k) { return obj[k]; });
	};
}

if (!Math.log2) {
	Math.log2 = function(n) { return Math.LOG2E * Math.log(n); };
}

/**
 * Number.isNaN polyfil
 * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/isNaN
 */
Number.isNaN = Number.isNaN || function isNaN(input) {
	return typeof input === 'number' && input !== input; // eslint-disable-line no-self-compare
};

/**
 * Number.parseInt
 * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/parseInt
 */
if (Number.parseInt === undefined) {
	Number.parseInt = window.parseInt;
}

/**
 * Number.parseFloat
 * https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Number/parseFloat
 */
if (Number.parseFloat === undefined) {
	Number.parseFloat = parseFloat;
}
