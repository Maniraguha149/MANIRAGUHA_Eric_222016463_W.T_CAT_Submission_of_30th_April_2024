<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home farmers</title>

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
    <h1>Farmers Form</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="famid">Farmer Id:</label>
        <input type="number" id="famid" name="famid" required><br><br>

        <label for="fname">Farmer Name:</label>
        <input type="text" id="fname" name="fname" required><br><br>

        <label for="phone">Contact Number:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="address">Farmer Address:</label>
        <input type="text" id="address" name="address" required><br><br>

        
        </select><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
   // Connection details
   include 'db_connection.php';
   
    // Check if the form is submitted for insert
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Insert section
        $stmt = $connection->prepare("INSERT INTO farmers(farmer_id, farmer_name, contact_number, address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $famid, $fname, $phone, $address);

        // Set parameters from POST and execute
        $famid = $_POST['famid'];
        $fname = $_POST['fname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br>
                 <a href='farmers.html'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    } 
    ?>

    <h2>Table of Farmers</h2>
    <table border="1">
        <tr>
            <th>Farmer Id</th>
            <th>Farmer Name</th>
            <th>Contact Number</th>
            <th>Farmer Address</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // SQL query to fetch data from the farmers table
        $sql = "SELECT * FROM farmers";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $famid = $row["farmer_id"]; // Fetch Farmer Id
                echo "<tr>
                    <td>" . $row["farmer_id"] . "</td>
                    <td>" . $row["farmer_name"] . "</td>
                    <td>" . $row["contact_number"] . "</td> 
                    <td>" . $row["address"] . "</td>
                    <td><a style='padding:4px' href='delete_farmers.php?farmer_id=$famid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_farmers.php?farmer_id=$famid'>Update</a></td> 
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
