<?php
require_once '../../function/isValid.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

if(isset($data->id) && !empty($data->id) && isset($data->quote) && !empty($data->quote) && isset($data->category) && !empty($data->category) && isset($data->author) && !empty($data->author) ){
    $result = $quote->create();
    echo json_encode($result);
}else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}


// //Set ID to update
// $quote->id = $data->id;

// $quote->quote = $data->quote;
// $quote->id = $data->id;
// $quote->authorId = $data->authorId;
// $quote->categoryId = $data->categoryId;

// //check if quote exists
// $quoteExists = isValid($data->id, $quote);



// //update quote
// $result = $quote->update();
// echo json_encode($result);
?>