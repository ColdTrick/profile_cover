<?php
/**
 * Helper view for the edit cover page
 *
 * @uses \ElggUser $vars['entity'] the user to edit
 */

$user = elgg_extract('entity', $vars);
if (!($user instanceof ElggUser)) {
	return;
}

echo elgg_view('output/longtext', [
	'value' => elgg_echo('profile_cover:edit:description'),
	'class' => 'mbl',
]);

// edit/upload form
echo elgg_view_form('cover/upload', [
	'enctype' => 'multipart/form-data',
], [
	'entity' => $user,
]);

// remove form
echo elgg_view_form('cover/remove', [], [
	'entity' => $user,
]);

// crop form
echo elgg_view_form('cover/crop', [], [
	'entity' => $user,
]);
