<?php


//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

if(isset($data->id) && !empty($data->id) && isset($data->author) && !empty($data->author) ){
    $result = $author->create();
    echo json_encode($result);
}else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}

//Set ID to update
// $author->id = $data->id;

// $author->author = $data->author;
// $author->id = $data->id;

// //check if author exists
// $authorExists = isValid($author->id, $author);


// //Update post
// $result = $author->update();
// echo json_encode($result);

// ?>