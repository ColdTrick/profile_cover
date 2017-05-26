<?php

$user = elgg_extract('entity', $vars);
if (!($user instanceof ElggUser)) {
	return;
}

echo elgg_view_field([
	'#type' => 'hidden',
	'name' => 'guid',
	'value' => $user->getGUID(),
]);

// Get post_max_size and upload_max_filesize
$post_max_size = elgg_get_ini_setting_in_bytes('post_max_size');
$upload_max_filesize = elgg_get_ini_setting_in_bytes('upload_max_filesize');

// Determine the correct value
$max_upload = $upload_max_filesize > $post_max_size ? $post_max_size : $upload_max_filesize;

$upload_limit = elgg_echo('profile_cover:upload_limit', [elgg_format_bytes($max_upload)]);

$width = (int) elgg_get_plugin_setting('width', 'profile_cover', 1600);
$height = (int) elgg_get_plugin_setting('height', 'profile_cover', 300);

echo elgg_view_field([
	'#type' => 'file',
	'#label' => elgg_echo('profile_cover:upload:cover_image'),
	'#help' => elgg_echo('profile_cover:upload:cover_image:help', [$width, $height, $upload_limit]),
	'name' => 'cover_image',
]);

// footer
$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('upload'),
]);

elgg_set_form_footer($footer);
