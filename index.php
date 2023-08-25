<?php
require_once("config.php");

// Fetch inventory items from the database
$sql = "SELECT * FROM Items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inventory Management System</title>
    <style>
    .low-stock {
        background-color: #FFCCCC;
        /* Red background for low stock items */
    }
    </style>
</head>

<body>
    <h1>Inventory Items</h1>

    <!-- Add new item form -->
    <h2>Add New Item</h2>
    <form action="add_item.php" method="post">
        <label for="item_name">Item Name:</label>
        <input type="text" name="item_name" required>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>
        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" required>
        <button type="submit">Add Item</button>
    </form>

    <table>
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <!-- Display existing items -->
        <?php
        while ($row = $result->fetch_assoc()) {
            $quantity = $row["Quantity"];
            $rowClass = $quantity < 10 ? "low-stock" : "";
            
            echo "<tr class='$rowClass'>";
            echo "<td>" . $row["ItemName"] . "</td>";
            echo "<td>" . $quantity . "</td>";
            echo "<td>$" . $row["Price"] . "</td>";
            echo "<td><a href='edit_item.php?id=" . $row["ID"] . "'>Edit</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    // Calculate the total value of the entire inventory
    $totalValue = 0;
    $result->data_seek(0); // Reset the result pointer
    while ($row = $result->fetch_assoc()) {
        $itemValue = $row["Quantity"] * $row["Price"];
        $totalValue += $itemValue;
    }
    ?>

    <!-- Display total value -->
    <p>Total Inventory Value: $<?php echo number_format($totalValue, 2); ?></p>
</body>

</html>