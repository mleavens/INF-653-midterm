<?php


$database = new Database();
$db = $database->connect();

$author = new Author($db);

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

$author->read_single();

$author_arr = array(
    'id' => $author->id,
    'author'=>$author->author
);

if($author->id !== null) {
    echo(json_encode($author_arr));
    } 
    else {
        echo json_encode(
            array('message' => 'authorId Not Found')
        );
    }

exit();
?>