
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
?>