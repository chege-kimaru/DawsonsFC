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
require_once 'models/Admin.php';

try {
    $database = new Database();
    $db = $database->connect();
    $admin = new Admin($db);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $admin->id = $_POST['id'];
        $admin->username = $_POST['username'];
        $admin->email = $_POST['email'];
        $admin->role = $_POST['role'];
        $admin->password = $_POST['password'];

        if ($_GET['type'] === 'register') {

            $admin->register();
            http_response_code(201);
            echo json_encode(array('data' => 'Successfully added admin'));
            exit;
        } else if ($_GET['type'] === 'login') {
            $res = $admin->login();
            if ($res) {
                http_response_code(200);
                echo json_encode($res);
            } else {
                http_response_code(401);
                echo json_encode(array('data' => 'Wrong username or password'));
            }
            exit;
        } else if ($_GET['type'] === 'change-password') {
            if ($admin->login()) {
                $admin->changePassword($_POST['newPassword']);
                http_response_code(200);
                echo json_encode(array('data' => 'Successfully changed password'));
            } else {
                http_response_code(401);
                echo json_encode(array('data' => 'Wrong username or password'));
            }
            exit;
        } else if ($_GET['type'] === 'change-role') {
            $admin->changeRole();
            http_response_code(200);
            echo json_encode(array('data' => 'Successfully changed role'));
            exit;
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        http_response_code(200);
        echo json_encode($admin->getAdmins());
    }


} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array('error' => $e->getMessage()));
}