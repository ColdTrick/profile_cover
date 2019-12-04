<?php

use Elgg\EntityPermissionsException;

$guid = elgg_extract('guid', $vars);
$entity = get_entity($guid);
if (!$entity instanceof \ElggEntity || !$entity->canEdit()) {
	throw new EntityPermissionsException();
}

elgg_set_page_owner_guid($entity->guid);

// build page components
$title = elgg_echo('profile_cover:edit:title');

$content = elgg_view_form('cover/upload', [], [
	'entity' => $entity,
]);

// build page
$body = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'filter_id' => 'cover',
	'filter_value' => 'cover',
]);

// draw page
echo elgg_view_page($title, $body);

elgg_pop_context();
