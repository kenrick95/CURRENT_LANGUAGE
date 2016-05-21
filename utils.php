<?php
require_once("config.php");
function http_request($url, $post = "", $header = "", &$ch = null) {
    global $config;
    if ( !$ch ) {
      $ch = curl_init();
    }

    //Change the user agent below suitably
    if (!empty($post)) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, array( $header ) );
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt($ch, CURLOPT_USERAGENT, $config['utils_userAgent']);
    curl_setopt($ch, CURLOPT_URL, ($url));
    curl_setopt($ch, CURLOPT_ENCODING, "UTF-8" );
    curl_setopt($ch, CURLOPT_HEADER, 0 );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    curl_setopt($ch, CURLOPT_USERPWD, $config['gh_api_username'] . ":" . $config['gh_api_password']);
    
    curl_setopt($ch, CURLOPT_COOKIEFILE, $config['utils_cookieFile']);
    curl_setopt($ch, CURLOPT_COOKIEJAR,  $config['utils_cookieFile']);
    if (!empty($post)) {
      curl_setopt($ch, CURLOPT_POST, true );
      if (is_array($post)) {
          $post = http_build_query($post);
      }
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    // UNCOMMENT TO DEBUG TO output.tmp
    // curl_setopt($ch, CURLOPT_VERBOSE, true); // Display communication with server
    // $fp = fopen("output.tmp", "w");
    // curl_setopt($ch, CURLOPT_STDERR, $fp); // Display communication with server

    $return = curl_exec($ch);
    if (!$return) {
        throw new Exception("Error getting data from server ($url): " . curl_error($ch));
    }

    curl_close($ch);

    return $return;
}