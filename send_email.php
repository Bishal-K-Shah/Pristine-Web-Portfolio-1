<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    

    // Construct the email content
    $to = "bishal.shah2344@gmail.com"; // Replace with the actual client email address
    $subject = "Message to PrestineWeb from ". $first_name;
    $body = "First Name: " . $first_name . "\n";
    $body .= "Last Name: " . $last_name . "\n";
    $body .= "Phone No.: " . $phone . "\n";
    $body .= "Country: " . $country . "\n";
    $body .= "Email: " . $email . "\n";
    $body .= "Message:\n" . $message . "\n\n";
    $body .= "Received via Pristine Softsol Website - ITECH eCommerce project";

    // SendGrid API configuration
    $sendgrid_api_key = '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'; // Replace with your SendGrid API key
    $url = 'https://api.sendgrid.com/v3/mail/send';

    // Prepare cURL request
    $headers = array(
        'Authorization: Bearer ' . $sendgrid_api_key,
        'Content-Type: application/json',
    );

    $data = array(
        'personalizations' => array(
            array(
                'to' => array(
                    array(
                        'email' => $to,
                    ),
                ),
                'subject' => $subject,
            ),
        ),
        'from' => array(
            'email' => 'bishalkumars@students.federation.edu.au', // he sender email address
            'name' => 'RedTeam', // The sender name
        ),
        'content' => array(
            array(
                'type' => 'text/plain',
                'value' => $body,
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
            setTimeout(function() {
                alert('Thank you for your message. Message sent successfully. We will get back to you soon via Email.');
                window.location.href = 'contact.html';
            }, 100);
        </script>";

    } else {
        // Failed to send email
        echo "Oops! Something went wrong. Please try again later.";
    }
}
?>
