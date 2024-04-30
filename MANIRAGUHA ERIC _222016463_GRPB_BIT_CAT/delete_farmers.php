<?php
// Connection details
include('db_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($fid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($fid)">Confirm</button>
            <button onclick="returnToFarmers()">Back</button>
        </div>
    </div>
    <script>
    function confirmDeletion(fid) {
        window.location.href = '?farmer_id=' + fid + '&confirm=yes';
    }
    function returnToFarmers() {
        window.location.href = 'farmers.php';
    }
    </script>
HTML;
}

// Check if farmer_id is set
if(isset($_REQUEST['farmer_id'])) {
    $fid = $_REQUEST['farmer_id'];

    // Check if confirmation is received
    if(isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM farmers WHERE farmer_id=?");
        $stmt->bind_param("i", $fid);

        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Show delete confirmation
        showDeleteConfirmation($fid);
    }
} else {
    echo "farmer_id is not set.";
}

$connection->close();
?>
