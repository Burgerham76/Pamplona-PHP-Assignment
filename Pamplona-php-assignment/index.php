<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Introduction Assignment - Pamplona</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        
        <!-- Task 1: Display Text Using PHP -->
        <?php
            echo "<h1>PHP Introduction Assignment</h1>";
            echo "<p class='intro'>This page is generated using PHP.</p>";
        ?>
        
        <hr>
        
        <!-- Task 3: Dynamic Greeting -->
        <?php
            // Define student name variable
            $studentName = "Pamplona, Aaron Paul D.";
            
            // Display dynamic greeting
            echo "<div class='greeting'>";
            echo "<h2>Welcome, $studentName!</h2>";
            echo "<p>We're glad to have you here.</p>";
            echo "</div>";
        ?>
        
        <hr>
        
        <!-- Task 2: PHP Variables -->
        <?php
            // Define PHP variables
            $student_id = "2024-1031562";
            // Note: $studentName is already defined above
            $course = "BSIT";
            $yearLevel = "2nd Year";
            
            // Display the variables
            echo "<div class='student-info'>";
            echo "<h2>Student Information</h2>";
            echo "<p><strong>Student ID:</strong> " . $student_id . "</p>";
            echo "<p><strong>Name:</strong> " . $studentName . "</p>";
            echo "<p><strong>Course:</strong> " . $course . "</p>";
            echo "<p><strong>Year Level:</strong> " . $yearLevel . "</p>";
            echo "</div>";
        ?>
        
        <!-- Bonus Section -->
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