<?php
$data = [
    
];

array_push($data, array("event_id" => "25-12-2000", "game_id" => "csgo", "result" => "test1"));
array_push($data, array("event_id" => "25-12-2001", "game_id" => "acc", "result" => "test2"));
array_push($data, array("event_id" => "25-12-2002", "game_id" => "acc", "result" => "test3"));
array_push($data, array("event_id" => "25-12-2000", "game_id" => "csgo", "result" => "test4"));
array_push($data, array("event_id" => "25-12-2002", "game_id" => "lol", "result" => "test5"));
array_push($data, array("event_id" => "25-12-2003", "game_id" => "lol", "result" => "test6"));
array_push($data, array("event_id" => "25-12-2001", "game_id" => "acc", "result" => "test7"));
array_push($data, array("event_id" => "25-12-2002", "game_id" => "csgo", "result" => "test8"));
array_push($data, array("event_id" => "25-12-2002", "game_id" => "lol", "result" => "test9"));

$outputArray = [];

$events = [];

foreach ($data as $row) {
    // gets all events
    array_push($events, $row["event_id"]);
}
sort($events);
$events = array_unique($events);

foreach ($events as $event) {
    // make all events in the outputArray
    $outputArray[$event] = array();
}

// add all game_id to the events
foreach ($data as $row) {
    $outputArray[$row["event_id"]][$row["game_id"]] = array();
}

// add all result to the game_id
foreach ($data as $row) {
    array_push($outputArray[$row["event_id"]][$row["game_id"]], $row["result"]);
}

print_r("<pre>");
print_r($outputArray);
print_r("</pre>");
