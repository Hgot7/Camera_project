<?php
require_once __DIR__ . '/../connect.php';    //move in directory root
class Room
{
    private $conn;
    private $table_name = "room";
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
}
