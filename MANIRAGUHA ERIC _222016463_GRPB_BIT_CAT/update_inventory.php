<?php
// Connection details
include('db_connection.php');

// Check if inventory_id is set
if(isset($_REQUEST['inventory_id'])) {
    $iid = $_REQUEST['inventory_id'];
    
    $stmt = $connection->prepare("SELECT * FROM inventory WHERE inventory_id=?");
    $stmt->bind_param("i", $iid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['collection_id'];
        $z = $row['expiration_date'];
        $w = $row['quantity'];
    } else {
        echo "Inventory not found.";
        exit; // Exiting here as no further action needed if inventory not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Inventory</title>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="collect_id">Collection ID:</label>
        <input type="number" name="collect_id" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="expdate">Expiration Date:</label>
        <input type="date" name="expdate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>

    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $collection_id = $_POST['collect_id'];
    $expiration_date = $_POST['expdate'];
    $quantity = $_POST['quantity'];
    
    // Update the inventory in the database
    $stmt = $connection->prepare("UPDATE inventory SET collection_id=?, expiration_date=?, quantity=? WHERE inventory_id=?");
    $stmt->bind_param("isii", $collection_id, $expiration_date, $quantity, $iid);
    $stmt->execute();
    
    // Redirect to inventory.php after update
    header('Location: inventory.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
