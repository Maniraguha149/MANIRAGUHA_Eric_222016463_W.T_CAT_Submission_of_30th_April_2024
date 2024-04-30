<?php
// Connection details
include('db_connection.php');

// Check if the search term is provided
if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query for farmers
    $sql = "SELECT * FROM farmers WHERE farmer_name LIKE '%$searchTerm%'";
    $result_farmers = $connection->query($sql);

    // Perform the search query for inventory
    $sql = "SELECT * FROM inventory WHERE collection_id LIKE '%$searchTerm%'";
    $result_inventory = $connection->query($sql);

    // Perform the search query for milk collection
    $sql = "SELECT * FROM milkcollection WHERE quantity LIKE '%$searchTerm%'";
    $result_milkcollection = $connection->query($sql);

    // Perform the search query for payments
    $sql = "SELECT * FROM payments WHERE payment_amount LIKE '%$searchTerm%'";
    $result_payments = $connection->query($sql);

    // Perform the search query for reports
    $sql = "SELECT * FROM reports WHERE report_date LIKE '%$searchTerm%'";
    $result_reports = $connection->query($sql);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    echo "<h3>Farmers:</h3>";
    if ($result_farmers->num_rows > 0) {
        while ($row = $result_farmers->fetch_assoc()) {
            echo "<p>" . $row['farmer_name'] . "</p>";
        }
    } else {
        echo "<p>No farmers found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Inventory:</h3>";
    if ($result_inventory->num_rows > 0) {
        while ($row = $result_inventory->fetch_assoc()) {
            echo "<p>" . $row['collection_id'] . "</p>";
        }
    } else {
        echo "<p>No inventory found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Milk Collection:</h3>";
    if ($result_milkcollection->num_rows > 0) {
        while ($row = $result_milkcollection->fetch_assoc()) {
            echo "<p>" . $row['quantity'] . "</p>";
        }
    } else {
        echo "<p>No milk collection found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Payments:</h3>";
    if ($result_payments->num_rows > 0) {
        while ($row = $result_payments->fetch_assoc()) {
            echo "<p>" . $row['payment_amount'] . "</p>";
        }
    } else {
        echo "<p>No payments found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>Reports:</h3>";
    if ($result_reports->num_rows > 0) {
        while ($row = $result_reports->fetch_assoc()) {
            echo "<p>" . $row['report_date'] . "</p>";
        }
    } else {
        echo "<p>No reports found matching the search term: " . $searchTerm . "</p>";
    }

    // Close the database connection
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
