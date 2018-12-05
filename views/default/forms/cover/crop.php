<?php

use ColdTrick\ProfileCover\CoverIcon;

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof ElggEntity) || !elgg_is_active_plugin('cropper')) {
	return;
}

if (!$entity->hasIcon('master', 'profile_cover')) {
	// no uploaded cover image
	return;
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'guid',
	'value' => $entity->getGUID(),
]);

$crop = elgg_view('output/longtext', [
	'value' => elgg_echo('profile_cover:crop:description'),
	'class' => 'mbm',
]);

$crop .= elgg_view_field([
	'#type' => 'cropper',
	'name' => 'crop',
	'src' => $entity->getIconURL([
		'size' => 'master',
		'type' => 'profile_cover',
	]),
	'id' => 'profile-cover-crop',
	'ratio' => CoverIcon::getWidth() / CoverIcon::getHeight(),
	'x1' => $entity->profile_cover_x1,
	'y1' => $entity->profile_cover_y1,
	'x2' => $entity->profile_cover_x2,
	'y2' => $entity->profile_cover_y2,
]);

echo elgg_view_module('aside', elgg_echo('profile_cover:crop:title'), $crop);

// footer
$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('profile_cover:crop:submit'),
]);

elgg_set_form_footer($footer);
