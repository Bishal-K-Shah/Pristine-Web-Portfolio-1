<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup_style.css">
</head>
<body>
     <header>
		<nav>
			<div class="logo">
			  <img src="images/sample_logo.svg">
			</div>
			
			<div class="items">
			  <a href="index.html" >Home</a>
			  <a href="dashboard.php">Service</a>
			  <a href="about.html">About</a>
			  <a href="contact.html">Contact</a>
			  
			</div>

			<div class="other">
			  <a href="dashboard.php"><button>Log in</button></a>
			</div>
		</nav>
	</header>
	
    <main>
        <h1>Sign Up</h1>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="form-row">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" required>
            </div>
            <div class="form-row">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" required>
            </div>
            <div class="form-row">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
            </div>
            <div class="form-row">
                <label for="country-location">Country Location:</label>
                <input type="text" id="country-location" name="country-location" required>
            </div>
            <div class="form-row">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-row">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Password must be at least 8 characters long and contain at least one number, one uppercase letter, and one lowercase letter" required>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </main>
</body>
</html>

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

// Handle sign up form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $dob = $_POST['dob'];
    $country = $_POST['country-location'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hashing the password using password_hash() using Bcrypt algorithm
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the query
    $query = "INSERT INTO users (first_name, last_name, dob, country, email, password) VALUES ('$firstName', '$lastName', '$dob', '$country', '$email', '$hashedPassword')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Registration successful, perform further actions
        echo "<script>
                setTimeout(function() {
                alert('Registration successful! You can now login.');
                window.location.href = 'login.php';
                }, 100);
            </script>";
    } else {
        // Registration failed
        echo "<script>
                setTimeout(function() {
                alert('Registration Failed.');
                }, 100);
            </script>";
    }
}

// Close the database connection
mysqli_close($conn);
?>