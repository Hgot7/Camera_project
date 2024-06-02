<?php
require_once '../connect.php';
class Building
{
    private $conn;
    private $table_name = "building";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Method to get buildings and their rooms
    public function getBuildingsWithRooms()
    {
        $query = "SELECT b.building_id, b.building_fullname, b.building_name, b.time AS building_time, 
                         r.room_id, r.room_name, r.room_number, r.time AS room_time 
                  FROM " . $this->table_name . " b
                  LEFT JOIN room r ON b.building_id = r.building_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // Method to get all building
    // Method to get all buildings
    public function getBuildings()
    {
        $query = "SELECT building_id, building_fullname, building_name, time 
                  FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    // Method to get rooms by building ID
    public function getRoomsByBuildingId($building_id)
    {
        $query = "SELECT room_id, room_name, room_number, building_id, time 
                  FROM room 
                  WHERE building_id = :building_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':building_id', $building_id);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // Method to add a new building
    public function addBuilding($building_name, $building_fullname)
    {
        $query = "INSERT INTO " . $this->table_name . " (building_name, building_fullname) VALUES (:building_name, :building_fullname)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':building_name', $building_name);
        $stmt->bindParam(':building_fullname', $building_fullname);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method to delete a building by ID
    public function deleteBuilding($building_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE building_id = :building_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':building_id', $building_id);

        if ($stmt->execute()) {
            return true; // Building deleted successfully
        } else {
            return false; // Error deleting building
        }
    }
      // Method to update building details
  public function updateBuilding($building_id, $building_fullname, $building_name)
  {
    $query = "UPDATE " . $this->table_name . " SET building_fullname = :building_fullname, building_name = :building_name 
    WHERE building_id = :building_id";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':building_id', $building_id);
    $stmt->bindParam(':building_fullname', $building_fullname);
    $stmt->bindParam(':building_name', $building_name);

    if ($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
}

