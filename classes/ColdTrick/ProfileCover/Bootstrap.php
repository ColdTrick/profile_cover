<?php

namespace ColdTrick\ProfileCover;

use Elgg\DefaultPluginBootstrap;

class Bootstrap extends DefaultPluginBootstrap {
	
	/**
	 * {@inheritDoc}
	 */
	public function init() {
		
		// css/js
		elgg_extend_view('css/elgg', 'css/cover/site.css');
		
		// plugin hooks
		$hooks = $this->elgg()->hooks;
		$hooks->registerHandler('register', 'menu:entity', __NAMESPACE__ . '\Menus::entityMenu');
		$hooks->registerHandler('register', 'menu:page', __NAMESPACE__ . '\Menus::settingsPage');
		$hooks->registerHandler('register', 'menu:user_hover', __NAMESPACE__ . '\Menus::userHover');
		
		$hooks->registerHandler('entity:profile_cover:sizes', 'user', __NAMESPACE__ . '\CoverIcon::sizes');
		$hooks->registerHandler('entity:profile_cover:saved', 'user', __NAMESPACE__ . '\CoverIcon::saved');
		$hooks->registerHandler('entity:profile_cover:delete', 'user', __NAMESPACE__ . '\CoverIcon::delete');
	}
}
