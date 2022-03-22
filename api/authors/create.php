<?php


//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));


$author->author = $data->author;
$author->id = $data->id;

if($author->author === null){
    echo json_encode(
        array('message' => 'Missing Required Parameters') 
        );
}

$result = $author->create();
echo json_encode($result);


//create post
// $result = $author->create();


// if($result) {
//     echo json_encode($result);
// } else {
//     echo json_encode(
//         array('message' => 'Missing Required Parameters') 
//     );
// };


exit();

?>