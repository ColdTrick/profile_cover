<?php

$guid = (int) get_input('guid');
if (empty($guid)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$entity = get_entity($guid);
if (!$entity instanceof ElggEntity || !$entity->canEdit()) {
	return elgg_error_response(elgg_echo('actionunauthorized'));
}

// remove the cover icon?
if ((bool) get_input('cover_remove')) {
	$entity->deleteIcon('profile_cover');
	
	return elgg_ok_response('', elgg_echo('profile_cover:action:remove:success'), $entity->getURL());
}

// save the new icon
if (!$entity->saveIconFromUploadedFile('cover', 'profile_cover')) {
	return elgg_error_response(elgg_echo('profile_cover:action:upload:error'));
}

return elgg_ok_response('', elgg_echo('profile_cover:action:upload:success'), $entity->getURL());
