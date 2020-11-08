<?php
  class Post{
    // DB stuff
    private $conn;
  
    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create Query
      $query = 'SELECT 
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
        FROM
         posts p
        LEFT JOIN 
         categories c 
        ON p.category_id = c.id
        ORDER BY
         p.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function read_single() {
       // Create Query
       $query = 'SELECT 
       c.name as category_name,
       p.id,
       p.category_id,
       p.title,
       p.body,
       p.author,
       p.created_at
       FROM
        posts p
       LEFT JOIN 
        categories c 
       ON p.category_id = c.id
       WHERE p.id = ?
       LIMIT 0, 1';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // Set properties
      $this->title = $row['title'];
      $this->body = $row['body'];
      $this->author = $row['author'];
      $this->category_id = $row['category_id'];
      $this->category_name = $row['category_name'];
    }

    // Create Post
    public function create() {
      // Create Query
      $query = 'INSERT INTO posts 
        SET
          title = :title,
          body = :body,
          author = :author,
          category_id = :category_id';

      // Prepare stmt
      $stmt = $this->conn->prepare($query);

      // Sanitize data
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));
      
      // Bind Params
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);
      $stmt->bindParam(':category_id', $this->category_id);

      // Execute Query
      if($stmt->execute()) {
        return true;
      }

      // Print error if somthing goes wrong
      printf("Erro: &s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
      // Create Query
      $query = 'UPDATE posts 
        SET
          title = :title,
          body = :body,
          author = :author,
          category_id = :category_id
        WHERE 
          id = :id';

      // Prepare stmt
      $stmt = $this->conn->prepare($query);

      // Sanitize data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->title = htmlspecialchars(strip_tags($this->title));
      $this->body = htmlspecialchars(strip_tags($this->body));
      $this->author = htmlspecialchars(strip_tags($this->author));
      $this->category_id = htmlspecialchars(strip_tags($this->category_id));
      
      // Bind Params
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':title', $this->title);
      $stmt->bindParam(':body', $this->body);
      $stmt->bindParam(':author', $this->author);
      $stmt->bindParam(':category_id', $this->category_id);

      // Execute Query
      if($stmt->execute()) {
        return true;
      }

      // Print error if somthing goes wrong
      printf("Erro: &s.\n", $stmt->error);

      return false;
    }

    public function delete() {
      $query = 'DELETE FROM posts WHERE id = :id';
      
      $stmt = $this->conn->prepare($query);
      

      $this->id = htmlspecialchars(strip_tags($this->id));

      $stmt->bindParam(':id', $this->id);

      if($stmt->execute()){
        return true;
      }

      printf("Error: &s.\n", $stmt->error);

      return false;
    }

  }