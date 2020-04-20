<?php


class Player
{
    private $conn;

    public $id;
    public $name;
    public $dob;
    public $image;
    public $player_number;
    public $position;
    public $club_id;

    /**
     * Player constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addPlayer()
    {
        try {
            $query = 'INSERT INTO players
                SET 
                name = :name,
                dob= :dob,
                image = :image,
                player_number = :player_number,
                position = :position,
                club_id = :club_id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
            $stmt->bindParam(':dob', htmlspecialchars(strip_tags($this->dob)));
            $stmt->bindParam(':image', htmlspecialchars(strip_tags($this->image)));
            $stmt->bindParam(':player_number', htmlspecialchars(strip_tags($this->player_number)));
            $stmt->bindParam(':position', htmlspecialchars(strip_tags($this->position)));
            $stmt->bindParam(':club_id', htmlspecialchars(strip_tags($this->club_id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getPlayers()
    {
        try {
            $sql = "
                SELECT *, DATE_FORMAT(dob, '%Y-%m-%d') AS custom_dob
                FROM players
                WHERE club_id = :club_id
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':club_id', htmlspecialchars(strip_tags($this->club_id)));
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getPlayerById()
    {
        try {
            $sql = "
                SELECT *
                FROM players
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

    public function updatePlayer()
    {
        try {
            $query = 'UPDATE players
                SET 
                name = :name,
                dob= :dob,
                image = :image,
                player_number = :player_number,
                position = :position,
                club_id = :club_id
                WHERE id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':name', htmlspecialchars(strip_tags($this->name)));
            $stmt->bindParam(':dob', htmlspecialchars(strip_tags($this->dob)));
            $stmt->bindParam(':image', htmlspecialchars(strip_tags($this->image)));
            $stmt->bindParam(':player_number', htmlspecialchars(strip_tags($this->player_number)));
            $stmt->bindParam(':position', htmlspecialchars(strip_tags($this->position)));
            $stmt->bindParam(':club_id', htmlspecialchars(strip_tags($this->club_id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deletePlayer()
    {
        try {
            $query = 'DELETE FROM players
                WHERE id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }


}