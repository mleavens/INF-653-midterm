<?php

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate category object
$category = new Category($db);
if ($category->id = isset($_GET['id'])){
    require_once 'read_single.php'; 
};

//category query
$result = $category->read();
//get row count
$num = $result->rowCount();

//check if any categories
if ($num > 0 ){
    //category array
    $categories_arr = array();


    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $category_item = array(
            'id' => $id,
            'category' => $category
        );
    
    //push to data
    array_push($categories_arr, $category_item);
    }

    //Turn to JSON & output
    echo stripslashes(json_encode($categories_arr));
}else{
    //No posts
    echo json_encode(
        array('message' => 'No categories found')
    );
}
exit();
?>