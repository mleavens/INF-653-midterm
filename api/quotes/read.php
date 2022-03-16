<?php 

include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

$result = $quote->read();

$num = $result->rowCount();

if($num > 0){
    $quotes_arr = array();
    $quotes_array['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        );

        array_push($quotes_array['data'], $quote_item);
    }
        echo stripslashes(json_encode($quotes_array));

    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }

?>