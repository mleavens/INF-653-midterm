<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$author = new Author($db);

$author->id = isset($_GET['id']) ? $_GET['id'] : die();

$author->read_single();

$author_arr = array(
    'id' => $author->id,
    'author'=>$author->author
);


echo(json_encode($author_arr));

exit();
?>