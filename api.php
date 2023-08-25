<?php
require_once("config.php");

// Set the response header to JSON

header("Content-Type: application/json");

// Fetch inventory items from the database
$sql = "SELECT * FROM Items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $items = array();
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode($items);
} else {
    echo json_encode(array("message" => "No items found."));
}

// Close the database connection
$conn->close();
?>