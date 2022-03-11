<?php

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

//instantiate author object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$category->id = $data->id;

//Update post
if($category->delete()){
    echo json_encode(
        array('message' => 'Category deleted')
    );
} else {
    echo json_encode(
        array('message'=>'Category not deleted')
    );
}