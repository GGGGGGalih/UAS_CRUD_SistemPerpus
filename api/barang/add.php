<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../config/database.php";
include_once "../../data/perpus.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$perpus= new shop ($conn);

$data = json_decode(file_get_contents("php://input"));

$response = [];

if ($request == "POST") {
    if (
        !empty($data->id) &&
        !empty($data->nama)&&
        !empty($data->jenis)&&
        !empty($data->tanggal_masuk)
    ) {
        $perpus->id = $data->id;
        $perpus->nama= $data->name;
        $perpus->jenis = $data->jenis;
        $perpus->tanggal_masuk = $data->tanggal_masuk;
 
        $data = array(
            'id' => $perpus->id,
            'nama' => $perpus->nama,
            'jenis' => $perpus->jenis,
            'tanggal_masuk' => $perpus->tanggal_masuk,
        );

        if ($perpus->add()) {
            $response = array(
                'status' =>  array('messsage' => 'Success', 'code' => http_response_code(200)), 'data' => $data
            );
        } else {
            http_response_code(400);
            $response = array('messsage' => 'Add Failed','code' => http_response_code());
        }
    } else {
        http_response_code(400);
        $response = array('status' =>  array('messsage' => 'Add Failed - Wrong Parameter', 'code' => http_response_code()));
    }
} else {
    http_response_code(405);
    $response = array('status' =>  array('messsage' => 'Method Not Allowed', 'code' => http_response_code())
    );
}

echo json_encode($response);