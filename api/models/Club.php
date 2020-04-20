<?php


class Club
{
    private $conn;

    public $id;
    public $name;
    public $location;
    public $image;
    public $year;
    public $coach;
    public $stadium_id;
    public $about;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addClub()
    {
        try {
            $query = 'INSERT INTO clubs
                SET 
                name = :name,
                location= :location,
                image = :image,
                stadium_id = :stadium_id,
                coach = :coach,
                year = :year,
                about = :about
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
            $stmt->bindParam(':location', htmlspecialchars(strip_tags($this->location)));
            $stmt->bindParam(':image', htmlspecialchars(strip_tags($this->image)));
            $stmt->bindParam(':stadium_id', htmlspecialchars(strip_tags($this->stadium_id)));
            $stmt->bindParam(':coach', htmlspecialchars(strip_tags($this->coach)));
            $stmt->bindParam(':year', htmlspecialchars(strip_tags($this->year)));
            $stmt->bindParam(':about', htmlspecialchars(strip_tags($this->about)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getClubs()
    {
        try {
            $sql = "
                SELECT club.*, stadium.id AS stadium_id, stadium.name AS stadium_name
                FROM clubs club
                LEFT JOIN stadiums stadium ON stadium.id = club.stadium_id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getClubById()
    {
        try {
            $sql = "
                SELECT *
                FROM clubs
                WHERE id = :id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteClub()
    {
        try {
            $query = 'DELETE FROM clubs
                WHERE id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateClub()
    {
        try {
            $query = 'UPDATE clubs
                SET 
                name = :name,
                location= :location,
                image = :image,
                stadium_id = :stadium_id,
                coach = :coach,
                year = :year,
                about = :about
                where id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
            $stmt->bindParam(':location', htmlspecialchars(strip_tags($this->location)));
            $stmt->bindParam(':image', htmlspecialchars(strip_tags($this->image)));
            $stmt->bindParam(':stadium_id', htmlspecialchars(strip_tags($this->stadium_id)));
            $stmt->bindParam(':coach', htmlspecialchars(strip_tags($this->coach)));
            $stmt->bindParam(':year', htmlspecialchars(strip_tags($this->year)));
            $stmt->bindParam(':about', htmlspecialchars(strip_tags($this->about)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }
}