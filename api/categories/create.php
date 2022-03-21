<?php

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$category->category = $data->category;
$category->id = $data->id;

//create post
if($category->id !== null) {
    echo json_encode(
        array('id' => $db->lastInsertId(),
            'category' => $category->category));
} else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
    );
}
exit();
?>