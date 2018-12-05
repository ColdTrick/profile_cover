<?php

namespace ColdTrick\ProfileCover;

class CoverIcon {
	
	/**
	 * Get the configured cover width
	 *
	 * @return int
	 */
	public static function getWidth() {
		return (int) elgg_get_plugin_setting('width', 'profile_cover', 1600);
	}
	
	/**
	 * Get the configured cover height
	 *
	 * @return int
	 */
	public static function getHeight() {
		return (int) elgg_get_plugin_setting('height', 'profile_cover', 300);
	}
	
	/**
	 * Set the correct sizes for the profile cover image
	 *
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param array  $return_value current return value
	 * @param array  $params       supplied params
	 *
	 * @return void|array
	 */
	public static function sizes($hook, $type, $return_value, $params) {
		
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
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param array  $return_value current return value
	 * @param array  $params       supplied params
	 *
	 * @return void
	 */
	public static function saved($hook, $type, $return_value, $params) {
		
		$entity = elgg_extract('entity', $params);
		if (!($entity instanceof \ElggEntity)) {
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
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param array  $return_value current return value
	 * @param array  $params       supplied params
	 *
	 * @return void
	 */
	public static function delete($hook, $type, $return_value, $params) {
		
		$entity = elgg_extract('entity', $params);
		if (!($entity instanceof \ElggEntity)) {
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
