<?php

$database = new Database();
$db = $database->connect();

//instantiate author object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$quote->id = $data->id;

//See if quote exists
$quoteExists = isValid($data->id, $quote);

//Delete post
if($quote->id !== null) {
    echo json_encode(
        array('id' =>  $quote->id));
} else {
    echo json_encode(
        array('message' => 'No Quotes Found') 
    );
}


exit();
?>
