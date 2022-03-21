<?php

class Author 

{
//DB stuff
    private $conn;
    private $table = 'authors';
//Author properties
    public $author;
    public $id;

    public function __construct($db){
        $this->conn = $db;
    }

//READ
    public function read() {
        $query = 'SELECT author, id
        FROM ' . $this->table . '
        ORDER BY
            id DESC';

//prepare query
$stmt = $this->conn->prepare($query);
// Execute query
$stmt->execute();

return $stmt;
    } 

//READ SINGLE
    public function read_single() {
        $query = 'SELECT author, id
        FROM ' . $this->table . ' 
        WHERE
        id = ?
        LIMIT 0,1';

        //prepare statement
        $stmt = $this->conn->prepare($query);

        //bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //set properties
        $this->author = $row['author'];
        return $stmt;
    }

//CREATE
public function create() {
    $query = 'INSERT INTO ' . $this->table . '
        SET
            author = :author';
    //Prepare statment
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->author = htmlspecialchars(strip_tags($this->author));

    //bind data
    $stmt->bindParam(':author', $this->author);

    //execute query
    $stmt->execute();
    $author_arr = array(
        'id' => $this->conn->lastInsertId(), 
        'author' => $this->author
    );
    return $author_arr;

    // if( $stmt->execute()) {
    //     $id = $this->conn->lastInsertId();
    //     return true;
    // }else{
    //     //print error if something goes wrong
    //     printf('Error: %s.\n', $stmt->error);
    //     return false;
    // }
}

//UPDATE
public function update() {
    $query = 'UPDATE ' . $this->table . '
        SET
            author = :author,
            id = :id
        WHERE
            id = :id';
    //Prepare statment
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->author = htmlspecialchars(strip_tags($this->author));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind data
    $stmt->bindParam(':author', $this->author);
    $stmt->bindParam(':id', $this->id);

    //execute query
    if($stmt->execute()) {
        return true;
    }else{
        //print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);
        return false;
    }
}

//DELETE
public function delete(){
    //query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    //prepared statement
    $stmt = $this->conn->prepare($query);
    $this->id=htmlspecialchars(strip_tags($this->id));
    $stmt->bindParam(':id', $this->id);
    
//execute query
if($stmt->execute()) {
    return true;
}else{
    //print error if something goes wrong
    printf('Error: %s.\n', $stmt->error);
    return false;
}
}
}

    ?>