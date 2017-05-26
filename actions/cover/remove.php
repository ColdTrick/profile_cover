<?php

$guid = (int) get_input('guid');
if (empty($guid)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$user = get_user($guid);
if (empty($user) || !$user->canEdit()) {
	return elgg_error_response(elgg_echo('actionunauthorized'));
}

if (!$user->hasIcon('master', 'profile_cover')) {
	return elgg_error_response(elgg_echo('profile_cover:action:error:no_icon'));
}

$user->deleteIcon('profile_cover');

return elgg_ok_response('', elgg_echo('profile_cover:action:remove:success'));
