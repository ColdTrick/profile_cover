<?php

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof ElggEntity) {
	return;
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'guid',
	'value' => $entity->guid,
]);

echo elgg_view('output/longtext', [
	'value' => elgg_echo('profile_cover:edit:description'),
]);

$width = (int) elgg_get_plugin_setting('width', 'profile_cover');
$height = (int) elgg_get_plugin_setting('height', 'profile_cover');

echo elgg_view('output/longtext', [
	'value' => elgg_echo('profile_cover:upload:cover_image:help', [$width, $height]),
	'class' => ['elgg-subtext', 'mts'],
]);

echo elgg_view('entity/edit/icon', [
	'entity' => $entity,
	'icon_type' => 'profile_cover',
	'thumb_size' => 'cover',
	'name' => 'cover',
]);

// footer
$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);

elgg_set_form_footer($footer);
