<?php


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

//create post
$result = $quote->create();
if($quote->authorId !== null && $quote->categoryId !== null && $quote->id !== null){
    echo json_encode($result);
}elseif($quote->authorId === null){
    echo json_encode(
        array('message' => 'authorId Not Found'));
}else if($quote->categoryId === null){
    echo json_encode(
        array('message' => 'categoryId Not Found'));
}
$result = $quote->create();
echo json_encode($result);

exit();

?>