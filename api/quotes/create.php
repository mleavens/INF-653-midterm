<?php


//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Check for required parameters
if(isset($data->quote) && !empty($data->quote) && isset($data->author) && !empty($data->author) && isset($data->category) && !empty($data->category)){
    $result = $quote->create();
    echo json_encode($result);
}elseif(!isset($data->author) && !empty($data->author){
    echo json_encode(
        array('message' => 'authorId Not Found') 
        );
}else{
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}




exit();

?>