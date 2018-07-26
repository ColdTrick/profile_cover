<?php

use ColdTrick\ProfileCover\CoverIcon;

$user = elgg_extract('entity', $vars);
if (!$user instanceof ElggUser || !elgg_is_active_plugin('cropper')) {
	return;
}

if (!$user->hasIcon('master', 'profile_cover')) {
	// no uploaded cover image
	return;
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'guid',
	'value' => $user->guid,
]);

$crop = elgg_view('output/longtext', [
	'value' => elgg_echo('profile_cover:crop:description'),
	'class' => 'mbm',
]);

$crop .= elgg_view_field([
	'#type' => 'cropper',
	'name' => 'crop',
	'src' => $user->getIconURL([
		'size' => 'master',
		'type' => 'profile_cover',
	]),
	'id' => 'profile-cover-crop',
	'ratio' => CoverIcon::getWidth() / CoverIcon::getHeight(),
	'x1' => $user->profile_cover_x1,
	'y1' => $user->profile_cover_y1,
	'x2' => $user->profile_cover_x2,
	'y2' => $user->profile_cover_y2,
]);

echo elgg_view_module('info', elgg_echo('profile_cover:crop:title'), $crop);

// footer
$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('profile_cover:crop:submit'),
]);

elgg_set_form_footer($footer);
