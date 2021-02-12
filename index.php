<?php

$url = isset($_GET['url']) ? htmlspecialchars($_GET['url']) : null;

$support_domain = 'www.mediafire.com';

if(empty($url)) {

  $_succeeded = false;

}

if($url) {

	$_succeeded = true;  preg_match('@^(?:http.?://)?([^/]+)@i', $url, $matches);

  $host = $matches[1];

  if($host != $support_domain) {

    echo 'Please input a valid mediafire url.';

    exit;

  }

}

$result = file_get_contents($url, false, stream_context_create(['socket' => ['bindto' => '0:0']])); // force IPv4

preg_match('/aria-label="Download file"\n.+href="(.*)"/', $result, $matches);

$result = urldecode($matches[1]);

$output = [];

$output[] = ['succeeded' => $_succeeded, 'url' => $result];

$output = json_encode($output);

echo $output;

?>
