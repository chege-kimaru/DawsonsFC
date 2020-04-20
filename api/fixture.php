<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, PUT, GET, OPTIONS, DELETE, PATCH');
header('Access-Control-Allow-Headers: Access-Control-Allow-Methods, Access-Control-Allow-Origin, Content-Type, X-Requested-With, Authorization');
header('Access-Control-Request-Headers: Access-Control-Allow-Methods, Access-Control-Allow-Origin, Content-Type, X-Requested-With, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit;
}

require_once 'config/Database.php';
require_once 'models/Fixture.php';

try {
    $database = new Database();
    $db = $database->connect();
    $fixture = new Fixture($db);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fixture->home_id = $_POST['home_id'];
        $fixture->away_id = $_POST['away_id'];
        $fixture->match_date = $_POST['match_date'];
        $fixture->goals_away = $_POST['goals_away'] ? $_POST['goals_away'] : 0;
        $fixture->goals_home = $_POST['goals_home'] ? $_POST['goals_home'] : 0;
        $fixture->match_played = $_POST['match_played'] ? $_POST['match_played'] : 0;

        if ($_POST['id']) {
            $fixture->id = $_POST['id'];
            $fixture->updateFixture();
            http_response_code(200);
            echo json_encode(array('data' => 'Successfully updated fixture'));
            exit;
        } else {
            $fixture->addFixture();
            http_response_code(200);
            echo json_encode(array('data' => 'Successfully added fixture'));
            exit;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        http_response_code(200);
        echo json_encode($fixture->getFixtures());
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        http_response_code(200);
        $fixture->id = $_GET['id'];
        $fixture->deleteFixture();
        echo json_encode(array('data' => 'Successfully deleted fixture'));
        exit;
    }


} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
}