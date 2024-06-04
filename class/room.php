<?php
require_once __DIR__ . '/../connect.php';    //move in directory root
class Room
{
    private $conn;
    private $table_name = "room";
    private $building_table = "building";
    private $current_time;

    public function __construct($db)
    {
        $this->conn = $db;
        date_default_timezone_set("Asia/Bangkok");        // Get current timestamp from PHP
        $this->current_time = date('Y-m-d H:i:s'); // Get current time during object creation

    }

    // Method to get all room in buildings
    public function getRooms()
    {
        $query = "SELECT *  FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to add a new room
    public function addRoom($building_Id, $room_Name, $room_Number)
    {
        $query = "INSERT INTO room (building_id, room_name, room_number, time) VALUES (:building_id, :room_name, :room_number, :time)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':building_id', $building_Id);
        $stmt->bindParam(':room_name', $room_Name);
        $stmt->bindParam(':room_number', $room_Number);
        $stmt->bindParam(':time', $this->current_time);

        if ($stmt->execute()) {
            return true; // Room added successfully
        } else {
            return false; // Error adding room
        }
    }

    // Method to get all rooms in a specific building
    public function getRoomsWithBuilding($building_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE building_id = :building_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':building_id', $building_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to get room details by room_id
    public function getRoomDetails($room_id)
    {
        $query = "SELECT r.room_id, r.room_name, r.room_number, b.building_id ,b.building_fullname ,b.building_name
                      FROM " . $this->table_name . " r
                      JOIN " . $this->building_table . " b ON r.building_id = b.building_id
                      WHERE r.room_id = :room_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':room_id', $room_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    // Method to get all rooms in a specific building
    public function updateRoom($building_id, $room_name, $room_number, $room_id)
    {
        $query = "UPDATE " . $this->table_name . " SET building_id = :building_id, room_name = :room_name, room_number = :room_number, time = :time WHERE room_id = :room_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':building_id', $building_id);
        $stmt->bindParam(':room_name', $room_name);
        $stmt->bindParam(':room_number', $room_number);
        $stmt->bindParam(':room_id', $room_id); // Existing room ID
        $stmt->bindParam(':time', $this->current_time);
        $result = $stmt->execute();
        return $result;
    }

     // Method to delete a room by ID
    public function deleteRoom($room_id)
    {
        // Prepare and execute the DELETE query
        $query = "DELETE FROM " . $this->table_name . " WHERE room_id = :room_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':room_id', $room_id);

        if ($stmt->execute()) {
            return true; // Building deleted successfully
        } else {
            return false; // Error deleting building
        }
    }
}
