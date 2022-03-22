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
$result = $author->create();

$authorExists = isValid($author->id, $author);

if($result) {
    echo json_encode($result);
} elseif (!$authorExists) {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
    );
};


exit();

?>