<?php
/*
Plugin Name: Breadcrumb NavXT Paged Title Extensions
Plugin URI: http://mtekk.us/code/breadcrumb-navxt/
Description: Replaces the paged breadcrumb with a custom title. For details on how to use this plugin visit <a href="http://mtekk.us/code/breadcrumb-navxt/">Breadcrumb NavXT</a>. 
Version: 1.0.0
Author: John Havlik
Author URI: http://mtekk.us/
*/
/*  Copyright 2011  John Havlik  (email : mtekkmonkey@gmail.com)

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
//Add in our action hook to run after the trail has been filled
add_action('bcn_after_fill', 'bcnext_cust_paged');
/**
 * We're going to pop off the paged breadcrumb and add in our own thing 
 *
 * @param object $trail the breadcrumb_trail object after it has been filled
 */
function bcnext_cust_paged($trail)
{
	//Only run whe on a single page/post/CPT
	if(is_singular())
	{
		//Check to see if it is a paged type
		if(in_array('paged', $trail->trail[0]->type))
		{
			//Let's change the title
			$trail->trail[0]->set_title(bcnext_cust_title($trail->trail[0]->get_title()));
		}
	}
}
/**
 * Returns the custom paged title
 */
function bcnext_cust_title($current_title)
{
	global $page, $post;
	$pages = explode('<!--nextpage-->', $post->post_content);
	$title = $current_title;
	$part_content = $pages[$page-1];
	$has_part_title = strpos($part_content, '<!--pagetitle:');
	if(0 === $has_part_title)
	{
		$end = strpos($part_content, '-->');
		$title = trim(str_replace('<!--pagetitle:', '', substr($part_content, 0, $end)));
	}
	$title = isset($title) && (strlen($title) > 0) ? $title : 'First';
	return $title;
}