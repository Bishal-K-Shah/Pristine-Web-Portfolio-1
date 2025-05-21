
<?php

session_start();

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
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form-type'] == 'signup') {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $dob = $_POST['dob'];
    $country = $_POST['country-location'];
    $email = $_POST['signup_email'];
    $password = $_POST['signup_password'];

    // Hashing the password using password_hash() using Bcrypt algorithm
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare and execute the query
    $query = "INSERT INTO admins (first_name, last_name, dob, country, email, password) VALUES ('$firstName', '$lastName', '$dob', '$country', '$email', '$hashedPassword')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Registration successful, perform further actions
        echo "<script>
                                setTimeout(function() {
                                alert('Registration successful! You can now login.');
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

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form-type'] == 'login') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $query = "SELECT * FROM admins WHERE email = '$email'";
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

            // Store user data in the session
            $_SESSION['email'] = $email;
            $_SESSION['first_name'] = $firstName;
            // Redirect to the dashboard page after successful login
            header('Location: admin_dashboard.php');
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
                <a href="index.html">Home</a>
                <a href="dashboard.php">Service</a>
                <a href="about.html">About</a>
                <a href="contact.html">Contact</a>
                <a href="admin_dashboard.php" class="active">Admin</a>

            </div>

            <div class="other">
                <a href="dashboard.php"><button>Client</button></a>
            </div>
        </nav>
    </header>

    <h1 style="text-align:center; margin-top:0px;">Admin Portal</h1>
    <div class="forms">
        <main>
            <h1>Sign Up</h1>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <?php if (isset($error)) : ?>
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
                    <input type="email" id="signup_email" name="signup_email" required>
                </div>
                <div class="form-row">
                    <label for="password">Password:</label>
                    <input type="password" id="signup_password" name="signup_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters long and contain at least one number, one uppercase letter, and one lowercase letter" required>
                </div>
                <input type="hidden" name="form-type" value="signup">
                <button type="submit">Sign Up</button>
            </form>
        </main>
        <div class="form2">
            <h1>Login</h1>
            <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

                <div class="form-row2">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-row2">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must be at least 8 characters long and contain at least one number, one uppercase letter, and one lowercase letter" required>
                </div>
                <input type="hidden" name="form-type" value="login">
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <style>
        .form2 {
            max-width: 400px;
            margin: 0 auto;
            padding: 30px 30px 60px 55px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

        }

        .form-row2 {
            width: 90%;
            margin-bottom: 20px;
        }

        main {
            display: inline-block;
            vertical-align: top;
            width: 50%;
        }

        .form2 {
            display: inline-block;
            vertical-align: top;
            width: 40%;
            margin-left: 5%;
            margin-right: 5%;
        }

        .forms {
            display: flex;
            justify-content: space-evenly;
        }
    </style>
</body>

</html>
