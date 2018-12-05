<?php

// register default elgg events
elgg_register_event_handler('init', 'system', 'profile_cover_init');

/**
 * Init function for this plugin
 *
 * @return void
 */
function profile_cover_init() {
	
	// css/js
	elgg_extend_view('css/elgg', 'css/cover/site.css');
	
	// page handlers
	elgg_register_page_handler('cover', '\ColdTrick\ProfileCover\PageHandler::cover');
	
	// plugin hooks
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', '\ColdTrick\ProfileCover\Menus::userHover');
	elgg_register_plugin_hook_handler('register', 'menu:page', '\ColdTrick\ProfileCover\Menus::settingsPage');
	
	elgg_register_plugin_hook_handler('entity:profile_cover:sizes', 'all', '\ColdTrick\ProfileCover\CoverIcon::sizes');
	elgg_register_plugin_hook_handler('entity:profile_cover:saved', 'all', '\ColdTrick\ProfileCover\CoverIcon::saved');
	elgg_register_plugin_hook_handler('entity:profile_cover:delete', 'all', '\ColdTrick\ProfileCover\CoverIcon::delete');
	
	// actions
	elgg_register_action('cover/upload', dirname(__FILE__) . '/actions/cover/upload.php');
	elgg_register_action('cover/remove', dirname(__FILE__) . '/actions/cover/remove.php');
	elgg_register_action('cover/crop', dirname(__FILE__) . '/actions/cover/crop.php');
}
