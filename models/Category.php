<?php

class Category {
    // DB stuff
    private $conn;
    private $table = 'categories';

    // Post Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with DB
   public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts

public function read(){ 

        $query = 'SELECT id,name,created_at 
        FROM ' . $this->table . '
         ORDER BY
        created_at DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;

} 

public function read_single($id){
      
    $query = 'SELECT id, name  
    FROM ' . $this->table . 'WHERE id = ? LIMIT 0,1';

         $this->id = $id;
   
        $stmt = $this->conn->prepare($query);

          $stmt->bindParam(1, $this->id);
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $this->id = $row['id'];
          $this->name = $row['name'];
           
}


public function update ($id)
{  
    $this->id = htmlspecialchars(strip_tags($id));
    $this->name = htmlspecialchars(strip_tags($this->name));

  $query = 'UPDATE ' . $this->table . '
  SET name = :name
  WHERE id = :id';


  $stmt = $this->conn->prepare($query);

  // Clean data
 
  
  // Bind data
  $stmt->bindParam(':name', $this->name);
 

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function create() {
  // Create query
  $query = 'INSERT INTO ' . $this->table . ' SET name = :name';

  // Prepare statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
  
  // Bind data
  $stmt->bindParam(':name', $this->name);


  // Execute query
  if($stmt->execute()) {
    return true;
   }
 
  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);

  return false;
}

public function delete($id){
   
  $this->id = htmlspecialchars(strip_tags($id));
  
  $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

   // Prepare statement
   $stmt = $this->conn->prepare($query);

   $stmt->bindParam(':id', $this->id);
          // Execute query
          if($stmt->execute()) {
            return true;
          }
          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
          return false;

}

}?>