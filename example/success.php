<?php

require '../instagram.class.php';

// Setup class
$instagram = new Instagram(array(
  'apiKey'      => '08dc3c1f103c4b9693aab4c81a4d9868',
  'apiSecret'   => 'c93445ca19034311950484d5ad744f7e',
  'apiCallback' => 'http://vps.mazharulanwar.com/pantyshots/example/success.php' // must point to success.php
));

// Receive OAuth code parameter
$code = $_GET['code'];

// Check whether the user has granted access
if (true === isset($code)) {

  // Receive OAuth token object
  $data = $instagram->getOAuthToken($code);
  echo 'Your username is: '.$data->user->username;

  // Store user access token
  $instagram->setAccessToken($data);

  // Now you can call all authenticated user methods
  // Get all user likes
  $likes = $instagram->getUserLikes();

  // Display all user likes
  foreach ($likes->data as $entry) {
    echo "<img src=\"{$entry->images->thumbnail->url}\">";
  }

} else {

  // Check whether an error occurred
  if (true === isset($_GET['error'])) {
    echo 'An error occurred: '.$_GET['error_description'];
  }

}

echo "<br/>";
$tags = $instagram->searchTags('panty');

var_dump($tags);

  $i = 0;
  // Display all user likes
  foreach ($tags->data as $entry1) {
    
    if($i<=500){
      #echo "<img src=\"{$entry1->name}\">";
      $tag = $entry1->name;

      // Get recently tagged media
      $media = $instagram->getTagMedia($tag);

          // Display results
      foreach ($media->data as $data) {
        echo "<div>";
        echo "<a href=\"{$data->link}\"><img src=\"{$data->images->thumbnail->url}\"></a>";
        echo "<span> Image By:".$data->user->username." tag: ".$tag."</span>";
        echo "</div>";
      }
    }else{
      exit;
    }
    $i++;
  }


?>