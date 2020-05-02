<?php

class Admin
{
    private $conn;

    public $id;
    public $username;
    public $password;
    public $email;
    public $role;

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
                password= :password,
                email = :email
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':username', htmlspecialchars(strip_tags($this->username)));
            $stmt->bindParam(':email', htmlspecialchars(strip_tags($this->email)));
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
            if(!password_verify($this->password, $admin->password)) return false;
            return $admin;
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

    public function getAdmins()
    {
        try {
            $sql = "
                SELECT *
                FROM admins 
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function changeRole()
    {
        try {
            $query = 'UPDATE admins
                SET 
                role= :role
                WHERE id=:id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':role', htmlspecialchars(strip_tags($this->role)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }
}