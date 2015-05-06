<?php

// Get base file Path

function base_path($path = null){
  if($path == null)
    return realpath($_SERVER["DOCUMENT_ROOT"]).'/';
  else
    return realpath($_SERVER["DOCUMENT_ROOT"]).'/'.$path;
}

//Get website base url

function base_url($url = null){
  $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
  if($url == null)
    return $http . '://' . $_SERVER['HTTP_HOST'] . '/';
  else
    return $http . '://' . $_SERVER['HTTP_HOST'] . '/' . $url;
}

//Fetch array of all the doc.md files in documentaion folder

function get_links($docs_path){
    $docs_files = array_diff(scandir(base_path('docs/'.$docs_path)), ['.', '..']) ;
    foreach( $docs_files as $key => $file ){
      $filename = str_replace(".md", "", (string)$file);
      $links[] = array(
        'href' => $docs_path.'/'.$filename,
        'title' => str_replace('_', ' ', $filename),
      );
    }

    foreach($links as $key => $value){
      if($value['title'] == 'index'){
        $links[$key]['title'] = 'Home';
        $links = move_to_top($links, $key);

      }
    }
    return $links;
}

function move_to_top($array, $key) {
    $temp = array($key => $array[$key]);
    unset($array[$key]);
    return $temp + $array;
}

?>
