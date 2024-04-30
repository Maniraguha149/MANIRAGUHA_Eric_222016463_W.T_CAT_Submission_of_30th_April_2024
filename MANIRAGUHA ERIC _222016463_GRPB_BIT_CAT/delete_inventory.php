<?php
// Connection details
include('db_connection.php');

// Function to show delete confirmation
function showDeleteConfirmation($iid) {
    echo <<<HTML
    <div id="confirmModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); display: flex; justify-content: center; align-items: center;">
        <div style="background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 15px rgba(0,0,0,0.2);">
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this record?</p>
            <button onclick="confirmDeletion($iid)">Confirm</button>
            <button onclick="returnToInventory()">Back</button>
        </div>
    </div>
HTML;
}
?>

<script>
function confirmDeletion(iid) {
    window.location.href = '?inventory_id=' + iid + '&confirm=yes';
}
function returnToInventory() {
    window.location.href = 'inventory.php';
}
</script>

<?php
// Check if inventory_id is set
if(isset($_REQUEST['inventory_id'])) {
    $iid = $_REQUEST['inventory_id'];
    
    // Check if confirmation is received
    if(isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // Prepare and execute the DELETE statement
        $stmt = $connection->prepare("DELETE FROM inventory WHERE inventory_id=?");
        $stmt->bind_param("i", $iid);
        
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Show delete confirmation
        showDeleteConfirmation($iid);
    }
} else {
    echo "inventory_id is not set.";
}

$connection->close();
?>
