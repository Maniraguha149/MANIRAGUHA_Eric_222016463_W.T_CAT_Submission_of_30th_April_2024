<?php
// Connection details
include('db_connection.php');

// Check if farmer Id is set
if(isset($_REQUEST['farmer_id'])) {
    $famid = $_REQUEST['farmer_id'];
    
    $stmt = $connection->prepare("SELECT * FROM farmers WHERE farmer_id=?");
    $stmt->bind_param("i", $famid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['farmer_name'];
        $z = $row['contact_number'];
        $w = $row['address'];
    } else {
        echo "Farmer not found.";
        exit; // Exiting here as no further action needed if farmer not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Farmer</title>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="famname">Farmer Name:</label>
        <input type="text" name="famname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="phone">Contact Number:</label>
        <input type="number" name="phone" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($w) ? $w : ''; ?>">
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
    $farmer_name = $_POST['famname'];
    $contact_number = $_POST['phone'];
    $address = $_POST['address'];
    
    // Update the farmer in the database
    $stmt = $connection->prepare("UPDATE farmers SET farmer_name=?, contact_number=?, address=? WHERE farmer_id=?");
    $stmt->bind_param("sssi", $farmer_name, $contact_number, $address, $famid);
    $stmt->execute();
    
    // Redirect to farmers.php after update
    header('Location: farmers.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
