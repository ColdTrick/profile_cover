<?php

$user = elgg_extract('entity', $vars);
if (!$user instanceof ElggUser) {
	return;
}

if (!$user->hasIcon('master', 'profile_cover')) {
	// no uploaded cover image
	return;
}

$remove_button = elgg_view('output/url', [
	'icon' => 'delete',
	'text' => elgg_echo('remove'),
	'href' => elgg_generate_action_url('cover/remove', [
		'guid' => $user->guid,
	]),
	'data-confirm' => elgg_echo('profile_cover:remove:current:remove:confirm'),
]);

echo elgg_view_module('info', elgg_echo('profile_cover:remove:current'), elgg_view('output/img', [
	'src' => $user->getIconURL([
		'size' => 'cover',
		'type' => 'profile_cover',
	]),
	'alt' => $user->getDisplayName(),
	'title' => $user->getDisplayName(),
]), [
	'class' => 'profile-cover-remove',
	'menu' => $remove_button,
]);
