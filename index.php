<?php
$p = 20;
$fwl = 'thumb2.jpg';
$nfwl = 'thumb2_'.$p.'_percent.jpg';
image_custome_resize($p, $fwl, $nfwl);
function image_custome_resize($percent, $filename_with_location, $newfilename_with_location) {

    $percent = $percent/100;
    list($original_width, $original_height) = getimagesize($filename_with_location);
    $new_width = $original_width * $percent;
    $new_height = $original_height * $percent;

    $thumb = imagecreatetruecolor($new_width, $new_height);
    $source = imagecreatefromjpeg($filename_with_location);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
    imagejpeg($thumb, $newfilename_with_location);

  }
?>