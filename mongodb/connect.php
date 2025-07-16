<?php 

$serverApi = new ServerApi(ServerApi::V1);
$client = new MongoDB\Client(
    'mongodb+srv://daothanhnhan:tuan3110@cluster0.8r0zg.mongodb.net/caosim?retryWrites=true&w=majority', [], ['serverApi' => $serverApi]);

$db = $client->test;

?>