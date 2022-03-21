<?php


include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$category->category = $data->category;
$category->id = $data->id;

//create post\
if($category->create()){
    echo json_encode(
        array('message' => 'Category created')
    );
} else {
    echo json_encode(
        array('message'=>'Category not created')
    );
}

exit();
?>