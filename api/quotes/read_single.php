<?php

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

$quote->id = isset($_GET['id']) ? $_GET['id'] : die();
$quote->categoryId = isset($_GET['categoryid']) ? $_GET['categoryId'] : die();

$result = $quote->categoryIdQuotes();

$num = $result->rowCount();

if($num > 0) {
    $quote_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array( 
            
            'quote' => html_entity_decode($quote),
            'author' => $author,
            'id' => $id,
            'category' => $category
        
        );
        array_push($quote_arr, $quote_item); 
    }
    print_r(json_encode($quote_arr));   
} else {
    echo json_encode(
        array('message' => 'No quotes found')
    );
}

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
            array('message' => 'No Quotes Found')
        );
    }


exit();
?>