<?php


class Quote {
  
    private $conn;
    private $table = 'quotes';

    public $id;
    public $quote;
    public $categoryId;
    public $authorId;
    public $author;
    public $category;

    public function __construct($db){
        $this->conn = $db;
    }

    //READ
    public function read() {
        $query = 'SELECT 
            a.author as author,
            c.category as category,
            q.id, 
            q.quote, 
            q.authorId, 
            q.categoryId
            FROM ' . $this->table . ' q
            LEFT JOIN
            authors a ON q.authorId = a.id
            LEFT JOIN
            categories c ON q.categoryID = c.id';

//prepare query
$stmt = $this->conn->prepare($query);
// Execute query
$stmt->execute();

return $stmt;
    }


//READ SINGLE
    public function read_single() {
        $query = 'SELECT 
        a.author as author,
        c.category as category,
        q.id, 
        q.quote, 
        q.authorId, 
        q.categoryId
        FROM ' . $this->table . ' q
        LEFT JOIN
        authors a ON q.authorId = a.id
        LEFT JOIN
        categories c ON q.categoryID = c.id
        WHERE
        q.id = ?
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
        $this->author = $row['author'];
        $this->quote = $row['quote'];


    }

//CREATE
public function create() {
    $query = 'INSERT INTO ' . $this->table . '
        SET
            quote = :quote,
            categoryId = :categoryId,
            authorId = :authorId
            ';
    //Prepare statment
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));
    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->authorId = htmlspecialchars(strip_tags($this->authorId));

    //bind data
    $stmt->bindParam(':categoryId', $this->categoryId);
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':authorId', $this->authorId);

    //execute query
    if($stmt->execute()) {
        $quote_arr = array(
            'id' => $this->conn->lastInsertId(),
            'quote' => $this->quote,
            'authorId' => $this->authorId,
            'categoryId' => $this->categoryId
        );
        return $quote_arr;
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
            quote = :quote,
            id = :id,
            authorId = :authorId,
            categoryId = :categoryId
        WHERE
            id = :id';
    //Prepare statment
    $stmt = $this->conn->prepare($query);

    //clean data
    $this->quote= htmlspecialchars(strip_tags($this->quote));
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->authorId = htmlspecialchars(strip_tags($this->authorId));
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

    //bind data
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':authorId', $this->authorId);
    $stmt->bindParam(':categoryId', $this->categoryId);

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