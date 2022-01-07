<?php
    class songPost {
        // DB Stuff
        private $conn;

        // Post Properties
        public $song_id;
        public $cover_id;
        public $name;
        public $author;
        public $uploader;
        public $user;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Posts
       /* public function read() {
            // Create Query 
            $query = 'SELECT id, title, created_at FROM ' . $this->table;

            // Prepare Statement
            $stmt = $this->conn->prepare($query);
            
            // Execute Query
            $stmt->execute();

            return $stmt;
        }*/

        //Get Single Post
       /* public function read_single() {
            // Create Query 
            $query = 'SELECT
                      id as Num,
                      title as Title,
                      created_at as DateAdded
                      FROM
                      ' . $this->table . ' 
                      WHERE 
                      id = ?
                      LIMIT 0,1';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties
            $this->id = $row['id'];
            $this->title = $row['title'];
            $this->created_at = $row['created_at'];
        }*/

        // Create Post 
        public function create() {
            // Create Query
            $query = 'INSERT INTO songs (song_id, cover_id, name, author, uploader, user) VALUES (?, ?, ?, ?, ?, ?)';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->author = htmlspecialchars(strip_tags($this->author));

            // Bind Data
            $stmt->bindParam(1, $this->song_id);
            $stmt->bindParam(2, $this->cover_id);
            $stmt->bindParam(3, $this->name);
            $stmt->bindParam(4, $this->author);
            $stmt->bindParam(5, $this->uploader);
            $stmt->bindParam(6, $this->user);

            // Execute Query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);

            return false;
        }
    }