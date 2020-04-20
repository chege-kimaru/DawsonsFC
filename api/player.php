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
require_once 'models/Player.php';

try {
    $database = new Database();
    $db = $database->connect();
    $player = new Player($db);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $player->name = $_POST['name'];
        $player->dob = $_POST['dob'];
        $player->player_number = $_POST['player_number'];
        $player->position = $_POST['position'];
        $player->club_id = $_POST['club_id'];

        if ($_FILES['image'] && $_FILES['image']['name']) {
            $fileName = time() . '-' . $_FILES['image']['name'];
            $savePath = 'api/public/' . $fileName;
            $path = __DIR__ . '/public/' . $fileName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                $player->image = $savePath;
            } else {
                throw new Exception('Could not upload image');
            }
        }

        if ($_POST['id']) {
            $player->id = $_POST['id'];

            $p = $player->getPlayerById();
            $player->image = $player->image ? $player->image : $p->image;

            $player->updatePlayer();
            http_response_code(200);
            echo json_encode(array('data' => 'Successfully updated player'));
            exit;
        } else {
            $player->addPlayer();
            http_response_code(200);
            echo json_encode(array('data' => 'Successfully added player'));
            exit;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        http_response_code(200);
        $player->club_id = $_GET['club_id'];
        echo json_encode($player->getPlayers());
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        http_response_code(200);
        $player->id = $_GET['id'];
        $player->deletePlayer();
        echo json_encode(array('data' => 'Successfully deleted player'));
        exit;
    }


} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
}