<?php


$database = new Database();
$db = $database->connect();

$category = new Category($db);

$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$category->read_single();

$category_arr = array(
    'id' => $category->id,
    'category'=>$category->category
);


print_r(json_encode($category_arr));
exit();
?>