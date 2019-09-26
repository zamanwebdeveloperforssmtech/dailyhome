<?php

include 'theme_options.php';
include 'guide.php';

if ( function_exists('register_sidebar') )
	register_sidebar(array(
	'name' => 'Sidebar',
    'before_widget' => '<div class="sidebox rounded">',
    'after_widget' => '</div>',
	'before_title' => '<h3 class="sidetitle rounded">',
    'after_title' => '</h3>',
	));

register_sidebar(array(
	'name' => 'Footer',
    'before_widget' => '<div class="botwid">',
    'after_widget' => '</div>',
	'before_title' => '<h3 class="bothead">',
    'after_title' => '</h3>',
    ));		
		
	
register_nav_menus( array(
		'primary' => __( 'Primary Navigation', '' ),
	));	
	
function new_excerpt_more($more) {
return '<a href="'. get_permalink($post->ID) . '">' . '&nbsp;&nbsp;[ Read More ]' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function get_image_url(){
$image_id = get_post_thumbnail_id();
$image_url = wp_get_attachment_image_src($image_id,'atln_slider');
$image_url = $image_url[0];
echo $image_url;
}

if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'atln_slider', 300, 150, true );

}



function seo_wp_title( $title, $separator ) {
	if ( is_feed() )
	return $title;
	global $paged, $page;
	if ( is_search() ) {
		$title = sprintf( __( 'Search results for %s', '' ), '"' . get_search_query() . '"' );
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', '' ), $paged );
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		return $title;
	}
	$title .= get_bloginfo( 'name', 'display' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', '' ), max( $paged, $page ) );
	return $title;
}			

add_filter( 'wp_title', 'seo_wp_title', 10, 2 );




$new_meta_boxes =
array(
	"slides" => array(
	"name" => "slides",
	"std" => "",
	"title" => "Slide image url",
	"description" => "
		<p><b> Please check the following before entering image url</b></p>
		<p> 1. Use only images uploaded to your wp-content/uploads folder. The image size should be of <b>900x300</b> pixels </p>
		<p> 2. Enter only the part of the image url which follows the wp-content/uploads/ </p>
		<p>( Example: If your image url is http://yoursite.com/wp-content/uploads/2010/04/image.jpg, only enter <b> 2010/04/image.jpg</b> in the text field.)</p>
	"
),
);


function new_meta_boxes() {
global $post, $new_meta_boxes;

foreach($new_meta_boxes as $meta_box) {
$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

if($meta_box_value == "")
$meta_box_value = $meta_box['std'];

echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

echo'<h2 style=" margin:0px; padding:0px 3px; font-style:normal; font-family:Tahoma; font-size:13px;font-weight:bold;">'.$meta_box['title'].'</h2>';

echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="95" /><br />';

echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
}
}
function create_meta_box() {
global $theme_name;
if ( function_exists('add_meta_box') ) {
add_meta_box( 'new-meta-boxes', '3D slider image', 'new_meta_boxes', 'post', 'normal', 'high' );
}
}
function save_postdata( $post_id ) {
global $post, $new_meta_boxes;

foreach($new_meta_boxes as $meta_box) {
// Verify
if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
return $post_id;
}

if ( 'page' == $_POST['post_type'] ) {
if ( !current_user_can( 'edit_page', $post_id ))
return $post_id;
} else {
if ( !current_user_can( 'edit_post', $post_id ))
return $post_id;
}

$data = $_POST[$meta_box['name'].'_value'];

if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
update_post_meta($post_id, $meta_box['name'].'_value', $data);
elseif($data == "")
delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
}
}
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');



?>
