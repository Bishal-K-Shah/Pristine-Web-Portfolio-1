<!DOCTYPE html>
<html>
<head>
    <title>Website Quote Form</title>
</head>
<body>
    <h1>Website Quote Form</h1>

    <form action="calculate_total.php" method="post">
        <?php
        // Establish database connection
        $db = new mysqli("localhost", "root", "", "test");

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
        ?>
        This is html code.
        
        <?php
        $question1 = $db->query("SELECT * FROM questions")->fetch_assoc();
        echo "<br>".$question1['question_text'];
        ?> </b>
        
        <?php
        $db->close();
        ?>

        
    </form>
</body>
</html>
