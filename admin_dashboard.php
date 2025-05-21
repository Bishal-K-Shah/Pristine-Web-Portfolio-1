<?php
// Included the session.php file to handle user authentication
include('session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    </style>
    <link rel="stylesheet" href="css/dashboard_style.css">
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <img src="images/sample_logo.svg">
            </div>
            <div class="items">
                <a href="index.html">Home</a>
                <a href="#">Service</a>
                <a href="about.html">About</a>
                <a href="contact.html">Contact</a>
            </div>

            <div class="user-section">
                <span class="user-name">Admin</span>
                <div class="dropdown">
                    <div class="profile-picture">
                        <img src="images/Profile_Pic.jpg" alt="Profile Picture">
                    </div>

                    <div class="dropdown-content">
                        <a href="profile_settings.php">Account Settings</a>
                        <a href="admin_logout.php">Log out</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="sidebar">
            <h2>Menu</h2>
            <nav>
                <ul>
                    <li><a href="#" class="active" data-target="dash1" onclick="changeActive(this)">Projects</a></li>
                    <li><a href="#" data-target="dash2" onclick="changeActive(this)">Clients</a></li>
                    <li><a href="#" data-target="dash3" onclick="changeActive(this)">Edit</a></li>
                </ul>
            </nav>
        </div>

        <div id="dash1" class="dashboard">
            <h1>Web Projects</h1>
            <?php include 'dashboard/admin_dashboard_1.php'; ?>
        </div>

        <div id="dash2" class="dashboard" style="display:none">
            <h1>Clients</h1>
            <?php include 'dashboard/admin_dashboard_2.php'; ?>
        </div>

        <div id="dash3" class="dashboard" style="display:none">
            <h1>Edit</h1>

        </div>

    </main>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        /* Main Content Styles */
        main {
            box-sizing: border-box;
            display: flex;
        }

        .sidebar {
            flex: 0 0 17%;
            background-color: #fff;
            padding: 20px;
            height: 243px;
            margin: 5px auto;
        }

        .dashboard {
            flex: 1;
            background-color: #E0E0E0;
            padding-left: 20px;
        }

        .dashboard h1 {
            text-align: center;
            margin-top: 20px;
        }

        .sidebar h2 {
            margin-bottom: 20px;
        }

        .sidebar nav ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar nav ul li {
            margin-bottom: 10px;
        }

        .sidebar nav ul li a {
            color: #553570;
            display: block;
            padding: 10px;
            text-decoration: none;
        }

        .sidebar nav ul li a:hover {
            background-color: #ddd;
            color: #333;
        }

        .sidebar .active {
            background-color: #ddd;
            color: #333;
        }
    </style>

    <script>
        const links = document.querySelectorAll('.sidebar nav ul li a');
        const dashboards = document.querySelectorAll('.dashboard');

        function changeActive(link) {
            links.forEach(link => {
                link.classList.remove('active');
            });
            link.classList.add('active');
        }

        links.forEach(link => {
            link.addEventListener('click', e => {
                e.preventDefault();
                const target = e.target.dataset.target;
                dashboards.forEach(dashboard => {
                    if (dashboard.id === target) {
                        dashboard.style.display = 'block';
                    } else {
                        dashboard.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>