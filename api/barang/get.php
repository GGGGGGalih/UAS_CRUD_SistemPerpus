<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../config/database.php";
include_once "../../data/perpus.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$perpus = new shop ($conn);
$perpus->id = isset($_GET['id']) ? $_GET['id'] : die();

$perpus->get();

$response = [];

if ($request == 'GET') {
    if ($perpus->id != null) {
        $data[] = array('id' => $perpus->id,'nama' => $perpus->nama,'jenis' => $perpus->jenis,'tanggal_masuk' => $perpus->tanggal_masuk,);
        $response = array('status' =>  array('messsage' => 'Success', 'code' => http_response_code(200)),'data' => $data);
    } else {
        http_response_code(404);
        $response = array('status' =>  array('messsage' => 'No Data Found', 'code' => http_response_code()));
    }
} else {
    http_response_code(405);
    $response = array('status' =>  array('messsage' => 'Method Not Allowed', 'code' => http_response_code()));
}

echo json_encode($response);