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
    // Method to get a classroom by department_id
    public function getDepartmenById($department_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE department_id = :department_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
    // =========================================== call subject by department


    // Method to get all subject 
    public function getSubjects()
    {
        $query = "SELECT *  FROM " . $this->subject_table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to get subjects by department_id
    public function getSubjectsByDepartmentId($department_id)
    {
        $query = "SELECT * FROM " . $this->subject_table . " WHERE department_id = :department_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to get a subject by subject_id
    public function getSubjecBySujectId($subject_id)
    {
        $query = "SELECT * FROM " . $this->subject_table . " WHERE subject_id = :subject_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':subject_id', $subject_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to get department_name and subject_name by subject_id
    public function getDepartmentAndSubject($subject_id)
    {
        $query = "SELECT d.department_name, s.subject_name
                          FROM " . $this->subject_table . " s
                          JOIN " . $this->table_name . " d ON s.department_id = d.department_id
                          WHERE s.subject_id = :subject_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Method to update a subject
    public function updateSubject($subject_id, $subject_name)
    {
        $query = "UPDATE " . $this->subject_table . " SET subject_name = :subject_name WHERE subject_id = :subject_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->bindParam(':subject_name', $subject_name);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Method to add a subject
    public function addSubject($department_id, $subject_name)
    {
        $query = "INSERT INTO " . $this->subject_table . " (department_id, subject_name) VALUES (:department_id, :subject_name)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':department_id', $department_id);
        $stmt->bindParam(':subject_name', $subject_name);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Method to delete a subject
    public function deleteSubject($subject_id)
    {
        $query = "DELETE FROM " . $this->subject_table . " WHERE subject_id = :subject_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':subject_id', $subject_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //  ======================================== call sub-subject by subject


    // Method to get all subject 
    public function getSubSubjects()
    {
        $query = "SELECT *  FROM " . $this->sub_subject_table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    // Method to get sub-subjects by subject_id
    public function getSubSubjectsBySubjectId($subject_id)
    {
        $query = "SELECT * FROM " . $this->sub_subject_table . " WHERE subject_id = :subject_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to get a subject by subject_id
    public function getSubSubjectBySubSubjectId($sub_subject_id)
    {
        $query = "SELECT * FROM " . $this->sub_subject_table . " WHERE sub_subject_id = :sub_subject_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameter
        $stmt->bindParam(':sub_subject_id', $sub_subject_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addSubSubject($subject_id, $sub_subject_name)
    {
        $query = "INSERT INTO " . $this->sub_subject_table . " (subject_id, sub_subject_name) VALUES (:subject_id, :sub_subject_name)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':subject_id', $subject_id);
        $stmt->bindParam(':sub_subject_name', $sub_subject_name);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function updateSubSubject($sub_subject_id, $sub_subject_name)
    {
        $query = "UPDATE " . $this->sub_subject_table . " SET sub_subject_name = :sub_subject_name WHERE sub_subject_id = :sub_subject_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':sub_subject_id', $sub_subject_id);
        $stmt->bindParam(':sub_subject_name', $sub_subject_name);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // Method to delete a sub-subject by sub_subject_id
    public function deleteSubSubject($sub_subject_id)
    {
        $query = "DELETE FROM " . $this->sub_subject_table . " WHERE sub_subject_id = :sub_subject_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':sub_subject_id', $sub_subject_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    // Method to get department_name and subject_name by subject_id
    // public function getDepartmentAndSubjectBySubjectId($subject_id)
    // {
    //     $query = "
    //            SELECT d.department_name, s.subject_name 
    //            FROM " . $this->sub_subject_table . " ss
    //            JOIN " . $this->subject_table . " s ON ss.subject_id = s.subject_id
    //            JOIN " . $this->table_name . " d ON s.department_id = d.department_id
    //            WHERE ss.subject_id = :subject_id
    //        ";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bindParam(':subject_id', $subject_id);
    //     $stmt->execute();
    //     $result = $stmt->fetch(PDO::FETCH_ASSOC);
    //     return $result;
    // }
}
