<?php
require_once '../../function/isValid.php';

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

//check if quote exists
$quoteExists = isValid($data->id, $quote);


//update quote
if($quoteExists) {
   echo json_encode(
        array('id' => $data->id,
                'quote' => $data->quote,
                'authorId' => $data->authorId,
                'categoryId' => $data->categoryId    
        )
    );
} elseif (!$quoteExists) {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}
exit();
?>