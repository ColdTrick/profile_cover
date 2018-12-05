<?php

$guid = (int) get_input('guid');
$crop = (array) get_input('crop');
if (empty($guid) || empty($crop)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$entity = get_entity($guid);
if (empty($entity) || !$entity->canEdit()) {
	return elgg_error_response(elgg_echo('actionunauthorized'));
}

if (!$entity->hasIcon('master', 'profile_cover')) {
	return elgg_error_response(elgg_echo('profile_cover:action:error:no_icon'));
}

// crop based on master image
$master = $entity->getIcon('master', 'profile_cover');

// need a flag to prevent master from being cropped
elgg_set_config('profile_cover_cropping', true);

// crop cover image
$entity->saveIconFromElggFile($master, 'profile_cover', $crop);

// unset flag
elgg_set_config('profile_cover_cropping', null);

return elgg_ok_response('', elgg_echo('profile_cover:action:crop:success'));
