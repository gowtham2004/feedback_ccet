<?php
include_once('config.php');
session_start();
// Assuming you have a PDO connection named $dbh

try {
    // Replace 'your_table', 'feedback.insertat', and other placeholders with your actual table and column names
    $sql = "SELECT DISTINCT DATE(feedback.insertat) as date
            FROM feedback
            INNER JOIN student ON student.ID = feedback.studentid
            WHERE feedback.staffid = :councellor
            ORDER BY date DESC";

    // Replace $_SESSION["faculty_id"] with the appropriate variable or value for :councellor
    $councellor = $_SESSION["faculty_id"];

    // Prepare and execute the query
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':councellor', $councellor, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the available dates
    $availableDates = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all entries regardless of the date
    $sqlAllEntries = "SELECT student.id as ID, student.photo as photo, student.rollno as rollno, student.dept as dept, student.name as name, feedback.remarks as remarks, feedback.insertat as insertat
                    FROM feedback
                    INNER JOIN student ON student.ID = feedback.studentid
                    WHERE feedback.staffid = :councellor
                    ORDER BY feedback.insertat DESC";

    $stmtAllEntries = $dbh->prepare($sqlAllEntries);
    $stmtAllEntries->bindParam(':councellor', $councellor, PDO::PARAM_INT);
    $stmtAllEntries->execute();

    // Fetch all entries
    $allEntries = $stmtAllEntries->fetchAll(PDO::FETCH_ASSOC);

    // Organize all entries into groups based on date
    $Allstudents = [];
    foreach ($allEntries as $entry) {
        $groupedAllEntries[][] = $entry;
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Entries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include Bootstrap CSS (either download and host it or use a CDN) -->
    <style>
        body {
            padding: 20px;
        }
        .container {
            max-width: 800px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        h2, h3 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <form action="" method="post">
        <div class="mb-3">
            <label for="selectedDate" class="form-label">Select a Date:</label>
            <select name="selectedDate" id="selectedDate" class="form-select">
                <option value="all">All</option>
                <?php foreach ($availableDates as $date) : ?>
                    <option value="<?= $date['date'] ?>"><?= date('j M Y', strtotime($date['date'])) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="searchStudentName" class="form-label">Search Student Name:</label>
            <input type="text" name="searchStudentName" id="searchStudentName" class="form-control" placeholder="Enter student name">
        </div>
        <button type="submit" class="btn btn-primary">Show Entries</button>
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedDate = isset($_POST['selectedDate']) ? $_POST['selectedDate'] : 'all';
        $searchStudentName = isset($_POST['searchStudentName']) ? $_POST['searchStudentName'] : '';

        // Fetch entries based on the selected date and search student name
        if ($selectedDate !== 'all') {
            $formattedDate = date('Y-m-d', strtotime($selectedDate));
            $sql = "SELECT student.id as ID, student.photo as photo, student.rollno as rollno, student.dept as dept, student.name as name, feedback.remarks as remarks, feedback.insertat as insertat
                    FROM feedback
                    INNER JOIN student ON student.ID = feedback.studentid
                    WHERE feedback.staffid = :councellor
                    AND DATE(feedback.insertat) = :selectedDate
                    AND student.name LIKE :searchStudentName
                    ORDER BY feedback.insertat DESC";
        } else {
            // Display all entries grouped by date
            echo "<h2 class='mt-4'>All Entries</h2>";
            foreach ($groupedAllEntries as $date => $entries) {
                echo "<h3 class='mt-3'>$date</h3>";
                echo "<ul class='mb-4'>";
                foreach ($entries as $entry) {
                    echo "<li>{$entry['name']} - {$entry['remarks']}</li>";
                }
                echo "</ul>";
            }
            return;
        }

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':councellor', $councellor, PDO::PARAM_INT);
        $stmt->bindParam(':selectedDate', $formattedDate, PDO::PARAM_STR);
        $stmt->bindValue(':searchStudentName', "%$searchStudentName%", PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the entries for the selected date and search student name
        $filteredEntries = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display the entries for the selected date and search student name
        echo "<h2 class='mt-4'>";
        echo "Entries for " . date('j M Y', strtotime($selectedDate));
        echo "</h2>";
        echo "<ul class='mb-4'>";
        foreach ($filteredEntries as $entry) {
            echo "<li>{$entry['name']} - {$entry['remarks']}</li>";
        }
        echo "</ul>";
    }

    ?>

</div>

<!-- Include Bootstrap JS (either download and host it or use a CDN) -->
<script src="path/to/bootstrap.js"></script>

</body>
</html>