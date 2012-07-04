<?php

require '../instagram.class.php';

// Initialize class for public requests
$instagram = new Instagram('08dc3c1f103c4b9693aab4c81a4d9868');

$tag = 'panty';

// Get recently tagged media
$media = $instagram->getTagMedia($tag);

// Display results
foreach ($media->data as $data) {
  echo "<img src=\"{$data->images->thumbnail->url}\">";
}

?>