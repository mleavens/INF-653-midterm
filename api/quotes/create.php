<?php
require_once '../../function/isValid.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$quote->quote= $data->quote;
$quote->id = $data->id;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;

$isValid = isValid($quote->id, $quote);

//create post
if(!$isValid){
    echo json_encode(array('message' => 'Missing Required Parameters'));
}

$result = $quote->create();
echo json_encode($result);





exit();

?>