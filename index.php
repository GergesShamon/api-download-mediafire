<?php

$_msg;
$_succeeded;
$result;


$support_domain = 'www.mediafire.com';


if(isset($_GET['url']) ) {
 $url = isset($_GET['url']) 
  $host = $matches[1];

  if($host != $support_domain) {

    $_msg = 'Please input a valid mediafire url.';

      $_succeeded = false;

  }else {
$_succeeded = true; 
preg_match('@^(?:http.?://)?([^/]+)@i', $url, $matches);
$result = file_get_contents($url, false, stream_context_create(['socket' => ['bindto' => '0:0']])); // force IPv4

preg_match('/aria-label="Download file"\n.+href="(.*)"/', $result, $matches);

$result = urldecode($matches[1]);

}

}
else {
      $_msg = 'Please input a valid mediafire url.';

      $_succeeded = false;

}




$output[message] =  $_succeeded;
$output[url] = $result;
$output[succeeded] = $_msg;


echo json_encode($output);

?>
