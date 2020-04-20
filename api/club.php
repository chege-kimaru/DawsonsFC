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
require_once 'models/Club.php';

try {
    $database = new Database();
    $db = $database->connect();
    $club = new Club($db);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $club->name = $_POST['name'];
        $club->location = $_POST['location'];
        $club->stadium_id = $_POST['stadium_id'];
        $club->coach = $_POST['coach'];
        $club->year = $_POST['year'];
        $club->about = $_POST['about'];

        if ($_FILES['image'] && $_FILES['image']['name']) {
            $fileName = time() . '-' . $_FILES['image']['name'];
            $savePath = 'api/public/' . $fileName;
            $path = __DIR__ . '/public/' . $fileName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                $club->image = $savePath;
            } else {
                throw new Exception('Could not upload image');
            }
        }

        if ($_POST['id']) {
            $club->id = $_POST['id'];
            $c = $club->getClubById();
            $club->image = $club->image ? $club->image : $c->image;

            $club->updateClub();
            http_response_code(200);
            echo json_encode(array('data' => 'Successfully updated club'));
            exit;
        } else {
            $club->addClub();
            http_response_code(200);
            echo json_encode(array('data' => 'Successfully added club'));
            exit;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        http_response_code(200);
        if($_GET['id']) {
            $club->id = $_GET['id'];
            echo json_encode($club->getClubById());
            exit;
        }
        echo json_encode($club->getClubs());
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $club->id = $_GET['id'];
        $club->deleteClub();
        http_response_code(200);
        echo json_encode(array('data' => 'Successfully deleted club'));
        exit;
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
}