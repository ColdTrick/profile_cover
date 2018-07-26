<?php

namespace ColdTrick\ProfileCover;

class Menus {
	
	/**
	 * Add menu items to the user_hover menu
	 *
	 * @param \Elgg\Hook $hook 'register', 'menu:user_hover'
	 *
	 * @return void|\ElggMenuItem[]
	 */
	public static function userHover(\Elgg\Hook $hook) {
		
		$user = $hook->getEntityParam();
		if (!$user instanceof \ElggUser || !$user->canEdit()) {
			return;
		}
		
		$section = ($user->guid === elgg_get_logged_in_user_guid()) ? 'action' : 'admin';
		
		$return_value = $hook->getValue();
		
		$return_value[] = \ElggMenuItem::factory([
			'name' => 'profile_cover',
			'text' => elgg_echo('profile_cover:menu:edit'),
			'href' => elgg_generate_url('settings:cover', [
				'username' => $user->username,
			]),
			'section' => $section,
		]);
		
		return $return_value;
	}
	
	/**
	 * Add menu items to the page menu on the settings page
	 *
	 * @param \Elgg\Hook $hook 'register', 'menu:page'
	 *
	 * @return void|\ElggMenuItem[]
	 */
	public static function settingsPage(\Elgg\Hook $hook) {
		
		if (!elgg_in_context('settings')) {
			return;
		}
		
		$page_owner = elgg_get_page_owner_entity();
		if (!$page_owner instanceof \ElggUser || !$page_owner->canEdit()) {
			return;
		}
		
		$return_value = $hook->getValue();
		
		$return_value[] = \ElggMenuItem::factory([
			'name' => 'profile_cover',
			'text' => elgg_echo('profile_cover:menu:edit'),
			'href' => elgg_generate_url('settings:cover', [
				'username' => $user->username,
			]),
			'section' => '1_profile',
		]);
		
		return $return_value;
	}
}
