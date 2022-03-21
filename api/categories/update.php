<?php

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$category->id = $data->id;

$category->category = $data->category;
$category->id = $data->id;

//Update post
if($category->id !== null) {
    echo json_encode(
        array('id' => $category->id,
            'category' => $category->category));
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
    );
}
exit();
?>