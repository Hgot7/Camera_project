<?php
require_once __DIR__ . '/../connect.php';    //move in directory root

class Classroom
{
    private $conn;
    private $table_name = "classroom";
    private $current_time;

    public function __construct($db)
    {
        $this->conn = $db;
        date_default_timezone_set("Asia/Bangkok");        // Set timezone
        $this->current_time = date('Y-m-d H:i:s'); // Get current time during object creation
    }

    // Method to get all classrooms
    public function getClassrooms()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to add a new classroom
    public function addClassroom($department_id, $level, $sublevel, $class, $building_id, $room_id, $line_token)
    {
        $query = "INSERT INTO " . $this->table_name . " (department_id, level, sub_level, class, building_id, room_id, line_token, time) VALUES (:department_id, :level, :sub_level, :class, :building_id, :room_id, :line_token, :time)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':department_id', $department_id);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':sub_level', $sublevel);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':building_id', $building_id);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':line_token', $line_token);
        $stmt->bindParam(':time', $this->current_time);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method to get a classroom by classroom_id
    public function getClassroomById($classroom_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE classroom_id = :classroom_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':classroom_id', $classroom_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    // Method to get classrooms by department_id
    public function getClassroomsByDepartment($department_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE department_id = :department_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to update classroom
    public function updateClassroom($classroom_id, $department_id, $level, $sublevel, $class, $building_id, $room_id, $line_token)
    {
        $query = "UPDATE " . $this->table_name . " SET department_id = :department_id, level = :level, sub_level = :sub_level, class = :class, building_id = :building_id, room_id = :room_id, 
        line_token = :line_token, time = :time WHERE classroom_id = :classroom_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':classroom_id', $classroom_id);
        $stmt->bindParam(':department_id', $department_id);
        $stmt->bindParam(':level', $level);
        $stmt->bindParam(':sub_level', $sublevel);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':building_id', $building_id);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':line_token', $line_token);
        $stmt->bindParam(':time', $this->current_time);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method to delete a classroom
    public function deleteClassroom($classroom_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE classroom_id = :classroom_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':classroom_id', $classroom_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
