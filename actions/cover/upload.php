<?php

$guid = (int) get_input('guid');
$images = elgg_get_uploaded_files('cover_image');

if (empty($guid) || empty($images)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$entity = get_entity($guid);
if (empty($entity) || !$entity->canEdit()) {
	return elgg_error_response(elgg_echo('actionunauthorized'));
}

/* @var $image \Symfony\Component\HttpFoundation\File\UploadedFile */
foreach ($images as $image) {
	if (!$image->isValid()) {
		return elgg_error_response($image->getErrorMessage());
	}
}

if ($entity->saveIconFromUploadedFile('cover_image', 'profile_cover')) {
	return elgg_ok_response('', elgg_echo('profile_cover:action:upload:success'));
}

return elgg_error_response(elgg_echo('profile_cover:action:upload:error'));
