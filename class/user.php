<?php
require_once __DIR__ . '/../connect.php';    //move in directory root
class User
{
    private $conn;
    private $table_name = "user";
    private $current_time;

    // Constructor with database connection
    public function __construct($db)
    {
        $this->conn = $db;
        date_default_timezone_set("Asia/Bangkok");        // Get current timestamp from PHP
        $this->current_time = date('Y-m-d H:i:s'); // Get current time during object creation
    }

    // Register a new user
    public function register($username, $password, $email, $full_name, $role)
    {
        $query = "INSERT INTO " . $this->table_name . " (username, password, email, full_name, role) VALUES (:username, :password, :email, :full_name, :role)";
        $stmt = $this->conn->prepare($query);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Authenticate user
    public function login($username, $password, $remember)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            if ($user['role'] == 'admin') {
                $_SESSION['admin_id'] = $user['user_id'];
                $_SESSION['admin_login'] = $user['username'];
            } elseif ($user['role'] == 'user') {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_login'] = $user['username'];
            }
            if ($remember) {
                $remember_token = bin2hex(random_bytes(16));
                $expiry_date = date('Y-m-d H:i:s', strtotime('+30 days'));

                $query = "UPDATE " . $this->table_name . " SET remember_token = :remember_token, remember_token_expiry = :remember_token_expiry WHERE user_id = :user_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':remember_token', $remember_token);
                $stmt->bindParam(':remember_token_expiry', $expiry_date);
                $stmt->bindParam(':user_id', $user['user_id']);
                $stmt->execute();

                setcookie('remember_token', $remember_token, time() + (86400 * 30), "/"); // 86400 = 1 day
            } else {
                $query = "UPDATE " . $this->table_name . " SET remember_token = NULL, remember_token_expiry = NULL WHERE user_id = :user_id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':user_id', $user['user_id']);
                $stmt->execute();

                if (isset($_COOKIE['remember_token'])) {
                    setcookie('remember_token', '', time() - 3600, "/"); // Expire the cookie
                }
            }
            return true;
        } else {
            return false;
        }
    }

    // Check remember me token
    public function checkRememberMe()
    {
        if (isset($_COOKIE['remember_token'])) {
            $remember_token = $_COOKIE['remember_token'];

            $query = "SELECT * FROM " . $this->table_name . " WHERE remember_token = :remember_token AND remember_token_expiry > :time";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':remember_token', $remember_token);
            $stmt->bindParam(':time', $this->current_time);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                if ($user['role'] == 'admin') {
                    $_SESSION['admin_id'] = $user['user_id'];
                    $_SESSION['admin_login'] = $user['username'];
                } elseif ($user['role'] == 'user') {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_login'] = $user['username'];
                }
                return true;
            }
        }
        return false;
    }


    public function clearRememberToken($user_id)
    {
        $query = "UPDATE " . $this->table_name . " SET remember_token = NULL, remember_token_expiry = NULL WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }







    // Get user by ID
    public function getUserById($user_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Delete user by ID
    public function deleteUser($user_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Update user information
    public function updateUser($user_id, $username, $email, $full_name, $role)
    {
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email, full_name = :full_name, role = :role WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
