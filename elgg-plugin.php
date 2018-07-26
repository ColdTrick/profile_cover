<?php

use ColdTrick\ProfileCover\Bootstrap;
use Elgg\Router\Middleware\Gatekeeper;

return [
	'bootstrap' => Bootstrap::class,
	'actions' => [
		'cover/upload' => [],
		'cover/remove' => [],
		'cover/crop' => [],
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
];
