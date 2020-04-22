<?php

class Admin
{
    private $conn;

    public $id;
    public $username;
    public $password;

    /**
     * Admin constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function register()
    {
        try {
            $query = 'INSERT INTO admins
                SET 
                username = :username,
                password= :password
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':username', htmlspecialchars(strip_tags($this->username)));
            $stmt->bindParam(':password', password_hash(htmlspecialchars(strip_tags($this->password)), PASSWORD_DEFAULT));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function login()
    {
        try {
            $sql = "
                SELECT *
                FROM admins
                WHERE username = :username
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', htmlspecialchars(strip_tags($this->username)));
            $stmt->execute();

            $admin = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$admin) return false;
            else {
                return password_verify($this->password, $admin->password);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function changePassword($newPassword)
    {
        try {
            $query = 'UPDATE admins
                SET 
                password= :password
                WHERE username=:username
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':username', htmlspecialchars(strip_tags($this->username)));
            $stmt->bindParam(':password', password_hash(htmlspecialchars(strip_tags($newPassword)), PASSWORD_DEFAULT));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }
}