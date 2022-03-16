<?php


class Category 
{

    private $conn;
    private $table = 'categories';

    public $category;
    public $id;

    public function __construct($db){
        $this->conn = $db;
    }

    //READ
    public function read() {
        $query = 'SELECT category, id
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
        $query = 'SELECT category, id
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
        $this->category = $row['category'];

    }


//CREATE
public function create() {
    $query = 'INSERT INTO ' . $this->table . '
        SET
            category = :category,
            id = :id';
    //Prepare statment
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind data
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':id', $this->id);

    //execute query
    if($stmt->execute()) {
        $id = $this->conn->lastInsertId();
        return true;
    }else{
        //print error if something goes wrong
        printf('Error: %s.\n', $stmt->error);
        return false;
    }
}

//UPDATE
public function update() {
    $query = 'UPDATE ' . $this->table . '
        SET
            category = :category,
            id = :id
        WHERE
            id = :id';
    //Prepare statment
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->category = htmlspecialchars(strip_tags($this->category));
    $this->id = htmlspecialchars(strip_tags($this->id));

    //bind data
    $stmt->bindParam(':category', $this->category);
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

