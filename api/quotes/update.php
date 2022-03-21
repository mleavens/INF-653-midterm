<?php

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Set ID to update
$quote->id = $data->id;

$quote->quote = $data->quote;
$quote->id = $data->id;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;


//update quote
if($quote->update()) {
    echo json_encode(
        array('id' => $quote->id,
                'quote' => $quote->quote,
                'authorId' => $quote->authorId,
                'categoryId' => $quote->categoryId    
        )
    );
} else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
exit();
?>