# boiler-theme
This is Yosuke's Wordpress boiler template. Its got some handy functions that
I use often and a scss/coffeescript hierarchy that links well with a gulpfile
that I've generated in one of my gists https://gist.github.com/yosukehasumi/d21f3ed89171ea5fc234

Also if you are on Mac I've got a handy bash script that can create a new WP
site for you from scratch, see my gist here: https://gist.github.com/yosukehasumi/d0c905da78229122e7c1bb34a0fc92a7

## What You'll Need
- [GIT](https://git-scm.com/)
- [NodeJS](https://nodejs.org/en/)

## Tools Used Here
- [GULP](http://gulpjs.com/)
- [SASS/SCSS](http://sass-lang.com/)
- [CoffeeScript](http://coffeescript.org/)
- [Zurb Foundation 6](http://foundation.zurb.com/sites/docs/)
- [Advanced Custom Fields](https://www.advancedcustomfields.com/resources/)

### ./includes/

Here lies additional functions, filters and configuration files.

### ./includes/fields/

ACF field groups are exported as PHP code and entered in separate files here
to be included in the main `functions.php` file.

### ./includes/import/

ACF field groups are also exported as JSON to allow collaborating developers
to import the currect set of fields into the ACF GUI.

### ./includes/views/

ACF field groups that need their own helper functions for displaying their content
get their own respective files here.

### ./js/

This folder holds the compiled JS library and compiled custom JS.

### ./js/library/

This is where we add third-party JS libraries we wish to include in our project.

### ./js/coffee/

This folder contains the custom site CoffeeScript which is compiled into the `site.js`
file in the parent folder.

### ./js/foundation-js/

Here we have the Zurb Foundation framework JS plugins. The plugins are separated into
`enabled` and `disabled`. Only plugins in the `enabled` folder are compiled and loaded
in the theme. When enabling a plugin look at the plugin file to see if it depends on
any `foundation.util.*.js` plugins and enable / disable those as needed.

### ./js/foundation-js/enabled/

Foundation JS plugins that will be compiled and used by the theme.

### ./js/foundation-js/disabled/

Foundation JS plugins that will not be compiled.

### ./scss/

Here lives the theme's SCSS stylesheets.

### ./scss/style.scss

This is the main stylesheet that gets compiled into `style.css` in the theme folder.
Please stick to using logical SCSS partials to separate and organize your stylesheets.
Update this file to include the new partials and bear in mind the order in which
the partials are compiled.

### ./scss/_settings.scss

This is the settings file used by the Zurb Foundation framework to override the
default configuration of the framework.

### ./scss/foundation-scss/

Here we have the SCSS for the Zurb Foundation framework. It is made up of multiple
partials with functions that help compile all the various features. It is
not recommended to edit these files apart from the `foundation.scss` file.

### ./scss/foundation-scss/foundation.scss

This is the file that the Zurb Foundation framework is compiled from. Here
you may choose which components you want to include. Comment out any that
you are not using to help reduce the overall size of the theme's stylesheet.
Also remember to enable/disable the related Foundation JS plugins.

