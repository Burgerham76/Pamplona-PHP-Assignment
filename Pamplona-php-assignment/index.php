<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Introduction Assignment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <?php
            echo "<h1>PHP Introduction Assignment</h1>";

            echo "<p class='intro'>This page is generated using PHP.</p>";
        ?>
        
        <hr>

        <?php
            $student_id = "2024-1031562";
            $studentName = "Pamplona, Aaron Paul D."; 
            $course = "BSIT";
            $yearLevel = "2nd Year";
            
            echo "<div class='student-info'>";
            echo "<h2>Student Information</h2>";
            echo "<p><strong>Id:</strong> " . $student_id . "</p>";
            echo "<p><strong>Name:</strong> " . $studentName . "</p>";
            echo "<p><strong>Course:</strong> " . $course . "</p>";
            echo "<p><strong>Year Level:</strong> " . $yearLevel . "</p>";
            echo "</div>";
        ?>

        <div class="bonus">
            <h3>How PHP Works with HTML</h3>
            <?php
                $currentDate = date("F j, Y");
                echo "<p>Today is: $currentDate</p>";
            ?>
            <p>This demonstrates how PHP code can be embedded within HTML.</p>
        </div>
    </div>
</body>
</html>