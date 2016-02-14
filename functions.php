<?php
/**
 * Apple Tree functions file
 *
 * @package WordPress
 * @subpackage Apple Tree
 * @since Apple Tree 1.0
 */


/******************************************************************************\
	Theme support, standard settings, menus and widgets
\******************************************************************************/

add_theme_support( 'post-formats', array( 'image', 'quote', 'status', 'link' ) );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

$custom_bg_args = array(
	'default-color' => 'fbf7ee',
	'default-image' => '',
);
add_theme_support( 'custom-background', $custom_bg_args );


register_nav_menu( 'main-menu', __( 'Your sites main menu', 'appletreesg.com' ) );

function appletree_load_theme_textdomain() {
	load_theme_textdomain('appletreesg.com', get_template_directory() . '/languages/');
}
add_action('after_setup_theme', 'appletree_load_theme_textdomain');

function appletree_set_locale($lang) {
	if(isset($_GET['lang']))
	{
		$language = $_GET['lang'];
		if($language =='zh')
			return 'zh_CN';
		else
			return 'en_US';
	}
	else
	{
		return $lang;
	}
}
add_filter('locale', 'appletree_set_locale');

/******************************************************************************\
	Content functions
\******************************************************************************/

/**
 * Displays meta information for a post
 * @return void
 */
function appletree_post_meta() {
	if ( get_post_type() == 'post' ) {
		echo sprintf(
			__( 'Posted %s in %s%s by %s. ', 'appletreesg.com' ),
			get_the_time( get_option( 'date_format' ) ),
			get_the_category_list( ', ' ),
			get_the_tag_list( __( ', <b>Tags</b>: ', 'appletreesg.com' ), ', ' ),
			get_the_author_link()
		);
	}
	edit_post_link( __( ' (edit)', 'appletreesg.com' ), '<span class="edit-link">', '</span>' );
}