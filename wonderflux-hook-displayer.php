<?php
/*
Plugin Name: Wonderflux hook displayer
Plugin URI: http://wonderflux.com
Description: When logged in as a user has capability of manage_options (can be override with wflux_debug_show_hooks filter) and WF_DEBUG constant defined as true, this plugin reveals the location of all relevant Wonderflux display hooks within your theme. NOTE: NOT REQUIRED WITH WONDERFLUX v1.2 or above - it's included in the Wonderflux core code!
Author: Jonny Allbut
Version: 0.21
Author URI: http://jonnya.net
License: GPL v2 or later
*/


/**
 *
 * Activate plugin
 *
 */
function wfx_hookd_activate() {
	add_option( 'wpcms_wc_activate', 'Y' );
}
register_activation_hook( __FILE__, 'wfx_hookd_activate' );


/**
 *
 * Deactivate plugin
 *
 */
function wfx_hookd_deactivate() {
	delete_option('wpcms_wc_activate');
}
register_activation_hook( __FILE__, 'wfx_hookd_deactivate' );


/**
 *
 * Checks for Wonderflux use and version on activation
 * Have to do it this way as activation hook is too early for some conditional checks
 *
 */
function wfx_hookd_admin_wf_check() {

	global $pagenow;

	if ( is_admin() && current_user_can('activate_plugins') && $pagenow == 'plugins.php' ) {

		$this_theme = wp_get_theme();
		$this_framework = $this_theme->get( 'Template' );

		if (  $this_framework != 'wonderflux' ){
			if ( get_option( 'wpcms_wc_activate' ) == 'Y'){
   				unset( $_GET['activate'] );
				add_action( 'admin_notices', 'wfx_hookd_admin_notice_no_wfx' );
				deactivate_plugins( plugin_basename( __FILE__ ) );
			}
		} elseif ( $this_framework == 'wonderflux' && intval( WF_VERSION ) >= 2 ){

   				unset( $_GET['activate'] );
				add_action( 'admin_notices', 'wfx_hookd_admin_notice_version_wfx' );
				deactivate_plugins( plugin_basename( __FILE__ ) );
		}

	}

	delete_option( 'wpcms_wc_activate' );

}
add_action( 'admin_init', 'wfx_hookd_admin_wf_check' );


/**
 *
 * Activation admin notice for if not using Wonderflux
 *
 */
function wfx_hookd_admin_notice_no_wfx(){

    echo '<div class="error">';
	echo '<p>Ooops - you need to be using the Wonderflux theme framework to use the <b>Wonderflux hook displayer</b> plugin!</p>';
	echo '<p>Plugin has been deactivated.</p>';
	echo '</div>';

}


/**
 *
 * Activation admin notice for Wonderflux version check
 *
 */
function wfx_hookd_admin_notice_version_wfx(){

    echo '<div class="error">';
	echo '<p>You no longer need the <b>Wonderflux hook displayer</b> plugin.</p>';
	echo '<p>This code has been incorporated into the Wonderflux core - cool!</p>';
	echo '<p>Plugin has been deactivated.</p>';
	echo '</div>';

}


function wfx_hookd_show_hooks(){

	$debug_style = apply_filters( 'wflux_debug_show_hooks_css', 'display: inline-block; background-color: rgba(127, 127, 127, 0.7); border: 1px solid #212121; margin: 0; font-size: 0.8em; color: #fff;' );
	echo '<p style="'.esc_attr($debug_style).'">Wonderflux hook: &#x27;' . current_filter() . '&#x27;</p>';

}


function wfx_hookd_do_show_hooks(){

	// Wonderflux includes this functionality in the core from version 1.2
	if ( function_exists('wfx_show_hooks') ) return;

	$user_priv = ( has_filter('wflux_debug_show_hooks') ) ? apply_filters( 'wflux_debug_show_hooks', false ) : current_user_can( 'manage_options' );

	if ( !is_admin() && $user_priv && WF_DEBUG ){

		add_action( 'wf_output_start', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wf_head_meta', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wf_after_head', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wf_footer', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfbody_before_wrapper', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfbody_after_wrapper', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfheader_before_wrapper', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfheader_before_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfheader_before_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfheader_after_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfheader_after_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfheader_after_wrapper', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wffooter_before_wrapper', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wffooter_before_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wffooter_before_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wffooter_after_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wffooter_after_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wffooter_after_wrapper', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_all', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_all', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_all', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_all', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_wrapper', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_wrapper', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_all_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_all_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_all_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_all_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_all_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_index', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_index', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_index_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_index_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_index_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_index_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_index_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_index', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_index', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_home', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_home', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_home_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_home_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_home_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_home_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_home_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_home', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_home', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_page', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_page', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_page_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_page_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_page_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_page_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_page_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_page', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_page', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_single', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_single', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_single_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_single_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_single_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_single_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_single_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_single', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_single', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_category', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_category', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_category_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_category_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_category_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_category_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_category_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_category', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_category', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_date', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_date', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_date_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_date_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_date_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_date_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_date_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_date', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_date', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_author', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_author', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_author_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_author_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_author_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_author_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_author_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_author', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_author', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_tag', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_tag', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_tag_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_tag_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_tag_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_tag_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_tag_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_tag', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_tag', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_taxonomy', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_taxonomy', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_taxonomy_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_taxonomy_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_taxonomy_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_taxonomy_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_taxonomy_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_taxonomy', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_taxonomy', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_archive', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_archive', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_archive_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_archive_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_archive_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_archive_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_archive_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_archive', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_archive', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_search', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_search', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_search_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_search_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_search_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_search_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_search_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_search', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_search', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_attachment', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_attachment', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_attachment_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_attachment_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_attachment_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_attachment_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_attachment_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_attachment', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_attachment', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_before_404', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfsidebar_after_404', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_404_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_404_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_404_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_404_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_404_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_before_found_posts_404', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfloop_after_found_posts_404', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_bp_container', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_before_bp_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_bp_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_bp_main_content', 'wfx_hookd_show_hooks', 1 );
		add_action( 'wfmain_after_bp_container', 'wfx_hookd_show_hooks', 1 );

	}

}
add_action('init','wfx_hookd_do_show_hooks');
?>