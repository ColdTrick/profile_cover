<?php

use ColdTrick\ProfileCover\Bootstrap;
use Elgg\Router\Middleware\Gatekeeper;
use ColdTrick\ProfileCover\Upgrades\MigrateCroppingCoordinates;

return [
	'bootstrap' => Bootstrap::class,
	'actions' => [
		'cover/upload' => [],
	],
	'routes' => [
		'settings:cover' => [
			'path' => 'settings/cover/{username}',
			'middleware' => [
				Gatekeeper::class,
			],
			'resource' => 'settings/cover',
		],
	],
	'settings' => [
		'height' => 300,
		'width' => 1600,
	],
	'upgrades' => [
		MigrateCroppingCoordinates::class,
	],
];
