<?php
require_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemID = $_POST["item_id"];
    $newQuantity = $_POST["new_quantity"];
    $newPrice = $_POST["new_price"];

    // Update item details
    $sql = "UPDATE Items SET Quantity = $newQuantity, Price = $newPrice WHERE ID = $itemID";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect back to the main page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET["id"])) {
    $itemID = $_GET["id"];
    
    // Fetch item details
    $sql = "SELECT * FROM Items WHERE ID = $itemID";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Item</title>
</head>

<body>
    <h1>Edit Item</h1>
    <form action="edit_item.php" method="post">
        <input type="hidden" name="item_id" value="<?php echo $itemID; ?>">
        <label for="new_quantity">New Quantity:</label>
        <input type="number" name="new_quantity" value="<?php echo $item['Quantity']; ?>" required>
        <label for="new_price">New Price:</label>
        <input type="number" step="0.01" name="new_price" value="<?php echo $item['Price']; ?>" required>
        <button type="submit">Update Item</button>
    </form>
</body>

</html>