<?php

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$category = new Category($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//check for required parameters
if(isset($data->category) && !empty($data->category)){
    $result = $category->create();
    echo json_encode($result);
}else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}

exit();
?>