<?php

namespace ColdTrick\ProfileCover;

class PageHandler {
	
	/**
	 * Handle /cover
	 *
	 * @param string[] $page URL segments
	 *
	 * @return bool
	 */
	public static function cover($page) {
		
		switch (elgg_extract(0, $page)) {
			case 'edit':
				
				echo elgg_view_resource('cover/edit', [
					'guid' => elgg_extract(1, $page),
				]);
				return true;
				break;
		}
		
		return false;
	}
}
