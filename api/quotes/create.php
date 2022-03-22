<?php
require_once '../../function/isValid.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$quote = new Quote($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

//Check for required parameters
if(isset($data->author) && !empty($data->author)){
    $result = $author->create();
    echo json_encode($result);
}else {
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}

// $isValid = isValid($quote->id, $quote);

// //create post
// if(!$isValid){
//     echo json_encode(array('message' => 'Missing Required Parameters'));
// }





exit();

?>