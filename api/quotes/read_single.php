<?php

$database = new Database();
$db = $database->connect();

$quote = new quote($db);

$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

$quote->read_single();

$quote_arr = array(
    'id' => $quote->id,
    'quote'=>$quote->quote,
    'author'=>$quote->author,
    'category'=>$quote->category
);

if($quote->id !== null) {
    echo(json_encode($quote_arr));
    } 
    else {
        echo json_encode(
            array('message' => 'quoteId Not Found')
        );
    }


exit();
?>