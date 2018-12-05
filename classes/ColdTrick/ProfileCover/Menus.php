<?php

namespace ColdTrick\ProfileCover;

class Menus {
	
	/**
	 * Add menu items to the user_hover menu
	 *
	 * @param string          $hook         the name of the hook
	 * @param string          $type         the type of the hook
	 * @param \ElggMenuItem[] $return_value current return value
	 * @param array           $params       supplied params
	 *
	 * @return void|\ElggMenuItem[]
	 */
	public static function userHover($hook, $type, $return_value, $params) {
		
		$user = elgg_extract('entity', $params);
		if (!($user instanceof \ElggUser) || !$user->canEdit()) {
			return;
		}
		
		$section = ($user->getGUID() === elgg_get_logged_in_user_guid()) ? 'action' : 'admin';
		
		$return_value[] = \ElggMenuItem::factory([
			'name' => 'profile_cover',
			'text' => elgg_echo('profile_cover:menu:edit'),
			'href' => "cover/edit/{$user->guid}",
			'section' => $section,
		]);
		
		return $return_value;
	}
	
	/**
	 * Add menu items to the page menu on the settings page
	 *
	 * @param string          $hook         the name of the hook
	 * @param string          $type         the type of the hook
	 * @param \ElggMenuItem[] $return_value current return value
	 * @param array           $params       supplied params
	 *
	 * @return void|\ElggMenuItem[]
	 */
	public static function settingsPage($hook, $type, $return_value, $params) {
		
		if (!elgg_in_context('settings')) {
			return;
		}
		
		$page_owner = elgg_get_page_owner_entity();
		if (!($page_owner instanceof \ElggUser) || !$page_owner->canEdit()) {
			return;
		}
		
		$return_value[] = \ElggMenuItem::factory([
			'name' => 'profile_cover',
			'text' => elgg_echo('profile_cover:menu:edit'),
			'href' => "cover/edit/{$page_owner->guid}",
			'section' => '1_profile',
		]);
		
		return $return_value;
	}
}
