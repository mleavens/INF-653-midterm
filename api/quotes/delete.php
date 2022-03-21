<?php

$database = new Database();
$db = $database->connect();

//instantiate author object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$quote->id = $data->id;

//Update post
if($quote->id !== null) {
    $result = $quote->delete();
    echo json_encode($result);

} 
else {
    echo json_encode(
        array('message' => 'No Quotes Found') 
    );
}


exit();
?>
