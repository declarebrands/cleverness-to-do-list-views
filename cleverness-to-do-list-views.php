<?php
/*
Plugin Name: Cleverness To-Do List Views
Version: 1.0.0
Description: Additional shortcodes for displaying To-Do List Items made with Cleverness To-Do List plugin
Author: Chris MacKay
Author URI: http://chrismackay.me
Plugin URI: http://github.com/declarebrands/cleverness-to-do-list-views
License: GPL2
*/

/*  
    Copyright 2013 Declare Brands Inc (email: cmackay@declarebrands.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Begin Styling */
add_action('init', 'add_styles');

function add_styles(){
	function do_add_styles(){
	  ?>
		<style type="text/css">
      .circle {
        border-radius: 50%;
        width: 200px;
        height: 200px; 
        /* width and height can be anything, as long as they're equal */
      }
	    /* Spinning, gradient circle; CSS only! */
      #circle-yellow {
        width: 15px;
        height: 15px;
        background-image: -moz-radial-gradient(45px 45px 45deg, circle cover, yellow 0%, orange 100%, red 95%);
        background-image: -webkit-radial-gradient(45px 45px, circle cover, yellow, orange);
        background-image: radial-gradient(45px 45px 45deg, circle cover, yellow 0%, orange 100%, red 95%);
        animation-name: spin; 
        animation-duration: 3s; /* 3 seconds */
        animation-iteration-count: infinite; 
        animation-timing-function: linear;
      }
			#circle-green {
        width: 15px;
        height: 15px;
        background-image: -moz-radial-gradient(45px 45px 45deg, circle cover, green 0%, lightgreen 100%, darkgreen 95%);
        background-image: -webkit-radial-gradient(45px 45px, circle cover, green, lightgreen);
        background-image: radial-gradient(45px 45px 45deg, circle cover, green 0%, lightgreen 100%, darkgreen 95%);
        animation-name: spin; 
        animation-duration: 3s; /* 3 seconds */
        animation-iteration-count: infinite; 
        animation-timing-function: linear;
      }
			#circle-red {
        width: 15px;
        height: 15px;
        background-image: -moz-radial-gradient(45px 45px 45deg, circle cover, red 0%, lightcoral 100%, red 95%);
        background-image: -webkit-radial-gradient(45px 45px, circle cover, red, lightcoral);
        background-image: radial-gradient(45px 45px 45deg, circle cover, red 0%, lightcoral 100%, red 95%);
        animation-name: spin; 
        animation-duration: 3s; /* 3 seconds */
        animation-iteration-count: infinite; 
        animation-timing-function: linear;
      }
			#circle-blue {
        width: 15px;
        height: 15px;
        background-image: -moz-radial-gradient(45px 45px 45deg, circle cover, blue 0%, lightblue 100%, darkblue 95%);
        background-image: -webkit-radial-gradient(45px 45px, circle cover, blue, lightblue);
        background-image: radial-gradient(45px 45px 45deg, circle cover, blue 0%, lightblue 100%, darkblue 95%);
        animation-name: spin; 
        animation-duration: 3s; /* 3 seconds */
        animation-iteration-count: infinite; 
        animation-timing-function: linear;
      }
	  </style>
	  <?
	}
	add_action('wp_head','do_add_styles');
}
/* End Styling */

/* Begin [todolist_category_view] shortcode */
add_shortcode('todolist_category_view', 'todolist_category_view');
function todolist_category_view( $atts ){
	if (isset($_GET['view'])){
	  $view = $_GET['view'];
	} else {
	  $view = 'to-do-list';
	}
	if (isset($_GET['order'])){
	  $order = $_GET['order'];
	} else {
	  $order = 'ASC';
	}
	if (isset($_GET['mark'])){
    $today = date('Y-m-d');
		update_post_meta($_GET['mark'], '_completed', $today);
		update_post_meta($_GET['mark'], '_status', '1');
		if ( count($error) == 0 ) {
      wp_redirect( './?view='.$view );
    }
	}
	$html = '<table>'.PHP_EOL;
	  $html .= '<tr>'.PHP_EOL;
		  switch ($view){
			  case 'to-do-list':
				  if ($order == "ASC"){
					  $html .= '<td class="active" style="text-align: center; background: #c8c8c8;" onclick="';
						$html .= "location.href='./?order=DESC'";
						$html .= '">'.PHP_EOL;
						  $html .= '<a href="./?order=DESC" style="text-decoration: none;">Current</a>'.PHP_EOL;
						$html .= '</td>'.PHP_EOL;
						$html .= '<td class="active" style="text-align: center;" onclick="';
						$html .= "location.href='./?view=completed-to-do'";
						$html .= '">'.PHP_EOL;
						  $html .= '<a href="./?view=completed-to-do" style="text-decoration: none;">Completed</a>'.PHP_EOL;
						$html .= '</td>'.PHP_EOL;
					} else {
					  $html .= '<td class="active" style="text-align: center; background: #c8c8c8;" onclick="';
						$html .= "location.href='./'";
						$html .= '">'.PHP_EOL;
						  $html .= '<a href="./" style="text-decoration: none;">Current</a>'.PHP_EOL;
						$html .= '</td>'.PHP_EOL;
						$html .= '<td class="active" style="text-align: center;" onclick="';
						$html .= "location.href='./?view=completed-to-do&order=DESC'";
						$html .= '">'.PHP_EOL;
						  $html .= '<a href="./?view=completed-to-do&order=DESC" style="text-decoration: none;">Completed</a>'.PHP_EOL;
						$html .= '</td>'.PHP_EOL;
					}
				break;
				case 'completed-to-do':
				  if ($order == "ASC"){
					  $html .= '<td style="text-align: center;" onclick="';
						$html .= "location.href='./'";
						$html .= '">'.PHP_EOL;
						  $html .= '<a href="./" style="text-decoration: none;">Current</a>'.PHP_EOL;
						$html .= '</td>'.PHP_EOL;
						$html .= '<td style="text-align: center; background: #c8c8c8;" onclick="';
						$html .= "location.href='./?view=completed-to-do&order=DESC'";
						$html .= '">'.PHP_EOL;
						  $html .= '<a href="./?view=completed-to-do&order=DESC" style="text-decoration: none;">Completed</a>'.PHP_EOL;
						$html .= '</td>'.PHP_EOL;
					} else {
					  $html .= '<td style="text-align: center;" onclick="';
						$html .= "location.href='./?order=DESC'";
						$html .= '">'.PHP_EOL;
						  $html .= '<a href="./?order=DESC" style="text-decoration: none;">Current</a>'.PHP_EOL;
						$html .= '</td>'.PHP_EOL;
						$html .= '<td style="text-align: center; background: #c8c8c8;" onclick="';
						$html .= "location.href='./?view=completed-to-do'";
						$html .= '">'.PHP_EOL;
						  $html .= '<a href="./?view=completed-to-do" style="text-decoration: none;">Completed</a>'.PHP_EOL;
						$html .= '</td>'.PHP_EOL;
					}
				break;
			}
		$html .= '</tr>'.PHP_EOL;
	$html .= '</table>'.PHP_EOL;
	$completed_todo = array();
	$args = array(
	  'post_type' => 'todo',
		'meta_key' => '_status',
		'orderby' => 'meta_value',
		'meta_value' => 1
	);
	$posts = get_posts($args);
	foreach ($posts as $post){
		array_push($completed_todo, $post->ID);
	}
	$current_todo = array();
	$args = array(
	  'post_type' => 'todo',
		'meta_key' => '_status',
		'orderby' => 'meta_value',
		'meta_value' => 0
	);
	$posts = get_posts($args);
	foreach ($posts as $post){
		array_push($current_todo, $post->ID);
	}
	$html .= '<table style="border-top: solid 1px #fff; border-bottom: solid 1px #fff;">'.PHP_EOL;
	  $html .= '<tr>'.PHP_EOL;
		  $categories = get_terms('todocategories', 'orderby=count&order=DESC&hide_empty=0');
			$count = count($categories);
			$width = 100 / $count;
	    foreach( $categories as $category ):
			  $count = $count - 1;
				if ($count >= 1){
	        $html .= '<td style="text-align: center; border-right: solid 1px #c8c8c8; border-top: none; border-bottom: none; width: '.$width.'%; ">'.PHP_EOL;
				} else {
				  $html .= '<td style="padding: 5px 10px 5px 10px; text-align: center; border-right: none; border-top: none; border-bottom: none; width: '.$width.'%; ">'.PHP_EOL;
				}
				  $html .= '<h1>'.$category->name.'</h1>'.PHP_EOL;
					$args = array(
					  'post_type' => 'todo',
						'term' => $category->slug,
						'taxonomy' => $category->taxonomy,
						'order' => $order
					);
					$posts = get_posts($args);
					$html .= '<table>'.PHP_EOL;
					  foreach ($posts as $post){
						  switch ($view){
							  case 'to-do-list':
								  if (in_array($post->ID, $current_todo)){
						        setup_postdata($post);
							      $post_meta = get_post_meta($post->ID);
							      $html .= '<tr>'.PHP_EOL;
							        $html .= '<td style="padding: 5px 10px 5px 10px; border: solid 1px #c8c8c8;">'.PHP_EOL;
											  $line_count = 0;
										    foreach(preg_split("/((\r?\n)|(\r\n?))/", $post->post_content) as $line){
										      $line_count++;
											    if ($line_count == 1){
											      $html .= '<table>'.PHP_EOL;
												      $html .= '<tr>'.PHP_EOL;
													      $html .= '<td width="10%">'.PHP_EOL;
											            if ($post_meta['priority'][0] == 0){
											              $html .= '<div id="circle-blue" class="circle"></div>'.PHP_EOL;
												          } elseif ($post_meta['priority'][0] == 1) {
												            $html .= '<div id="circle-yellow" class="circle"></div>'.PHP_EOL;
												          } elseif ($post_meta['priority'][0] == 2) {
												            $html .= '<div id="circle-red" class="circle"></div>'.PHP_EOL;
												          }
														    $html .= '</td>'.PHP_EOL;
													      $html .= '<td width="75%">'.PHP_EOL;
											            $html .= $line;
														    $html .= '</td>'.PHP_EOL;
																$html .= '<td width="15%">'.PHP_EOL;
																  $html .= '<a href="./?mark='.$post->ID.'">Complete</a>'.PHP_EOL;
																$html .= '</td>'.PHP_EOL;
													    $html .= '</tr>'.PHP_EOL;
												    $html .= '</table>'.PHP_EOL;
											    } elseif ($line_count == 2){
											      continue;
											    } elseif ($line_count == 3){
											      $html .= '<h1>'.$line.'</h1>'.PHP_EOL;
											    } else {
											      $html .= '<h2>'.apply_filters('the_content', preg_replace('/^.+\n/', '', $line)).'</h2>'.PHP_EOL;
											    }
                        }
												$html .= '<div style="float: right;">'.$post->post_date.'</div>'.PHP_EOL;
											$html .= '</td>'.PHP_EOL;
							      $html .= '</tr>'.PHP_EOL;
									}
								break;
								case 'completed-to-do':
								  if (in_array($post->ID, $completed_todo)){
									  $html .= '<tr>'.PHP_EOL;
							        $html .= '<td style="padding: 5px 10px 5px 10px; border: solid 1px #c8c8c8;">'.PHP_EOL;
											  $line_count = 0;
										    foreach(preg_split("/((\r?\n)|(\r\n?))/", $post->post_content) as $line){
										      $line_count++;
											    if ($line_count == 1){
											      $html .= '<table>'.PHP_EOL;
												      $html .= '<tr>'.PHP_EOL;
													      $html .= '<td width="10%">'.PHP_EOL;
											            if ($post_meta['priority'][0] == 0){
											              $html .= '<div id="circle-blue" class="circle"></div>'.PHP_EOL;
												          } elseif ($post_meta['priority'][0] == 1) {
												            $html .= '<div id="circle-yellow" class="circle"></div>'.PHP_EOL;
												          } elseif ($post_meta['priority'][0] == 2) {
												            $html .= '<div id="circle-red" class="circle"></div>'.PHP_EOL;
												          }
														    $html .= '</td>'.PHP_EOL;
													      $html .= '<td width="90%">'.PHP_EOL;
											            $html .= $line;
														    $html .= '</td>'.PHP_EOL;
													    $html .= '</tr>'.PHP_EOL;
												    $html .= '</table>'.PHP_EOL;
											    } elseif ($line_count == 2){
											      continue;
											    } elseif ($line_count == 3){
											      $html .= '<h1>'.$line.'</h1>'.PHP_EOL;
											    } else {
											      $html .= '<h2>'.apply_filters('the_content', preg_replace('/^.+\n/', '', $line)).'</h2>'.PHP_EOL;
											    }
                        }
												$html .= '<div style="float: right;">'.$post->post_date.'</div>'.PHP_EOL;
											$html .= '</td>'.PHP_EOL;
							      $html .= '</tr>'.PHP_EOL;
									}
								break;
							}
						}
					$html .= '</table>'.PHP_EOL;
				$html .= '</td>'.PHP_EOL;
			endforeach;
		$html .= '</tr>'.PHP_EOL;
	$html .= '</table>'.PHP_EOL;
	return $html;
}
/* End [todolist_category_view] shortcode */
