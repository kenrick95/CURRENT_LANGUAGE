<?php
require_once("utils.php");

$events_raw = http_request("https://api.github.com/users/" . $config['gh_api_username'] . "/events");
$events = json_decode($events_raw, true);
$latest_event = $events[0];

foreach ($events as $event) {
    if (strcasecmp($event['type'], "PushEvent") === 0) {
        $latest_event = $event;
        break;
    }
}

$repo_raw = http_request($event['repo']['url']);
$repo = json_decode($repo_raw, true);

$put_contents = file_put_contents("CURRENT_LANGUAGE.txt", $repo['language'], LOCK_EX);
if ($put_contents === FALSE) {
    header("HTTP/1.0 500 Internal Server Error", true, 500);
    echo "Failure on saving file";
} else {
    echo $repo['language'];
}