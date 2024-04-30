<?php
// Connection details
include('db_connection.php');

// Check if Collection_id is set
if(isset($_REQUEST['collection_id'])) {
    $cid = $_REQUEST['collection_id'];
    
    $stmt = $connection->prepare("SELECT * FROM milkcollection WHERE collection_id=?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['farmer_id'];
        $z = $row['collection_date'];
        $w = $row['quantity'];
    } else {
        echo "Milk Collection not found.";
        exit; // Exiting here as no further action needed if collection not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Milk Collection</title>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="famid">Farmer ID:</label>
        <input type="number" name="famid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="collectdate">Collection Date:</label>
        <input type="date" name="collectdate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="qty">Quantity:</label>
        <input type="number" name="qty" value="<?php echo isset($w) ? $w : ''; ?>">
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
    $farmer_id = $_POST['famid'];
    $collection_date = $_POST['collectdate'];
    $quantity = $_POST['qty'];
    
    // Update the milkcollection in the database
    $stmt = $connection->prepare("UPDATE milkcollection SET farmer_id=?, collection_date=?, quantity=? WHERE collection_id=?");
    $stmt->bind_param("isii", $farmer_id, $collection_date, $quantity, $cid);
    $stmt->execute();
    
    // Redirect to milkcollection.php after update
    header('Location: milkcollection.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
