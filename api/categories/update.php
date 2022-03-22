<?php

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

if(isset($data->id) && !empty($data->id) && isset($data->category) && !empty($data->category) ){
    $result = $category->update();
    echo json_encode($result);
}else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}

// //Set ID to update
// $category->id = $data->id;

// $category->category = $data->category;
// $category->id = $data->id;

// //check if quote exists
// $categoryExists = isValid($category->id, $category);


// //update category
// $result = $category->update();
// echo json_encode($result);
?>