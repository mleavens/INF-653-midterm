<?php
require_once '../../function/isValid.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$data->id = htmlspecialchars(strip_tags($data->id));
$data->quote = htmlspecialchars(strip_tags($data->quote));
$data->category = htmlspecialchars(strip_tags($data->category));
$data->author = htmlspecialchars(strip_tags($data->author));


if(isset($data->id) && !empty($data->id) && isset($data->quote) && !empty($data->quote) && isset($data->category) && !empty($data->category) && isset($data->author) && !empty($data->author) ){
    $result = $quote->update();
    echo json_encode($result);
}else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}

?>