<?php

require '../instagram.class.php';

// Initialize class for public requests
$instagram = new Instagram('08dc3c1f103c4b9693aab4c81a4d9868');

$tags = $instagram->searchTags('panty');

  $i = 0;
  // Display all user likes
  foreach ($tags->data as $entry1) {
    
    if($i<=500){
      #echo "<img src=\"{$entry1->name}\">";
      $tag = $entry1->name;
        
        if(validTag($tag)){
                  // Get recently tagged media
          $media = $instagram->getTagMedia($tag);
          getData($media, $tag);
          getDataByP($tag, $media->pagination->next_max_tag_id);

        }else{
          continue;
        }

    }else{
      exit;
    }
    $i++;
  }


  function validTag($tn){

    $accept = array("panty", "pantys", "pantyshots");
    if(in_array($tn, $accept)){
      return true;
    }

    return false;

  }

  function getData($media, $tag){
      // Display results
      foreach ($media->data as $data) {
        //echo "<div>";
        echo "<a href=\"{$data->link}\"><img src=\"{$data->images->thumbnail->url}\"></a>";
       // echo "<span> Image By:".$data->user->username." tag: ".$tag."</span>";
        //echo "</div>";
      }
  }

  function getDataByP($tag, $max){
    global $instagram;
    $d = $instagram->getTagMediaByP($tag, $max);
    foreach ($d->data as $dat) {
        //echo "<div>";
        echo "<a href=\"{$dat->link}\"><img src=\"{$dat->images->thumbnail->url}\"></a>";
        //echo "<span> Image By:".$dat->user->username." tag: ".$tag."</span>";
        //echo "</div>";
      }
    for($i=0; $i<=5; $i++){
      getDataByP($tag, $d->pagination->next_max_tag_id);
    }
  }

?>