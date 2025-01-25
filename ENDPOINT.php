<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow requests from any origin

require_once '../config/database.php';

$connection = new mysqli($host, $user, $password, $database);

if ($connection->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

$query = "SELECT * FROM your_table";
$result = $connection->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$connection->close();
?>
