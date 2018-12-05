<?php

elgg_gatekeeper();

$guid = elgg_extract('guid', $vars);
$entity = get_entity($guid);
if (empty($entity) || !$entity->canEdit()) {
	register_error(elgg_echo('limited_access'));
	forward(REFERER);
}

elgg_set_page_owner_guid($entity->getGUID());

elgg_push_context('settings');

// build page components
$title = elgg_echo('profile_cover:edit:title');

$content = elgg_view('profile_cover/edit', [
	'entity' => $entity,
]);

// build page
$body = elgg_view_layout('one_sidebar', [
	'title' => $title,
	'content' => $content,
]);

// draw page
echo elgg_view_page($title, $body);

elgg_pop_context();
