<?php
require_once __DIR__ . '/../connect.php';    //move in directory root

class QueueSetup
{
    private $conn;
    private $table_name = "queue_setup";
    private $current_time;

    public function __construct($db)
    {
        $this->conn = $db;
        date_default_timezone_set("Asia/Bangkok");        // Set timezone
        $this->current_time = date('Y-m-d H:i:s'); // Get current time during object creation
    }

    // Get all queue setups
    public function getQueueSetups()
    {
        $sql = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Get a single queue setup by ID
    public function getQueueSetupById($queue_id)
    {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE queue_id = :queue_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':queue_id', $queue_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert a new queue setup
    public function insertQueueSetup($day, $time_start, $time_stop, $classroom_id, $building_id, $room_id, $camera_id)
    {
        $query = "INSERT INTO " . $this->table_name . " (day, time_start, time_stop, classroom_id, building_id, room_id, camera_id, time) VALUES (:day, :time_start, :time_stop, :classroom_id, :building_id, :room_id, :camera_id, :time)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':time_start', $time_start);
        $stmt->bindParam(':time_stop', $time_stop);
        $stmt->bindParam(':classroom_id', $classroom_id, PDO::PARAM_INT);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_INT);
        $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $stmt->bindParam(':camera_id', $camera_id, PDO::PARAM_INT);
        $stmt->bindParam(':time', $this->current_time);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update an existing queue setup
    public function updateQueueSetup($queue_id, $day, $time_start, $time_stop, $classroom_id, $building_id, $room_id, $camera_id)
    {
        $query = "UPDATE " . $this->table_name . " SET day = :day, time_start = :time_start, time_stop = :time_stop, classroom_id = :classroom_id, building_id = :building_id, room_id = :room_id, camera_id = :camera_id,time = :time WHERE queue_id = :queue_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':queue_id', $queue_id, PDO::PARAM_INT);
        $stmt->bindParam(':day', $day, PDO::PARAM_INT);
        $stmt->bindParam(':time_start', $time_start);
        $stmt->bindParam(':time_stop', $time_stop);
        $stmt->bindParam(':classroom_id', $classroom_id, PDO::PARAM_INT);
        $stmt->bindParam(':building_id', $building_id, PDO::PARAM_INT);
        $stmt->bindParam(':room_id', $room_id, PDO::PARAM_INT);
        $stmt->bindParam(':camera_id', $camera_id, PDO::PARAM_INT);
        $stmt->bindParam(':time', $this->current_time);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // Delete a queue setup
    public function deleteQueueSetup($queue_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE queue_id = :queue_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':queue_id', $queue_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
