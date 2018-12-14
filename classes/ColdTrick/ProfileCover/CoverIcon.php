<?php

namespace ColdTrick\ProfileCover;

class CoverIcon {
	
	/**
	 * Get the configured cover width
	 *
	 * @return int
	 */
	public static function getWidth() {
		return (int) elgg_get_plugin_setting('width', 'profile_cover');
	}
	
	/**
	 * Get the configured cover height
	 *
	 * @return int
	 */
	public static function getHeight() {
		return (int) elgg_get_plugin_setting('height', 'profile_cover');
	}
	
	/**
	 * Set the correct sizes for the profile cover image
	 *
	 * @param \Elgg\Hook $hook 'entity:profile_cover:sizes', 'user'
	 *
	 * @return void|array
	 */
	public static function sizes(\Elgg\Hook $hook) {
		
		$result = (array) $hook->getValue();
		
		if (!isset($result['master'])) {
			$result['master'] = [
				'w' => 2048,
				'h' => 2048,
				'square' => false,
				'upscale' => false,
				'crop' => false,
			];
		}
		if (!isset($result['master']['crop'])) {
			// prevent cropping of master
			$result['master']['crop'] = false;
		}
		
		if (!isset($result['cover'])) {
			$result['cover'] = [
				'w' => self::getWidth(),
				'h' => self::getHeight(),
				'square' => false,
				'upscale' => false,
			];
		}
		
		return $result;
	}
}
