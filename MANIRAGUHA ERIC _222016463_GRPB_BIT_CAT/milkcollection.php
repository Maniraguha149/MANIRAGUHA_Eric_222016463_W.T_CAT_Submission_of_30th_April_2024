<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home milkcollection</title>

  <style>
  .dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;
  }
  .dropdown-contents {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
  }
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  .dropdown-contents a:hover {
    background-color: #f1f1f1;
  }
</style>
</head>
<header>
<body bgcolor="chocolate">
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><a href="./home.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./farmers.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">farmers</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./inventory.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">inventory</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./milkcollection.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">milkcollection</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./payments.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">payments</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./reports.php" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">reports</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
  <!-- <div class="col-3 offset">-->
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
</header>
<section>
    <h1>Milk Collection Form</h1>
    <form method="post">

        <label for="collection_id">Collection ID:</label>
        <input type="number" id="collection_id" name="collection_id"><br><br>

        <label for="famid">Farmer ID:</label>
        <input type="number" id="famid" name="famid" required><br><br>

        <label for="collectdate">Collection Date:</label>
        <input type="date" id="collectdate" name="collectdate" required><br><br>

        <label for="qty">Quantity:</label>
        <input type="number" id="qty" name="qty" required><br><br>

        <input type="submit" name="insert" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>

    </form>

    <?php
   // Connection details
   include 'db_connection.php';
   
    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
        // Insert section
        $stmt = $connection->prepare("INSERT INTO milkcollection(collection_id, farmer_id, collection_date, quantity) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $collection_id, $famid, $collectdate, $qty);

        // Set parameters from POST and execute
        $collection_id = $_POST['collection_id'];
        $famid = $_POST['famid'];
        $collectdate = $_POST['collectdate'];
        $qty = $_POST['qty'];

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>
                 <a href='milkcollection.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    } 
    ?>

    <table>
        <table border="1">
        <tr>
            <th>Collection ID</th>
            <th>Farmer ID</th>
            <th>Collection Date</th>
            <th>Quantity</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // SQL query to fetch data from the milkcollection table
        $sql = "SELECT * FROM milkcollection";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $collection_id = $row["collection_id"]; // Added this line to fetch Collection ID
                echo "<tr>
                    <td>" . $row["collection_id"] . "</td>
                    <td>" . $row["farmer_id"] . "</td>
                    <td>" . $row["collection_date"] . "</td> 
                    <td>" . $row["quantity"] . "</td>
                    <td><a style='padding:4px' href='delete_milkcollection.php?collection_id=$collection_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_milkcollection.php?collection_id=$collection_id'>Update</a></td> 
                  </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close connection
        $connection->close();
        ?>
    </table>
</section>
  </center>

  <footer>
       <marquee><i style="color: green;">&copy; 2024</i><b>WEB TECHNOLOGY CAT</b></marquee>
  <footer>
</body>
</html>
