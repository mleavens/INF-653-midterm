<?php

$database = new Database();
$db = $database->connect();

//instantiate author object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to Delete
$category->id = $data->id;

//Delete post
if($category->id !== null) {
    echo json_encode(
        array('id' =>  $category->id));
} 
else {
    echo json_encode(
        array('message' => 'categoryId Not Found') 
    );
}


exit();
?>