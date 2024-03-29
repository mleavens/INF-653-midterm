<?php 

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);

if ($quote->id = isset($_GET['id'])){
    require_once 'read_single.php'; 
};

$result = $quote->read();

$num = $result->rowCount();

if($num > 0){
    $quotes_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        );

        array_push($quotes_arr, $quote_item);
    }
        echo stripslashes(json_encode($quotes_arr));

    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }
    exit();
?>