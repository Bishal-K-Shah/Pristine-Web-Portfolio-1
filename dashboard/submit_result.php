<?php
include '../session.php';

$resultData = $_POST['resultData'];
$userID = $_SESSION['user_id'];



//For testing - create a file and save resultData to it
/*
$file = fopen("resultData.txt", "w");
fwrite($file, $resultData);
fclose($file);
*/

//save file to database

$servername = "localhost";
$username = "root";
$password = "";
$database = "pristine_web_itech_db";

// Establish database connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Prepare the SQL statement with a parameter placeholder
$query = "INSERT INTO customer_data (user_id, user_data_json) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $query); // Prepare the statement
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ss", $userID, $resultData);    // Bind the parameters
    mysqli_stmt_execute($stmt); // Execute the statement
    // Get the invoice ID
    $invoiceID = mysqli_insert_id($conn);
    if (mysqli_stmt_error($stmt)) {
        echo "Error: " . mysqli_stmt_error($stmt); // Check for errors
    } else {
        // Log the invoice ID
        echo "<script>console.log('Saved to database successfully. Invoice ID: $invoiceID');</script>";
    }
    mysqli_stmt_close($stmt); // Close the statement
} else {
    echo "Error preparing SQL statement: " . mysqli_error($conn);
}



//add invoice id to resultData
$resultData = json_decode($resultData, true);
$resultData['invoice_id'] = $invoiceID;
//retrieve email from json
$js_email = $resultData['elements'][15]['answer'];
$resultData = json_encode($resultData);


//make API request to pdf server

function generate($template_id, $api_key, $data)
{
    $url = "https://rest.apitemplate.io/v2/create-pdf?template_id=" . $template_id;
    $headers = array("X-API-KEY: " . $api_key);
    $curl = curl_init();
    if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    if (!$result) {
        return null;
    } else {
        $json_result = json_decode($result, 1);
        if ($json_result["status"] == "success") {
            return $json_result["download_url"];
        } else {
            return null;
        }
    }
}

$tempate_id = "2d177b23a1e226aa";
$api_key = "7460MTUwMjY6MTIxMDU6MUZXNmRXeTlUNEZaeXp5NQ=";
$json_payload = $resultData;
//echo generate($tempate_id,$api_key,$json_payload);

// PDF URL
$pdf_url = generate($tempate_id,$api_key,$json_payload);;


//Save pdf url to database
$query = "UPDATE customer_data SET pdf_url = '$pdf_url' WHERE invoice_id = '$invoiceID'";
$result = mysqli_query($conn, $query);

// Close database connection
mysqli_close($conn);


// Prepare cURL request for downloading the PDF
$ch_pdf = curl_init($pdf_url);
curl_setopt($ch_pdf, CURLOPT_RETURNTRANSFER, true);
$pdf_data = curl_exec($ch_pdf);
curl_close($ch_pdf);

// Encode PDF data for attachment
$pdf_base64 = base64_encode($pdf_data);


//Send email with pdf attachment

$first_name = $_SESSION['first_name'];

//Construct the email content
$to = array($js_email, 'bishal.shah2344@gmail.com'); // Replace with the actual email addresses to send the copy
$subject = "Invoice and Website details from Prestine Web";
$body = "Hi " . $first_name . ",\n";
$body .= "Thank You for completing the questionnaire.\n";
$body .= "Your website details and invoice are attached.";

// SendGrid API configuration
$sendgrid_api_key = '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'; // Replace with your SendGrid API key
$url = 'https://api.sendgrid.com/v3/mail/send';

// Prepare cURL request for sending the email with attachment
$headers = array(
    'Authorization: Bearer ' . $sendgrid_api_key,
    'Content-Type: application/json',
);

$to_array = array();
foreach ($to as $email) {
    $to_array[] = array('email' => $email);
}

$data = array(
    'personalizations' => array(
        array(
            'to' => $to_array,
            'subject' => $subject,
        ),
    ),
    'from' => array(
        'email' => 'bishalkumars@students.federation.edu.au', // Add PristineWeb sender email address and it must be verified with SendGrid.
        'name' => 'RedTeam', // The sender name
    ),
    'content' => array(
        array(
            'type' => 'text/plain',
            'value' => $body,
        ),
    ),
    'attachments' => array(
        array(
            'content' => $pdf_base64,
            'filename' => 'Invoice_Website_Details.pdf', // Change to desired filename
            'type' => 'application/pdf',
            'disposition' => 'attachment',
        ),
    ),
);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Send the email using cURL
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $response;

if ($httpCode === 202) {
    // Email sent successfully

    echo "<script>
            console.log('Email sent successfully');
         </script>";
} else {
    // Failed to send email
    echo "Oops! Something went wrong. Please try again later.";
}



?>