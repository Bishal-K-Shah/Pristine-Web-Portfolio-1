<!DOCTYPE html>
<html>
<head>
  <style>
    table {
      width: 90%;
      margin: 20px auto;
      margin-bottom: 200px;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid;
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pristine_web_itech_db";

// Establish database connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch data from the 'users' table
$sql = "SELECT user_id, first_name, last_name, dob, country, email FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Country</th>
            <th>Email</th>
          </tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['user_id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['dob']}</td>
                <td>{$row['country']}</td>
                <td>{$row['email']}</td>
              </tr>";
    }
    
    echo "</table>";
} else {
    echo "No records found.";
}

// Close the database connection
mysqli_close($conn);
?>

</body>
</html>
