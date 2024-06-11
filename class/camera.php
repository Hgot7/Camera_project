<?php
require_once __DIR__ . '/../connect.php';    //move in directory root
class Camera
{
    private $conn;
    private $table_name = "camera";
    private $current_time;

    public function __construct($db)
    {
        $this->conn = $db;
        date_default_timezone_set("Asia/Bangkok");        // Get current timestamp from PHP
        $this->current_time = date('Y-m-d H:i:s'); // Get current time during object creation

    }

    // Method to get all room in buildings
    public function getCameras()
    {
        $query = "SELECT *  FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to get detailed camera information
    public function getCamerasByStatus($status)
    {
        $query = "
        SELECT 
        c.camera_id,
        c.camera_name,
        b.building_fullname,
        b.building_name,
                  r.room_name,
                  r.room_number,
                  c.status
                  FROM 
                  " . $this->table_name . " c
                  JOIN 
                  building b ON c.building_id = b.building_id
                  JOIN 
                  room r ON c.room_id = r.room_id
                  WHERE c.status = :status ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Fetch cameras based on building_id and room_id
    public function getCamerasByBuildingAndRoom($building_id, $room_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE building_id = :building_id AND room_id = :room_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_INT);
        $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Method to get detailed camera information
    public function getCamerasById($camera_id)
    {
        $query = "
                      SELECT 
                      c.camera_id,
                      c.camera_name,
                      c.building_id,
                      b.building_fullname,
                      b.building_name,
                      r.room_id,
                      r.room_name,
                      r.room_number,
                      c.status
                      FROM 
                      " . $this->table_name . " c
                      JOIN 
                      building b ON c.building_id = b.building_id
                      JOIN 
                      room r ON c.room_id = r.room_id
                      WHERE 
                      c.camera_id = :camera_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':camera_id', $camera_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    // Method to add a new camera
    public function addCamera($building_id, $room_id, $camera_name, $status)
    {
        $query = "INSERT INTO " . $this->table_name . " (building_id, room_id, camera_name, status, time) VALUES (:building_id, :room_id, :camera_name, :status, :time)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':building_id', $building_id);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':camera_name', $camera_name);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':time', $this->current_time);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function updateStatusCamera($camera_id)
    {
        // Check current status
        $query = "SELECT status FROM " . $this->table_name . " WHERE camera_id = :camera_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':camera_id', $camera_id, PDO::PARAM_INT);
        $stmt->execute();
        $currentStatus = $stmt->fetch(PDO::FETCH_ASSOC)['status'];

        // Inverse the current status
        $newStatus = !$currentStatus;

        // Update the status
        $updateQuery = "UPDATE " . $this->table_name . " SET status = :new_status WHERE camera_id = :camera_id";
        $updateStmt = $this->conn->prepare($updateQuery);
        $updateStmt->bindParam(':new_status', $newStatus, PDO::PARAM_INT);
        $updateStmt->bindParam(':camera_id', $camera_id, PDO::PARAM_INT);

        // Execute the update statement
        if ($updateStmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method to update camera details
    public function updateCamera($camera_id, $building_id, $room_id, $camera_name)
    {
        $query = "UPDATE " . $this->table_name . " SET building_id = :building_id, room_id = :room_id, camera_name = :camera_name, time = :time WHERE camera_id = :camera_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':building_id', $building_id);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->bindParam(':camera_name', $camera_name);
        $stmt->bindParam(':camera_id', $camera_id);
        $stmt->bindParam(':time', $this->current_time);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method to delete a camera by its ID
    public function deleteCamera($camera_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE camera_id = :camera_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':camera_id', $camera_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
