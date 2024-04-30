<?php
// Connection details
include('db_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($cid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($cid)">Confirm</button>
            <button onclick="returnToMilkcollection()">Back</button>
        </div>
    </div>
HTML;
}
?>

<script>
function confirmDeletion(cid) {
    window.location.href = '?collection_id=' + cid + '&confirm=yes';
}
function returnToMilkcollection() {
    window.location.href = 'milkcollection.php';
}
</script>

<?php
// Check if collection_id is set
if(isset($_REQUEST['collection_id'])) {
    $cid = $_REQUEST['collection_id'];
    // Check if confirmation is received
    if(isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM milkcollection WHERE collection_id=?");
        $stmt->bind_param("i", $cid);

        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        showDeleteConfirmation($cid);
    }
} else {
    echo "collection_id is not set.";
}

$connection->close();
?>
