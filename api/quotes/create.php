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

$isValidAuthor = $isValid($quote->authorId, $quote);

if(!$isValidAuthor){
    echo json_encode(array('message' => 'authorId Not Found'));
}

//create post
$result = $quote->create();
echo json_encode($result);



exit();

?>