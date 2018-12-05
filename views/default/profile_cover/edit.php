<?php
/**
 * Helper view for the edit cover page
 *
 * @uses \ElggEntity $vars['entity'] the entity to edit
 */

$entity = elgg_extract('entity', $vars);
if (!($entity instanceof ElggEntity)) {
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
	'entity' => $entity,
]);

// remove form
echo elgg_view_form('cover/remove', [], [
	'entity' => $entity,
]);

// crop form
echo elgg_view_form('cover/crop', [
	'id' => 'cover-crop',
], [
	'entity' => $entity,
]);
