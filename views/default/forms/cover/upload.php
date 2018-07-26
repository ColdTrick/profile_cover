<?php

$user = elgg_extract('entity', $vars);
if (!$user instanceof ElggUser) {
	return;
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'guid',
	'value' => $user->guid,
]);

$width = (int) elgg_get_plugin_setting('width', 'profile_cover', 1600);
$height = (int) elgg_get_plugin_setting('height', 'profile_cover', 300);

echo elgg_view_field([
	'#type' => 'file',
	'#label' => elgg_echo('profile_cover:upload:cover_image'),
	'#help' => elgg_echo('profile_cover:upload:cover_image:help', [$width, $height]),
	'name' => 'cover_image',
]);

// footer
$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('upload'),
]);

elgg_set_form_footer($footer);
