# Profile cover

![Elgg 3.0](https://img.shields.io/badge/Elgg-3.0-green.svg)
[![Build Status](https://scrutinizer-ci.com/g/ColdTrick/profile_cover/badges/build.png?b=master)](https://scrutinizer-ci.com/g/ColdTrick/profile_cover/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ColdTrick/profile_cover/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ColdTrick/profile_cover/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/coldtrick/profile_cover/v/stable.svg)](https://packagist.org/packages/coldtrick/profile_cover)
[![License](https://poser.pugx.org/coldtrick/profile_cover/license.svg)](https://packagist.org/packages/coldtrick/profile_cover)

Add a cover image to you profile page

The width and height can be set in the plugin settings (default: 1600px x 300px)

## Note

This plugin doesn't provide a means to show the actual profile cover image. It offers the option to upload/remove/crop the image.

To display the image user:

```php

$user = elgg_get_logged_in_user_entity();
if ($user->hasIcon('cover', 'profile_cover')) {
	$cover_image_url = $user->getIconURL([
		'type' => 'profile_cover',
		'size' => 'cover',
	]);
	
	// do something with $cover_image_url
}

```