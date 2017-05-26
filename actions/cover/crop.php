<?php

$guid = (int) get_input('guid');
$crop = (array) get_input('crop');
if (empty($guid) || empty($crop)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$user = get_user($guid);
if (empty($user) || !$user->canEdit()) {
	return elgg_error_response(elgg_echo('actionunauthorized'));
}

if (!$user->hasIcon('master', 'profile_cover')) {
	return elgg_error_response(elgg_echo('profile_cover:action:error:no_icon'));
}

// crop based on master image
$master = $user->getIcon('master', 'profile_cover');

// need a flag to prevent master from being cropped
elgg_set_config('profile_cover_cropping', true);

// crop cover image
$user->saveIconFromElggFile($master, 'profile_cover', $crop);

// unset flag
elgg_set_config('profile_cover_cropping', null);

return elgg_ok_response('', elgg_echo('profile_cover:action:crop:success'));
