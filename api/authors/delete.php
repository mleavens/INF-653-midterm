<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

//instantiate author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$author->id = $data->id;

//Update post
if($author->delete()){
    echo json_encode(
        array('message' => 'Author deleted')
    );
} else {
    echo json_encode(
        array('message'=>'Author not deleted')
    );
}

exit();