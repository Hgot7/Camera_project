<?php
require_once __DIR__ . '/../connect.php';    //move in directory root
class Department
{
    private $conn;
    private $table_name = "department";
    private $subject_table = "subject";
    private $sub_subject_table = "sub_subject";
    private $current_time;

    public function __construct($db)
    {
        $this->conn = $db;
        date_default_timezone_set("Asia/Bangkok");        // Get current timestamp from PHP
        $this->current_time = date('Y-m-d H:i:s'); // Get current time during object creation

    }

    // Method to get all department in buildings
    public function getDepartments()
    {
        $query = "SELECT *  FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    // Method to add a new department
    public function addDepartment($department_name)
    {
        $query = "INSERT INTO " . $this->table_name . " (department_name, time) VALUES (:department_name, :time)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':time', $this->current_time);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method to update a department
    public function updateDepartment($department_id, $department_name)
    {
        $query = "UPDATE " . $this->table_name . " SET department_name = :department_name, time = :time WHERE department_id = :department_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':department_id', $department_id);
        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':time', $this->current_time);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Method to delete a department
    public function deleteDepartment($department_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE department_id = :department_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':department_id', $department_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
