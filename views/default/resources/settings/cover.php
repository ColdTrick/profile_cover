<?php

use Elgg\EntityPermissionsException;

$username = elgg_extract('username', $vars);
$user = get_user_by_username($username);
if (empty($user) || !$user->canEdit()) {
	throw new EntityPermissionsException();
}

elgg_set_page_owner_guid($user->guid);

elgg_push_context('settings');

elgg_push_breadcrumb($user->getDisplayName(), $user->getURL());
elgg_push_breadcrumb(elgg_echo('settings'), elgg_generate_url('settings:account', ['username' => $user->username]));

// build page components
$title = elgg_echo('profile_cover:edit:title');

$content = elgg_view_form('cover/upload', [], [
	'entity' => $user,
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
