<?php

/* @var $plugin \ElggPlugin */
$plugin = elgg_extract('entity', $vars);

// set dimenstions of cover image
echo elgg_view_field([
	'#type' => 'number',
	'#label' => elgg_echo('profile_cover:settings:width'),
	'name' => 'params[width]',
	'value' => (int) $plugin->getSetting('width', 1600),
	'min' => 1,
]);

echo elgg_view_field([
	'#type' => 'number',
	'#label' => elgg_echo('profile_cover:settings:height'),
	'name' => 'params[height]',
	'value' => (int) $plugin->getSetting('height', 300),
	'min' => 1,
]);
