<?php


//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$data->quote = htmlspecialchars(strip_tags($data->quote));
$data->categoryId = htmlspecialchars(strip_tags($data->categoryId));
$data->authorId = htmlspecialchars(strip_tags($data->authorId));

//Check for required parameters
if(isset($data->id) && !empty($data->id) && isset($data->quote) && !empty($data->quote) && isset($data->categoryId) && !empty($data->categoryId) && isset($data->authorId) && !empty($data->authorId)) {
    $result = $quote->create();
    echo json_encode($result);
}else{
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}

exit();

?>