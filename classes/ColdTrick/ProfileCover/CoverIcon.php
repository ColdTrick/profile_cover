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
		
		$return_value = [];
		
		$cropping = elgg_get_config('profile_cover_cropping');
		if (empty($cropping)) {
			// currently not cropping, so provide master settings
			$return_value['master'] = [
				'w' => 2048,
				'h' => 2048,
				'square' => false,
				'upscale' => false,
			];
		}
		
		$return_value['cover'] = [
			'w' => self::getWidth(),
			'h' => self::getHeight(),
			'square' => false,
			'upscale' => false,
		];
		
		return $return_value;
	}
	
	/**
	 * Hook to tell that profile cover was saved successfully
	 *
	 * @param \Elgg\Hook $hook 'entity:profile_cover:saved'
	 *
	 * @return void
	 */
	public static function saved(\Elgg\Hook $hook) {
		
		$entity = $hook->getEntityParam();
		if (!$entity instanceof \ElggUser) {
			return;
		}
		
		// save a timestamp
		$entity->profile_cover = time();
		
		// save cropping coordinates
		$entity->profile_cover_x1 = elgg_extract('x1', $params);
		$entity->profile_cover_y1 = elgg_extract('y1', $params);
		$entity->profile_cover_x2 = elgg_extract('x2', $params);
		$entity->profile_cover_y2 = elgg_extract('y2', $params);
		
		// save width/height
		$entity->profile_cover_width = self::getWidth();
		$entity->profile_cover_height = self::getHeight();
	}
	
	/**
	 * Hook to tell that profile cover is about to be removed
	 *
	 * @param \Elgg\Hook $hook 'entity:profile_cover:delete'
	 *
	 * @return void
	 */
	public static function delete(\Elgg\Hook $hook) {
		
		$entity = $hook->getEntityParam();
		if (!$entity instanceof \ElggUser) {
			return;
		}
		
		// unset a timestamp
		unset($entity->profile_cover);
		
		// unset cropping coordinates
		unset($entity->profile_cover_x1);
		unset($entity->profile_cover_y1);
		unset($entity->profile_cover_x2);
		unset($entity->profile_cover_y2);
		
		// unset width/height
		unset($entity->profile_cover_width);
		unset($entity->profile_cover_heigh);
	}
}
