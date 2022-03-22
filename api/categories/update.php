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

//check if quote exists
$categoryExists = isValid($data->id, $category);


//update category
if($categoryExists) {
   echo json_encode(
        array('id' => $category->id,
            'category' => $category->category    
        )
    );
} elseif (!$categoryExists) {
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}
?>