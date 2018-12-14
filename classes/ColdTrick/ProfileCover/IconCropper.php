<?php

namespace ColdTrick\ProfileCover;

class IconCropper {
	
	/**
	 * Prepare aspect ratio for the cropper
	 *
	 * @param \Elgg\Hook $hook 'view_vars', 'icon_cropper/init'
	 *
	 * @return void|array
	 */
	public static function setAspectRatioSize(\Elgg\Hook $hook) {
		
		$vars = $hook->getValue();
		if (elgg_extract('icon_type', $vars) !== 'profile_cover') {
			return;
		}
		
		$vars['cropper_aspect_ratio_size'] = elgg_extract('cropper_aspect_ratio_size', $vars, 'cover');
		
		return $vars;
	}
}
