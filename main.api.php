<?php
class ApiMediafire{
public $_msg;
public $_succeeded;
public $result;
$support_domain = 'www.mediafire.com';
function get_url_download($url){
  
  preg_match('@^(?:http.?://)?([^/]+)@i', $url, $matches);
  $host = $matches[1];
  if($host != $support_domain) {

    die('Please input a valid mediafire url.');
  }else {

$result = file_get_contents($url, false, stream_context_create(['socket' => ['bindto' => '0:0']])); // force IPv4

preg_match('/aria-label="Download file"\n.+href="(.*)"/', $result, $matches);


return urldecode($matches[1]);
}
}
}


?>
