<?php
// Included the session.php file to handle user authentication
include('session.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Your Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboard_style.css">
    <script type="text/javascript" src="dashboard/JS/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="dashboard/JS/input_style.css">
    <script type="text/javascript" src="dashboard/JS/input_logic.js"></script>
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

            <div class="user-section">
                <span class="user-name"><?php echo $_SESSION['first_name']; ?></span>
                <div class="dropdown">
                    <div class="profile-picture">
                        <img src="images/Profile_Pic.jpg" alt="Profile Picture">
                    </div>

                    <div class="dropdown-content">
                        <a href="profile_settings.php">Account Settings</a>
                        <a href="logout.php">Log out</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>



    <div id="first_section" style="display: block;">
        <?php include('dashboard/user_dashboard_1.php'); ?>
    </div>
    
    <div id="second_section" style="display: none;">
        <?php include('dashboard/user_dashboard_2.php'); ?>
    </div>

    <div id="dash_card">
        <?php include('dashboard/website_card.php'); ?>
    </div>
    
    <script>
        questionnaire1.onComplete.add(function (result) {
            document.getElementById("first_section").style.display = "none";
            document.getElementById("second_section").style.display = "block";
            window.scrollTo(0, 0);
        });
    </script>
    </main>

</body>

</html>