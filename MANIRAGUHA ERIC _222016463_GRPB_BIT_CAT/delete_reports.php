<?php
// Connection details
include('db_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($rid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($rid)">Confirm</button>
            <button onclick="returnToReports()">Back</button>
        </div>
    </div>
HTML;
}
?>

<script>
function confirmDeletion(rid) {
    window.location.href = '?report_id=' + rid + '&confirm=yes';
}
function returnToReports() {
    window.location.href = 'reports.php';
}
</script>

<?php
// Check if report_id is set
if(isset($_REQUEST['report_id'])) {
    $rid = $_REQUEST['report_id'];
    
    // Check if confirmation is received
    if(isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM reports WHERE report_id=?");
        $stmt->bind_param("i", $rid);
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        showDeleteConfirmation($rid);
    }
} else {
    echo "report_id is not set.";
}

$connection->close();
?>
