<?php

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$quote->quote= $data->quote;
$quote->id = $data->id;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;

//create post
if($quote->create()){
    echo json_encode(
        array('message' => 'Quote created')
    );
} else {
    echo json_encode(
        array('message'=>'Quote not created')
    );
}