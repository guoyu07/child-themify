/* jshint node:true */
module.exports = (function () {
	var PACKAGE = require('grunt').file.readJSON('package.json');
	return {
		options: {
			defaultFaq: 'None yet.\n\n'
		},
		plugin : {
			displayName   : 'Child Themify',
			contributors  : ['JohnPBloch'],
			tags          : PACKAGE.keywords,
			minimumVersion: '3.4.2',
			testedUpTo    : '3.8',
			stableTag     : '<%=pkg.version%>',
			blurb         : 'Create child themes at the click of a button.',
			sections      : {
				description : '<%= pkg.description %>',
				installation: [
					'Upload the `child-themify` directory and its contents to the `/wp-content/plugins/` directory (or your custom location if you manually changed the location).',
					'Activate the plugin through the \'Plugins\' menu in WordPress',
					'You can now create a child theme of any non-child theme you have installed by going to the themes page and clicking "Create a child theme" from the actions links of the theme of your choice.'
				],
				screenshots : [
					'Network administration area',
					'Single site administration area'
				],
				changelog   : [
					{
						version       : '1.0.2',
						releaseMessage: 'This version fixes the plugin in WordPress 3.8',
						releaseDate   : '2014-01-13',
						changes       : ['Added support for WP 3.8']
					},
					{
						version       : '1.0.1',
						releaseMessage: 'This version fixes a bug that will prevent some users\' css from taking effect in new child themes.',
						releaseDate   : '2013-01-18',
						changes       : ['Add a semicolon to the end of the @import line in the stylesheet. Props to Luis Alejandre (wpthemedetector.com) for finding and solving.']
					},
					{
						version    : '1.0',
						releaseDate: '2012-12-31',
						changes    : ['Initial Release']
					}
				],
				upgrade     : 'This version fixes the plugin in WordPress 3.8'
			}
		}
	};
}());