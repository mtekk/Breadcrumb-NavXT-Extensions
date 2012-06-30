<?php
/*
Plugin Name: Breadcrumb NavXT - WPML Extensions
Plugin URI: http://mtekk.us/code/
Description: Adds a compatibility layer for improved WPML support.
Version: 0.0.1
Author: John Havlik
Author URI: http://mtekk.us/
License: GPL2
*/
/*  Copyright 2012  John Havlik  (email : mtekkmonkey@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
//Hook into the Breadcrumb NavXT title filter, want the 4.2+ version with 2 args
add_filter('bcn_breadcrumb_title', 'bcn_ext_title_translater', 10, 2);
/**
 * This function is a filter for the bcn_breadcrumb_title filter, it runs through
 * the SitePress::the_category_name_filter function
 * 
 * @param string $title The title to be filtered (translated)
 * @param array $context The breadcrumb type array
 * @return string The string filtered through SitePress::the_category_name_filter
 */
function bcn_ext_title_translater($title, $context)
{
	//Need to make sure we have a taxonomy and that the SitePress object is available
	if(is_array($context) && isset($context[0]) && taxonomy_exists($context[0]) && class_exists('SitePress'))
	{
		//This may be a little dangerous due to the internal recursive calls for the function
		$title = SitePress::the_category_name_filter($title);
	}
	return $title;
}