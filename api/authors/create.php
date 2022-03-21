<?php


require_once '../../config/Database.php';
require_once '../../models/Author.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$author = new Author($db);

//get raw posted data
$data = json_decode(file_get_contents('php://input'));

$author->author = $data->author;
$author->id = $data->id;

//create post
$result = $author->create();
echo json_encode($result);


exit();

?>