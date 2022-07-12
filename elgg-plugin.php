<?php

use ColdTrick\ProfileCover\Upgrades\MigrateCroppingCoordinates;
use Elgg\Router\Middleware\Gatekeeper;
use Elgg\Router\Middleware\UserPageOwnerCanEditGatekeeper;

return [
	'plugin' => [
		'version' => '5.0.1',
	],
	'actions' => [
		'cover/upload' => [],
	],
	'hooks' => [
		'entity:profile_cover:sizes' => [
			'all' => [
				'\ColdTrick\ProfileCover\CoverIcon::sizes' => [],
			],
		],
		'register' => [
			'menu:entity' => [
				'\ColdTrick\ProfileCover\Menus::entityMenu' => [],
			],
			'menu:page' => [
				'\ColdTrick\ProfileCover\Menus::settingsPage' => [],
			],
			'menu:user_hover' => [
				'\ColdTrick\ProfileCover\Menus::userHover' => [],
			],
		],
	],
	'routes' => [
		'settings:cover' => [
			'path' => 'settings/cover/{username}',
			'middleware' => [
				Gatekeeper::class,
				UserPageOwnerCanEditGatekeeper::class,
			],
			'resource' => 'settings/cover',
			'detect_page_owner' => true,
		],
		'cover:edit' => [
			'path' => 'cover/edit/{guid}',
			'middleware' => [
				Gatekeeper::class,
			],
			'resource' => 'cover/edit',
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
