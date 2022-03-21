<?php


//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate author object
$authorExists = isValid($id, $author);
$author = new Author($db);
if ($authorExists){
    require_once 'read_single.php'; 
}elseif(!$authorExists){
    echo json_encode('message: authorId Not Found');
};

//author query
$result = $author->read();
//get row count
$num = $result->rowCount();

//check if any authors
if ($num > 0 ){
    //author array
    $authors_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $author_item = array(
            'id' => $id,
            'author' => $author
        );
    
    //push to data
    array_push($authors_arr, $author_item);
    }

    //Turn to JSON & output
    echo stripslashes(json_encode($authors_arr));
}else{
    //No posts
    echo json_encode(
        array('message' => 'No authors found')
    );
}


exit();
?>