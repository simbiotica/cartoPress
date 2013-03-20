=== CartoPress - CartoDB integration for WordPress ===
Contributors: tiagojsag, simbiotica
Tags: catodb
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 1.0.0
License: GPLv2 or later

CartoPress integrates CartoDB into WordPress.

== Description ==

This pluggins provides VERY BASIC (for now) integration with CartoDB for WordPress.
Right now only public tables are supported, and a limited number of parameters
can be configured in order to render maps in your visualizations.
This plugin is under active development, and any suggestions are welcome,
although I can't make any promises on timetables.

== Installation ==

Just install like any other WordPress plugin

== Configuration ==

A "CartoPress" configuration page is provided for admins, under "Settings".
Currently it just accepts your CartoDB username.

== Usage ==

Maps can be renderes in your posts using Shortcode, like so:

[cartodb table="your-table" zoom="4" filter="lon > '-3' " x="40" y="20" width="100px" height="200px"]

These are all the options available at the moment, and they are quite self-explanatory.

== Changelog ==

0.1.0 - Initial version
