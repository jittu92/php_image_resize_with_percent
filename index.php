<?php
$p = 50;  // put the value 1-99 
$fwl = 'download.png'; // image name with proper location
$nfwl = 'download_'.$p.'_percent.jpg'; // destination image name with proper location
$files_content = explode('.',$fwl);
// print_r($files_content);

// image_custome_resize($p, $fwl, $nfwl, end($files_content)); // call this function if you want to resize image based on percentage (%)
// image_custome_resize_from_center($p, $fwl, $nfwl, end($files_content)); // call this function if you want to resize image based on percentage (%) & cropfrom center

function image_custome_resize($percent, $filename_with_location, $newfilename_with_location, $image_extension) {
    $percent = $percent/100;
    list($original_width, $original_height) = getimagesize($filename_with_location);
    $new_width = $original_width * $percent;
    $new_height = $original_height * $percent;
    if($image_extension == 'jpg'){
        $thumb = imagecreatetruecolor($new_width, $new_height);
        $source = imagecreatefromjpeg($filename_with_location);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        imagejpeg($thumb, $newfilename_with_location);    
    }
    else if($image_extension == 'png'){
        $thumb = imagecreatetruecolor($new_width, $new_height);
        $source = imagecreatefrompng($filename_with_location);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);
        imagepng($thumb, $newfilename_with_location);    
    }
}
function image_custome_resize_from_center($percent, $filename_with_location, $newfilename_with_location, $image_extension) {

    $percent = $percent/100;
    list($original_width, $original_height) = getimagesize($filename_with_location);
    $new_width = $original_width * $percent;
    $new_height = $original_height * $percent;
    
    $s_x = ($original_width-$new_width)/2;
    $s_y = ($original_height-$new_height)/2;

    if($image_extension == 'jpg'){
        $source = imagecreatefromjpeg($filename_with_location);
        $thumb = imagecrop($source, ['x' => $s_x, 'y' => $s_y, 'width' => $new_width, 'height' => $new_height]);
        imagejpeg($thumb, $newfilename_with_location);
    }
    else if($image_extension == 'png'){
        $source = imagecreatefrompng($filename_with_location);
        $thumb = imagecrop($source, ['x' => $s_x, 'y' => $s_y, 'width' => $new_width, 'height' => $new_height]);
        imagepng($thumb, $newfilename_with_location);
    }
    
}
?>