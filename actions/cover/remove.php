<?php

$guid = (int) get_input('guid');
if (empty($guid)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$entity = get_entity($guid);
if (empty($entity) || !$entity->canEdit()) {
	return elgg_error_response(elgg_echo('actionunauthorized'));
}

if (!$entity->hasIcon('master', 'profile_cover')) {
	return elgg_error_response(elgg_echo('profile_cover:action:error:no_icon'));
}

$entity->deleteIcon('profile_cover');

return elgg_ok_response('', elgg_echo('profile_cover:action:remove:success'));
