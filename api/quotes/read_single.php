<?php

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

$quote->read_single();

$quote_arr = array(
    'id' => $quote->id,
    'quote'=>$quote->quote,
    'authorId'=>$quote->authorId,
    'categoryId'=>$quote->categoryId
);

if($quote->id !== null) {
    echo(json_encode($quote_arr));
} else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }


exit();
?>