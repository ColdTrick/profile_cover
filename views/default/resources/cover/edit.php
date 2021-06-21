<?php

use Elgg\Exceptions\Http\EntityPermissionsException;

$guid = (int) elgg_extract('guid', $vars);
$entity = get_entity($guid);
if (!$entity instanceof \ElggEntity || !$entity->canEdit()) {
	throw new EntityPermissionsException();
}

elgg_set_page_owner_guid($entity->container_guid);
elgg_push_entity_breadcrumbs($entity);

echo elgg_view_page(elgg_echo('profile_cover:edit:title'), [
	'content' => elgg_view_form('cover/upload', [], [
		'entity' => $entity,
	]),
	'filter_id' => 'cover',
	'filter_value' => 'cover',
]);
