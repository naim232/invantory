<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    
    // Insert new item into the database
    $sql = "INSERT INTO Items (ItemName, Quantity, Price) VALUES ('$itemName', $quantity, $price)";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect back to the main page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>