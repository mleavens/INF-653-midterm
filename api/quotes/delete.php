<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

//instantiate author object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$quote->id = $data->id;

//Update post
if($quote->delete()){
    echo json_encode(
        array('message' => 'Quote deleted')
    );
} else {
    echo json_encode(
        array('message'=>'Quote not deleted')
    );
}

exit();
?>
