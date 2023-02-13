<?php

use Illuminate\Support\Facades\Config;


define('PAGINATION_COUNT', 15);



//function uploadVideo($folder, $video)
//{
//    $video->store('/', $folder);
//    $filename = $video->hashName();
//    $path = 'video/' . $folder . '/' . $filename;
//    return $path;
//}
function uploadImage($folder,$image){
    $image->store('/', $folder);
    $filename = $image->hashName();
    // \Intervention\Image\facades\Image::make($filename)->resize('300', '162')->save($thumpPathNew , 100);
    //$path = 'images/'.$folder.'/'.$filename;
    return  $filename;
}


function setActive($array, $class = "active")
{
    if (!empty($array)) {
        $seg_array = [];
        foreach ($array as $key => $url) {
            if (Request::segment($key + 1) == $url) {
                $seg_array[] = $url;
            }
        }
        if (count($seg_array) == count(Request::segments())) {
            if (isset($seg_array[0])) {
                return $class;
            }
        }
    }

}

function gender(){
    $array=['Male','Female'
    ];
    return $array;
}
