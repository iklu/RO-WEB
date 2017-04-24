var globalDistLocation = 'dist/';
  globalAssetsLocation = 'assets/'

module.exports = {
  'dist'  : globalDistLocation,
  'assets': globalAssetsLocation,

	'js': {
		'in'  : globalAssetsLocation + 'js/',
		'out' : globalDistLocation   + 'js/'
	},

	'css': {
		'in'  : globalAssetsLocation + 'scss/',
		'out' : globalDistLocation   + 'css/'
	}
};