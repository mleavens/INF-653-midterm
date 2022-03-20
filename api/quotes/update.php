<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$quote->id = $data->id;

$quote->quote = $data->quote;
$quote->id = $data->id;
$quote->author = $data->author;
$quote->category = $data->category;


//update post
if($quote->update()){
    echo json_encode(
        array('message' => 'Post updated')
    );
} else {
    echo json_encode(
        array('message'=>'Post not updated')
    );
}