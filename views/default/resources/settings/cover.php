<?php

$user = elgg_get_page_owner_entity();

elgg_push_breadcrumb($user->getDisplayName(), $user->getURL());
elgg_push_breadcrumb(elgg_echo('settings'), elgg_generate_url('settings:account', ['username' => $user->username]));

echo elgg_view_page(elgg_echo('profile_cover:edit:title'), [
	'content' => elgg_view_form('cover/upload', [], [
		'entity' => $user,
	]),
	'filter_id' => 'cover',
	'filter_value' => 'cover',
	'show_owner_block_menu' => false,
]);
