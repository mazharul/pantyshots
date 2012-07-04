<?php

require '../instagram.class.php';

// Initialize class for public requests
$instagram = new Instagram('08dc3c1f103c4b9693aab4c81a4d9868');

$tags = $instagram->searchTags('panty');

  $i = 0;
  // Display all user likes
  foreach ($tags->data as $entry1) {
    
    if($i<=5){
      #echo "<img src=\"{$entry1->name}\">";
      $tag = $entry1->name;
        
        if(validTag($tag)){
                  // Get recently tagged media
          $media = $instagram->getTagMedia($tag);
          $dataToPrint['data1'] = getData($media, $tag);
          $dataToPrint['data2']  = getDataByP($tag, $media->pagination->next_max_tag_id);

        }

    }else{
      exit;
    }
    $i++;
  }


 foreach($dataToPrint['data1'] as $pr){
 	echo $pr;
 }

 foreach($dataToPrint['data2'] as $pr2){
 	echo $pr2;
 }


  function validTag($tn){

    $accept = array("panty");
    if(in_array($tn, $accept)){
      return true;
    }

    return false;

  }

  function getData($media, $tag){
      $i = 0;
      $d = array();
      // Display results
      foreach ($media->data as $data) {
        //echo "<div>";
        $d[$i] = "<a href=\"{$data->link}\"><img src=\"{$data->images->thumbnail->url}\"></a>";
       // echo "<span> Image By:".$data->user->username." tag: ".$tag."</span>";
        //echo "</div>";
        $i++;
      }

      return $d;
  }

  function getDataByP($tag, $max, $p){
	    global $instagram;
	    $e = array();

	    if($p <= 10 ){

	    	$d = $instagram->getTagMediaByP($tag, $max);
		    $j = 0;
		    foreach ($d->data as $dat) {
		        //echo "<div>";
		        $e[$j] = "<a href=\"{$dat->link}\"><img src=\"{$dat->images->thumbnail->url}\"></a>";
		        //echo "<span> Image By:".$dat->user->username." tag: ".$tag."</span>";
		        //echo "</div>";
		        $j++;
		    }
		    //for($i=0; $i<=2; $i++){
		    getDataByP($tag, $d->pagination->next_max_tag_id);
		    //}
		    
		}
	    
	    return $e;
   }

?>