<?php

namespace ColdTrick\ProfileCover\Upgrades;

use Elgg\Upgrade\AsynchronousUpgrade;
use Elgg\Upgrade\Result;

class MigrateCroppingCoordinates implements AsynchronousUpgrade {
	
	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::getVersion()
	 */
	public function getVersion() {
		return 2018121400;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::shouldBeSkipped()
	 */
	public function shouldBeSkipped() {
		return empty($this->countItems());
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::countItems()
	 */
	public function countItems() {
		return elgg_get_entities($this->getOptions(['count' => true]));
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::needsIncrementOffset()
	 */
	public function needsIncrementOffset() {
		return false;
	}
	
	/**
	 * Migrate the cropping coordinates to the default Elgg metadata name
	 *
	 * {@inheritDoc}
	 * @see \Elgg\Upgrade\Batch::run()
	 */
	public function run(Result $result, $offset) {
		
		$entities = elgg_get_entities($this->getOptions(['offset' => $offset]));
		/* @var $entity \ElggEntity */
		foreach ($entities as $entity) {
			// store coords in new place
			$x1 = (int) $entity->profile_cover_x1;
			$y1 = (int) $entity->profile_cover_y1;
			$x2 = (int) $entity->profile_cover_x2;
			$y2 = (int) $entity->profile_cover_y2;
			
			if ($x1 || $y1 || $x2 || $y2) {
				$entity->profile_cover_coords = serialize([
					'x1' => $x1,
					'y1' => $y1,
					'x2' => $x2,
					'y2' => $y2,
				]);
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
			
			$result->addSuccesses();
		}
	}
	
	/**
	 * Get options for selecting entities to update
	 *
	 * @param array $options additional options
	 *
	 * @see elgg_get_entities()
	 * @return array
	 */
	protected function getOptions(array $options = []) {
		$defaults = [
			'metadata_names' => [
				'profile_cover',
				'profile_cover_x1',
				'profile_cover_y1',
				'profile_cover_x2',
				'profile_cover_y2',
				'profile_cover_width',
				'profile_cover_heigh',
			],
			'limit' => 10,
		];
		
		return array_merge($defaults, $options);
	}
}
