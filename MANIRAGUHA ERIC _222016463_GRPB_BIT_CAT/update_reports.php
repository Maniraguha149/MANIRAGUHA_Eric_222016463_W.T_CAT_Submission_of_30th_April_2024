<?php
// Connection details
include('db_connection.php');

// Check if report_id is set
if(isset($_REQUEST['report_id'])) {
    $rid = $_REQUEST['report_id'];
    
    $stmt = $connection->prepare("SELECT * FROM reports WHERE report_id=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['report_date'];
        $z = $row['total_milk_collacted'];
        
    } else {
        echo "Report not found.";
        exit; // Exiting here as no further action needed if report not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Reports</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="repdate">Report Date:</label>
        <input type="date" name="repdate" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="tomlkcoll">Total Milk Collected:</label>
        <input type="number" name="tomlkcoll" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $report_date = $_POST['repdate'];
        $total_milk_collected = $_POST['tomlkcoll'];
        
        // Update the reports in the database
        $stmt = $connection->prepare("UPDATE reports SET report_date=?, total_milk_collacted=? WHERE report_id=?");
        $stmt->bind_param("sii", $report_date, $total_milk_collected, $rid);
        $stmt->execute();
        
        // Redirect to reports.php
        header('Location: reports.php');
        exit(); // Ensure that no other content is sent after the header redirection
    }
    ?>
</body>
</html>
