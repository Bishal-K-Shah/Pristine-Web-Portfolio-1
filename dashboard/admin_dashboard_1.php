<?php

//echo "<script>console.log('PHP: " . $_SESSION['user_id'] . "');</script>";


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


// Prepare and execute the query
$query = "SELECT * FROM customer_data ORDER BY invoice_id DESC";
$result = mysqli_query($conn, $query);

// Check if the query returned any rows
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dbResultData = $row['user_data_json'];
        $db_pdf_url = $row['pdf_url'];
        //get first_name from another table
        $query1 = "SELECT first_name FROM users WHERE user_id = " . $row['user_id'];
        $result1 = mysqli_query($conn, $query1);
        $first_name = $result1->fetch_assoc()['first_name'];

        
        //echo "<script>console.log('$db_pdf_url');</script>";

        //separate the json data
        $res = json_decode($dbResultData, true);
        $pages = $res['question2']['answer'];
        //separate using , as deliminater
        $pages = explode(',', $pages);

        //html content
        echo '
            <div class="card-section">
                    <h2>User: '.$first_name.'</h2>

                    <div class="lists-container">
                        <ul>
                            <li>' . $res['question1']['answer'] . ' Type</li>
                            <li>' . $res['elements'][1]['answer'] . ' Design</li>
                            <li>' . $res['elements'][0]['answer'] . '</li>
                            <li>' . $res['question20']['answer'] . ' </li>
                            <li>' . $res['question22']['answer'] . ' </li>
                        </ul>
                        <ul>';
        foreach ($pages as $page) {
            echo '<li>' . trim($page) . '</li>';
        }
        echo '</ul>
                    </div>
                    <div class="card-buttons">
                    <a href="'.$db_pdf_url.'" download="Website_Details.pdf" class="button">View</a>
                    </div>
                </div>
            ';
    }
} else {
    echo "<script>console.log('No existing website record found!!!');</script>";
}

// Close the database connection
mysqli_close($conn);
?>

<style>    

    /* Card section styles */
    .card-section {
        box-sizing: border-box;
        max-width: 725px;
        margin: 30px auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        padding: 10px;
    }

    .card-section h2 {
        font-size: 25px;
        font-weight: bold;
        margin: 5px auto;
        color: #333;
        text-align: center;
    }

    .lists-container {
        display: flex;
        justify-content: space-evenly;
        margin-bottom: 0px;
    }

    .lists-container ul {
        list-style: none;
        margin-right: 30px;
        margin-bottom: 8px;
    }

    .lists-container li {
        margin-bottom: 10px;
        font-size: 16px;
        color: #666;
        list-style-type: disc;
    }

    .card-buttons{
        display: flex;
        justify-content: space-evenly;
    }

    .card-buttons a {
            text-decoration: none;
        }
    
    button {
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: block;
        margin: 0 auto;
        margin-bottom: 10px;
    }
    

    button:hover {
        background-color: #555;
    }

    .button {
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: block;
        margin: 0 auto;
        margin-bottom: 10px;
    }
    

    .button:hover {
        background-color: #555;
    }


    .qa-section {
        margin-top: 30px;
    }

    .qa {
        margin-bottom: 20px;
    }

    .question {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .answer {
        font-size: 18px;
        color: #666;
    }
</style>