<?php
/*
Plugin Name: Breadcrumb NavXT Remove Current Item Extension
Plugin URI: http://mtekk.us/code/breadcrumb-navxt/
Description: Removes the current item from the breadcrumb trail. For details on how to use this plugin visit <a href="http://mtekk.us/code/breadcrumb-navxt/">Breadcrumb NavXT</a>. 
Version: 1.1.0
Author: John Havlik
Author URI: http://mtekk.us/
*/
/*  Copyright 2012-2014  John Havlik  (email : john.havlik@mtekk.us)

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
add_action('bcn_after_fill', 'bcnext_remove_current_item');
/**
 * We're going to pop off the paged breadcrumb and add in our own thing 
 *
 * @param bcn_breadcrumb_trail $trail the breadcrumb_trail object after it has been filled
 */
function bcnext_remove_current_item($trail)
{
	//Make sure we have a type
	if(isset($trail->breadcrumbs[0]->type) && is_array($trail->breadcrumbs[0]->type) && isset($trail->breadcrumbs[0]->type[1]))
	{
		//Check if we have a current item
		if(in_array('current-item', $trail->breadcrumbs[0]->type))
		{
			//Shift the current item off the front
			array_shift($trail->breadcrumbs);
		}
	}
}