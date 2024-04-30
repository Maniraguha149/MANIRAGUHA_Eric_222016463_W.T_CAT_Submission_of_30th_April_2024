<?php
// Connection details
include('db_connection.php');

// Check if Payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $pid = $_REQUEST['payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE payment_id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $y = $row['payment_amount'];
        $z = $row['payment_date'];
        $w = $row['farmer_id'];
        $c = $row['collection_id'];
    } else {
        echo "Payment not found.";
        exit; // Exiting here as no further action needed if payment not found
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Payments</title>
    <!-- JavaScript validation and content load for update or modify data -->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmUpdate()">
        <label for="payamount">Payment Amount:</label>
        <input type="number" name="payamount" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="paydate">Payment Date:</label>
        <input type="date" name="paydate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="famid">Farmer ID:</label>
        <input type="number" name="famid" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="collectid">Collection ID:</label>
        <input type="number" name="collectid" value="<?php echo isset($c) ? $c : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>

    <?php
    if(isset($_POST['up'])) {
        // Retrieve updated values from form
        $payment_amount = $_POST['payamount'];
        $payment_date = $_POST['paydate'];
        $farmer_id = $_POST['famid'];
        $collection_id = $_POST['collectid'];
        
        // Update the payments in the database
        $stmt = $connection->prepare("UPDATE payments SET payment_amount=?, payment_date=?, farmer_id=?, collection_id=? WHERE payment_id=?");
        $stmt->bind_param("isiii", $payment_amount, $payment_date, $farmer_id, $collection_id, $pid);
        $stmt->execute();
        
        // Redirect to payments.php
        header('Location: payments.php');
        exit(); // Ensure that no other content is sent after the header redirection
    }
    ?>
</body>
</html>
