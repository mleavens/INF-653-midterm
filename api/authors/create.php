<?php


//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$author->author = $data->author;
$author->id = $data->id;

//create post
if($author->id !== null) {
    echo json_encode(
        array('id' =>  $author->id,
            'author' => $author->id));
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
    );
}


exit();

?>