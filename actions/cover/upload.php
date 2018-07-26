<?php

$guid = (int) get_input('guid');
$image = elgg_get_uploaded_file('cover_image');

if (empty($guid) || empty($image)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$user = get_user($guid);
if (empty($user) || !$user->canEdit()) {
	return elgg_error_response(elgg_echo('actionunauthorized'));
}

if ($user->saveIconFromUploadedFile('cover_image', 'profile_cover')) {
	return elgg_ok_response('', elgg_echo('profile_cover:action:upload:success'));
}

return elgg_error_response(elgg_echo('profile_cover:action:upload:error'));
