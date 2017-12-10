# boiler-theme
This is the Medium Rare Interactive Wordpress boiler theme. It provides the
basic required WordPress template structure along with some handy functions
and configuration that we use often. This is tied together with a
scss/coffeescript hierarchy compiled with GULP based upon this Gist:
https://gist.github.com/yosukehasumi/d21f3ed89171ea5fc234

## RARE.sh
If you are on Mac, Yosuke created a handy bash script that can create a new WP
site for you from scratch, see my gist here:
https://gist.github.com/yosukehasumi/d0c905da78229122e7c1bb34a0fc92a7
**_Updated_**
https://gist.github.com/nathanieltubb/43b86d3f056bf2b8148e21c7756bfece

## What You'll Need
- [GIT](https://git-scm.com/)
- [NodeJS](https://nodejs.org/en/)

## Tools Used Here
- [GULP](http://gulpjs.com/)
- [SASS/SCSS](http://sass-lang.com/)
- [CoffeeScript](http://coffeescript.org/)
- [Zurb Foundation 6\*](https://foundation.zurb.com/sites/docs)
- [Advanced Custom Fields](https://www.advancedcustomfields.com/resources/)
- [UnderscoreJS](http://underscorejs.org/)
- [Modernizr](https://modernizr.com/)
- [ImagesLoaded](https://imagesloaded.desandro.com/)
- [SlickJS](http://kenwheeler.github.io/slick/)
- [Cycle2JS](http://jquery.malsup.com/cycle2/)
- [IsotopeJS](https://isotope.metafizzy.co/)

\* _This theme currently uses Foundation v6.3.x, while the current documentation
the Foundation site is for >= 6.4.x. There may be some discrepencies between
these versions._

## Branches
There are a couple branches for flavours of this boiler theme. As theme has
matured there has been the need to also allow for some trimmed down versions.
- **master** is our current, everyday toolbox
- **foundation** is that same toolbox with the addion of the
Foundation CSS/JS framework
- **theme-core-only** has just the basic folder and template structure
- **original-build** harkens back to where it all began

### ./includes/

Here lies additional functions, filters and configuration files.

### ./includes/acf-fields/

ACF field groups are exported as PHP code and entered in separate files here
to be included in the main `functions.php` file.

### ./includes/acf-import/

ACF field groups are also exported as JSON to allow collaborating developers
to import the currect set of fields into the ACF GUI.

### ./includes/acf-views/

ACF field groups that need their own helper functions for displaying their
content get their own respective files here.

### ./js/

This folder holds the compiled JS in `site.js` and `site.min.js`. The
non-minified JS is called when the `$_ENV['MRI_ENVIRONMENT']` is set
to `development`. Otherwise the minified version is called when in production.

### ./js/library-inactive/

This is where we store third-party JS libraries we _are not_ currently using
in the project.

### ./js/required/

This folder contains JS libraries that must be compiled first, before any other
libraries or custom JS scripts.

### ./js/includes/

This is the folder where we place JS libraries we wish to include
in our project.

### ./js/coffee/

This folder contains the custom site CoffeeScript which is compiled into the
`site.js` file in the parent folder.

### ./js/foundation-js/

Here we have the Zurb Foundation framework JS plugins. The plugins are separated
into `enabled` and `disabled`. Only plugins in the `enabled` folder are compiled
and loaded in the theme. When enabling a plugin look at the plugin file to see
if it depends on any `foundation.util.*.js` plugins and enable / disable those
as needed.

### ./js/foundation-js/enabled/

Foundation JS plugins that will be compiled and used by the theme.

### ./js/foundation-js/disabled/

Foundation JS plugins that will not be compiled.

### ./scss/

Here lives the theme's SCSS stylesheets.

### ./scss/style.scss

This is the main stylesheet that gets compiled into `style.css` in the theme
folder. Please stick to using logical SCSS partials to separate and organize
your stylesheets. Update this file to include the new partials and bear in mind
the order in which the partials are compiled.

### ./scss/\_settings.scss

This is the settings file used by the Zurb Foundation framework to override the
default configuration of the framework.

### ./scss/foundation-scss/

Here we have the SCSS for the Zurb Foundation framework. It is made up of
multiple partials with functions that help compile all the various features.
It is not recommended to edit these files apart from the `foundation.scss` file.

### ./scss/foundation-scss/foundation.scss

This is the file that the Zurb Foundation framework is compiled from. Here
you may choose which components you want to include. Comment out any that
you are not using to help reduce the overall size of the theme's stylesheet.
Also remember to enable/disable the related Foundation JS plugins.

