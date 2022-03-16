<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$author->id = $data->id;

$author->author = $data->author;
$author->id = $data->id;

//Update post
if($author->update()){
    echo json_encode(
        array('message' => 'Post updated')
    );
} else {
    echo json_encode(
        array('message'=>'Post not updated')
    );
}