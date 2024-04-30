<html>
<body>
    <form method="POST">
        <label for="fname">Farmer Name:</label>
        <input type="text" name="fname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="fcontact_number">Contact Number:</label>
        <input type="text" name="fcontact_number" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="faddress">Address:</label>
        <input type="text" name="faddress" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>



<?php
// Connection details
$host = "localhost";
$user = "eric2001";
$pass = "222016463";
$database = "milkdiary_collection_management_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $farmer_name = $_POST['fname'];
    $contact_number = $_POST['fcontact_number'];
    $address = $_POST['faddress'];

    // Assuming $connection is your database connection object
    // Assuming $fid is already defined and contains the farmer_id

    // Update the farmer in the database
    $stmt = $connection->prepare("UPDATE farmers SET farmer_name=?, contact_number=?, address=? WHERE farmer_id=?");
    $stmt->bind_param("sssi", $farmer_name, $contact_number, $address, $fid);
    $stmt->execute();

    // Output message for successful update
    //echo "Data updated successfully.";
    header('Location:farmers.php');

    // Exit script to ensure no further content is sent
    exit();
}
?>
