<?php


class Fixture
{
    private $conn;

    public $id;
    public $home_id;
    public $away_id;
    public $match_date;
    public $goals_home;
    public $goals_away;
    public $match_played;

    /**
     * Fixture constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function addFixture()
    {
        try {
            $query = 'INSERT INTO fixtures
                SET 
                home_id = :home_id,
                away_id= :away_id,
                match_date = :match_date,
                goals_home = :goals_home,
                goals_away = :goals_away,
                match_played = :match_played
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':home_id', htmlspecialchars(strip_tags($this->home_id)));
            $stmt->bindParam(':away_id', htmlspecialchars(strip_tags($this->away_id)));
            $stmt->bindParam(':match_date', htmlspecialchars(strip_tags($this->match_date)));
            $stmt->bindParam(':goals_home', htmlspecialchars(strip_tags($this->goals_home)));
            $stmt->bindParam(':goals_away', htmlspecialchars(strip_tags($this->goals_away)));
            $stmt->bindParam(':match_played', htmlspecialchars(strip_tags($this->match_played)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getFixtures()
    {
        try {
            $sql = "
                SELECT fixture.*, DATE_FORMAT(fixture.match_date, '%Y-%m-%dT%H:%i') AS custom_match_date,
                away.id AS away_id, away.name AS away_name, away.image AS away_image,
                home.id AS home_id, home.name AS home_name, home.image AS home_image,
                stadium.name AS stadium_name, stadium.location AS stadium_location
                FROM fixtures fixture
                LEFT JOIN clubs AS away ON away.id = fixture.away_id
                LEFT JOIN clubs AS home ON home.id = fixture.home_id
                LEFT JOIN stadiums AS stadium ON stadium.id = home.stadium_id
                ORDER BY fixture.match_date ASC
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function updateFixture()
    {
        try {
            $query = 'UPDATE fixtures
                SET 
                home_id = :home_id,
                away_id= :away_id,
                match_date = :match_date,
                goals_home = :goals_home,
                goals_away = :goals_away,
                match_played = :match_played
                WHERE id = :id
            ';
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':id', htmlspecialchars(strip_tags($this->id)));
            $stmt->bindParam(':home_id', htmlspecialchars(strip_tags($this->home_id)));
            $stmt->bindParam(':away_id', htmlspecialchars(strip_tags($this->away_id)));
            $stmt->bindParam(':match_date', htmlspecialchars(strip_tags($this->match_date)));
            $stmt->bindParam(':goals_home', htmlspecialchars(strip_tags($this->goals_home)));
            $stmt->bindParam(':goals_away', htmlspecialchars(strip_tags($this->goals_away)));
            $stmt->bindParam(':match_played', htmlspecialchars(strip_tags($this->match_played)));

            $stmt->execute();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteFixture()
    {
        try {
            $query = 'DELETE FROM fixtures
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