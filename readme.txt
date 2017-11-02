=== WP AutoLoader ===
Contributors: awoods
Tags: dev, developer, tool, tools, oop, object oriented programming, must use, mu-plugin
Requires PHP: 5.5
Requires at least: 4.8.2
Tested up to: 4.8.2
Stable tag: 0.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A developer library to bring PHP Class autoloading to WordPress

== Description ==

A PHP Class Namespace auto loader helps modernize your code. PHP developers
outside the WordPress community use autoloading to make it easier to manage
their code. Since WordPress doesn't yet have an autoloader in core, this is one
that plugin and theme authors can use for their projects.

Simply put, it removes the need to add require or include statements for each
PHP class you want to use in your plugin.

This plugin assumes expects you to follow a couple of rules

1. Your directory structure follows/matches your PHP Namespace structure

1. Your code follow the WordPress coding standard

    * Directories and filenames are lowercase, with words separated by hyphens
    * Class files are prefixed with 'class-', e.g. class-autoloader.php for a
      class named 'Autoload'

1. Your code follows these supplemental conventions that parallel classes

    * Interface files are prefixed with 'interface-', e.g. interface-autoloader.php
      for an interface named 'Autoload'
    * Trait files are prefixed with 'trait-', e.g. trait-autoloader.php for a
      trait named 'Autoload'


== Installation ==

**This is a must use plugin!** So it'll always be active, and load before any
plugins you installed in your wp-content/plugins directory.

There are 2 ways to install this plugin - through the dashboard, or with WP CLI.
Once installed, you'll need to register the autoloader for your plugin.

= Via Dashboard =

1. Go to https://github.com/andrewwoods/wpal/archive/master.zip
1. Go to the `Plugins` in your admin area
1. Click the `Add New` button
1. Click the `Upload` button
1. Click the `Browse...` button
1. Click the `Install Now` button
1. Open your terminal application
1. Go to the `wp-content/plugins/wpal` directory
1. Type `./mu-install.bash`

= Via WP-CLI =

1. Open your terminal application
1. Change directory to your WordPress website
1. Type `wp plugin install https://github.com/andrewwoods/wpal/archive/master.zip`
1. Go to your `wp-content/plugins/wpal` directory
1. Type `./mu-install.bash`

= In your plugin =

    // substitute "prefix" with your plugin's prefix
    function prefix_autoload($class) {
        $plugin_dir = plugin_dir_path( __FILE__ );
        $src_dir = $plugin_dir . 'src';

        \WPAL\Autoloader::autoload_class( $class, $src_dir );
    }

    spl_autoload_register( 'prefix_autoload' );

== Frequently Asked Questions ==

= What is a must use plugin? =

It's a special type of plugin that can't be disabled. It is always enabled
until it's uninstalled. This prevents users from accidentally breaking their
site. One of the benefits if must-use plugins, is they are loaded before all
normal plugins. This is a perfect scenario an autoloader



= Why isn't this plugin in the wordpress.org repository? =

Basically, it does not fit within the wordpress.org requirements for plugins.
They classify it as a library, which they don't allow.

"In short, if your plugin has to require other plugins or themes to edit
themselves in order to use your plugin, it's a library."

Can't argue with that. The downside though, is that it makes it harder for
other developers to use this plugin. Sad panda.


= Why are there no screenshots? =

Because it's a developer tool. It has no visual interface.
there's just a code example that you need to implement in your plugin.

== Changelog ==

= 0.2.0 =

* Add support for loading Interfaces and Traits
* Update Installation instructions since this plugin was rejected by wordpress.org

= 0.1.0 =

* Initial version

