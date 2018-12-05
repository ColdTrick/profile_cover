<?php

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof ElggEntity)) {
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

echo elgg_view_module('aside', elgg_echo('profile_cover:remove:current'), elgg_view('output/img', [
	'src' => $entity->getIconURL([
		'size' => 'cover',
		'type' => 'profile_cover',
	]),
	'alt' => $entity->getDisplayName(),
]), [
	'class' => 'profile-cover-remove',
]);

// footer
$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('remove'),
	'class' => 'elgg-button-delete',
	'data-confirm' => elgg_echo('profile_cover:remove:current:remove:confirm'),
]);

elgg_set_form_footer($footer);
