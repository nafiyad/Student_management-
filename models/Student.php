<?php
class Student {
    private $conn;
    private $table_name = "students";

    public $id;
    public $student_id;
    public $name;
    public $email;
    public $created_by;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (student_id, name, email, created_by) VALUES (:student_id, :name, :email, :created_by)";
        $stmt = $this->conn->prepare($query);

        // Sanitize inputs
        $this->student_id = htmlspecialchars(strip_tags($this->student_id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->created_by = htmlspecialchars(strip_tags($this->created_by));

        // Bind values
        $stmt->bindParam(":student_id", $this->student_id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":created_by", $this->created_by);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind value
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?> 