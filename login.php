<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login_style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
              <img src="images/sample_logo.svg">
            </div>
            
            <div class="items">
              <a href="index.html">Home</a>
              <a href="dashboard.php">Service</a>
              <a href="about.html">About</a>
              <a href="contact.html">Contact</a>
              
            </div>

            <div class="other">
              <a href="signup.php"><button>Sign Up</button></a>
            </div>
        </nav>
    </header>
    <main>
        <h1>Login</h1>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-row">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Password must be at least 8 characters long and contain at least one number, one uppercase letter, and one lowercase letter" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </main>
</body>
</html>

<?php
session_start(); // Start the session at the beginning of the file

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

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    // Check if the query returned any rows
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        // Verify the entered password against the stored hashed password using password_verify()
        if (password_verify($password, $storedPassword)) {
            // Login successful, retrieve first name and last name
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $userID = $row['user_id'];
            
            // Store user data in the session
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $firstName;
            $_SESSION['user_id'] = $userID;
            
            // Redirect to the dashboard page after successful login
            header('Location: dashboard.php');
            exit();
        } else {
            // Invalid password
            echo "<script>
                    setTimeout(function() {
                        alert('Invalid password. Make sure you entered your details correctly.');
                    }, 100);
                </script>";
        }
    } else {
        // Invalid email
        echo "<script>
                setTimeout(function() {
                    alert('Invalid email or password. Make sure you entered your details correctly.');
                }, 100);
            </script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>