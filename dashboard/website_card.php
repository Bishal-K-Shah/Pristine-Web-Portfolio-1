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

$userID = $_SESSION['user_id'];
$db_pdf_url = "";

// Prepare and execute the query
$query = "SELECT * FROM customer_data WHERE user_id = '$userID' ORDER BY invoice_id DESC LIMIT 1";
$result = mysqli_query($conn, $query);

// Check if the query returned any rows
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $dbResultData = $row['user_data_json'];
    $db_pdf_url = $row['pdf_url'];
    //echo "<script>console.log('$db_pdf_url');</script>";

    //separate the json data
    $res = json_decode($dbResultData, true);
    $pages = $res['question2']['answer'];
    //separate using , as deliminater
    $pages = explode(',', $pages);

    echo '
        <div class="card-section">
                <h2>My Website</h2>

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
                <a href="'.$db_pdf_url.'" download="Website_Details.pdf" class="button">Download</a>
                <button onclick="displayPDF()">View</button>
                <button onclick="showQuestionnaire()">New</button>
                </div>
                <iframe id="pdfFrame" width="100%" height="600px" style="display: none;"></iframe>
                
                <div class="qa-section">
                    <div class="qa">
                        <div class="question">Q: How can I contact you?</div>
                        <div class="answer">A: You can reach us at pristine@redTeam.com or by phone at +61234567890.</div>
                    </div>

                    <div class="qa">
                        <div class="question">Q: What is your pricing model?</div>
                        <div class="answer">A: Our pricing is flexible and tailored to meet individual project requirements.
                            Please contact us for details.</div>
                    </div>
                </div>
            </div>
        ';

        //show questionnaire 1
        echo '<script>document.getElementById("first_section").style.display = "none";</script>';
    
} else {
    echo "<script>console.log('No existing website record found!!!');</script>";
}





// Close the database connection
mysqli_close($conn);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Section</title>
</head>


<script>
    function displayPDF() {
        var pdfUrl = "<?php echo $db_pdf_url ?>";
        var iframe = document.getElementById("pdfFrame");
        iframe.src = pdfUrl;
        iframe.style.display = "block";
    }

    function showQuestionnaire(){
        document.getElementById("first_section").style.display = "block";
        window.scrollTo(0, 0);
    }
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    /* Card section styles */
    .card-section {
        box-sizing: border-box;
        max-width: 1100px;
        margin: 30px auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        padding: 30px;
    }

    .card-section h2 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
        text-align: center;
    }

    .lists-container {
        display: flex;
        justify-content: space-evenly;
        margin-bottom: 30px;
    }

    .lists-container ul {
        list-style: none;
        margin-right: 30px;
    }

    .lists-container li {
        margin-bottom: 10px;
        font-size: 18px;
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


</html>