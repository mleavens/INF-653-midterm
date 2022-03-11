<?php
include_once '../../config/Database.php';
include_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$quote = new quote($db);

$quote->id = isset($_GET['id']) ? $_GET['id'] : die();

$quote->read_single();

$quote_arr = array(
    'id' => $quote->id,
    'quote'=>$quote->quote,
    'author'=>$quote->author,
    'category'=>$quote->category
);


print_r(stripslashes(json_encode($quote_arr)));

?>