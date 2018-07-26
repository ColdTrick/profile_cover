<?php

use Elgg\EntityPermissionsException;

$username = elgg_extract('username', $vars);
$user = get_user_by_username($username);
if (empty($user) || !$user->canEdit()) {
	throw new EntityPermissionsException();
}

elgg_set_page_owner_guid($user->guid);

elgg_push_context('settings');

// build page components
$title = elgg_echo('profile_cover:edit:title');

$content = elgg_view('profile_cover/edit', [
	'entity' => $user,
]);

// build page
$body = elgg_view_layout('one_sidebar', [
	'title' => $title,
	'content' => $content,
]);

// draw page
echo elgg_view_page($title, $body);

elgg_pop_context();
