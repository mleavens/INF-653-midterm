<?php

include_once '../../config/Database.php';
include_once '../../models/Author.php';


//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$author = new Author($db);

//author query
$result = $author->read();
//get row count
$num = $result->rowCount();

//check if any authors
if ($num > 0 ){
    //author array
    $authors_arr = array();
    $authors_array['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'id' => $id,
            'author' => $author
        );
    
    //push to data
    array_push($authors_array['data'], $author_item);
    }

    //Turn to JSON & output
    echo stripslashes(json_encode($authors_array));
}else{
    //No posts
    echo json_encode(
        array('message' => 'No authors found')
    );
}


exit();
?>