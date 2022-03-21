<?php

$database = new Database();
$db = $database->connect();

//instantiate author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to delete
$author->id = $data->id;


//Delete post
if($author->id !== null) {
    echo json_encode(
        array('id' =>  $author->id));
} 
else {
    echo json_encode(
        array('message' => 'authorId Not Found') 
    );
}
exit();