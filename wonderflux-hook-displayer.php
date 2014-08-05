<?php
/*
Plugin Name: Wonderflux hook displayer
Plugin URI: http://wonderflux.com
Description: When logged in as a user has capability of manage_options, this plugin reveals the location of all Wonderflux display hooks within your template.
Author: Jonny Allbut
Version: 0.1
Author URI: http://jonnya.net
License: GPL v2 or later
*/

function mywfx_show_hooks(){
	$output = '<div style="overflow:auto; background-color: rgba(133, 133, 133, 0.75); clear: both;">';
	$output .= '<p style="color:#fff; margin:0px; padding: 0px; font-size:0.8em">Wonderflux hook: &#x27;' . current_filter() . '&#x27;</p>';
	$output .= '</div>';
	echo $output;
}

function mywfx_do_show_hooks(){

	//define('WF_DEBUG',true);

	// Maybe add a filter here to control visibility
	// Maybe just create 2 functions to render out for different purposes?

	//if ( !is_admin() && WF_DEBUG && current_user_can( 'manage_options' ) ){
	if ( !is_admin() && current_user_can( 'manage_options' ) ){

		add_action( 'wf_output_start', 'mywfx_show_hooks' );
		add_action( 'wf_head_meta', 'mywfx_show_hooks' );
		add_action( 'wf_after_head', 'mywfx_show_hooks' );
		add_action( 'wf_footer', 'mywfx_show_hooks' );
		add_action( 'wfbody_before_wrapper', 'mywfx_show_hooks' );
		add_action( 'wfbody_after_wrapper', 'mywfx_show_hooks' );
		add_action( 'wfheader_before_wrapper', 'mywfx_show_hooks' );
		add_action( 'wfheader_before_container', 'mywfx_show_hooks' );
		add_action( 'wfheader_before_content', 'mywfx_show_hooks' );
		add_action( 'wfheader_after_content', 'mywfx_show_hooks' );
		add_action( 'wfheader_after_container', 'mywfx_show_hooks' );
		add_action( 'wfheader_after_wrapper', 'mywfx_show_hooks' );
		add_action( 'wffooter_before_wrapper', 'mywfx_show_hooks' );
		add_action( 'wffooter_before_container', 'mywfx_show_hooks' );
		add_action( 'wffooter_before_content', 'mywfx_show_hooks' );
		add_action( 'wffooter_after_content', 'mywfx_show_hooks' );
		add_action( 'wffooter_after_container', 'mywfx_show_hooks' );
		add_action( 'wffooter_after_wrapper', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_all', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_all', 'mywfx_show_hooks' );
		add_action( 'wfloop_before', 'mywfx_show_hooks' );
		add_action( 'wfloop_after', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_all', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_all', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_wrapper', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_wrapper', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_all_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_all_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_all_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_all_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_all_main_content', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_index', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_index', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_index_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_index_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_index_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_index_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_index_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_index', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_index', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_home', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_home', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_home_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_home_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_home_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_home_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_home_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_home', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_home', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_page', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_page', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_page_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_page_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_page_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_page_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_page_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_page', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_page', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_single', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_single', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_single_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_single_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_single_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_single_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_single_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_single', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_single', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_category', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_category', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_category_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_category_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_category_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_category_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_category_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_category', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_category', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_date', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_date', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_date_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_date_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_date_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_date_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_date_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_date', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_date', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_author', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_author', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_author_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_author_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_author_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_author_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_author_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_author', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_author', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_tag', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_tag', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_tag_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_tag_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_tag_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_tag_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_tag_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_tag', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_tag', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_taxonomy', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_taxonomy', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_taxonomy_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_taxonomy_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_taxonomy_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_taxonomy_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_taxonomy_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_taxonomy', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_taxonomy', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_archive', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_archive', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_archive_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_archive_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_archive_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_archive_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_archive_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_archive', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_archive', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_search', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_search', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_search_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_search_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_search_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_search_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_search_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_search', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_search', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_attachment', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_attachment', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_attachment_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_attachment_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_attachment_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_attachment_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_attachment_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_attachment', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_attachment', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_before_404', 'mywfx_show_hooks' );
		add_action( 'wfsidebar_after_404', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_404_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_404_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_404_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_404_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_404_container', 'mywfx_show_hooks' );
		add_action( 'wfloop_before_found_posts_404', 'mywfx_show_hooks' );
		add_action( 'wfloop_after_found_posts_404', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_bp_container', 'mywfx_show_hooks' );
		add_action( 'wfmain_before_bp_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_bp_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_bp_main_content', 'mywfx_show_hooks' );
		add_action( 'wfmain_after_bp_container', 'mywfx_show_hooks' );
	}
}
add_action('init','mywfx_do_show_hooks');
?>