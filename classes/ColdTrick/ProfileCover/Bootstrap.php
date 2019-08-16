<?php

namespace ColdTrick\ProfileCover;

use Elgg\DefaultPluginBootstrap;

class Bootstrap extends DefaultPluginBootstrap {
	
	/**
	 * {@inheritDoc}
	 * @see \Elgg\DefaultPluginBootstrap::init()
	 */
	public function init() {
		
		$this->registerHooks();
	}
	
	/**
	 * Register plugin hooks
	 *
	 * @return void
	 */
	protected function registerHooks() {
		$hooks = $this->elgg()->hooks;
		
		$hooks->registerHandler('entity:profile_cover:sizes', 'all', __NAMESPACE__ . '\CoverIcon::sizes');
		$hooks->registerHandler('register', 'menu:entity', __NAMESPACE__ . '\Menus::entityMenu');
		$hooks->registerHandler('register', 'menu:page', __NAMESPACE__ . '\Menus::settingsPage');
		$hooks->registerHandler('register', 'menu:user_hover', __NAMESPACE__ . '\Menus::userHover');
	}
}
