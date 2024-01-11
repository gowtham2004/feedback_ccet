<?php
include_once("config.php");
session_start();

// Assuming you have a PDO connection named $dbh

try {
    // Replace 'your_table', 'feedback.insertat', and other placeholders with your actual table and column names
    $sql = "SELECT DISTINCT DATE(feedback.insertat) as date
            FROM feedback
            INNER JOIN student ON student.ID = feedback.studentid
            WHERE feedback.staffid = :mentorid
            ORDER BY date DESC";

    // Replace $_SESSION["faculty_id"] with the appropriate variable or value for :mentorid
    $mentorId = $_SESSION["faculty_id"];

    // Prepare and execute the query
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':mentorid', $mentorId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the available dates
    $availableDates = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all entries regardless of the date
    $sqlAllEntries = "SELECT student.id as ID, student.photo as photo, student.rollno as rollno, student.dept as dept, student.name as name, feedback.remarks as remarks, feedback.insertat as insertat
                    FROM feedback
                    INNER JOIN student ON student.ID = feedback.studentid
                    WHERE feedback.staffid = :mentorid
                    ORDER BY feedback.insertat DESC";

    $stmtAllEntries = $dbh->prepare($sqlAllEntries);
    $stmtAllEntries->bindParam(':mentorid', $mentorId, PDO::PARAM_INT);
    $stmtAllEntries->execute();

    // Fetch all entries
    $allEntries = $stmtAllEntries->fetchAll(PDO::FETCH_ASSOC);

    // Organize all entries into groups based on date
    $groupedAllEntries = [];
    foreach ($allEntries as $entry) {
        $date = date('j M Y', strtotime($entry['insertat']));
        $groupedAllEntries[$date][] = $entry;
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

        h2,
        h3 {
            margin-bottom: 10px;
        }
        .colored-box {
            height: 100px;
            text-align: center;
            padding: 20px;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .box-1 {
            background-color: #3498db;
            /* Blue */
        }

        .box-2 {
            background-color: #e74c3c;
            /* Red */
        }

        .box-3 {
            background-color: #2ecc71;
            /* Green */
        }
    </style>
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="colored-box box-1">
                    Total students
                    <br>
                    <?php
                    $staffid = $_SESSION['faculty_id'];
                    $sql = "SELECT * FROM student WHERE mentorid = $staffid";
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();
                    echo ($stmt->rowCount());
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="colored-box box-2">
                    Total mentoring sessions
                    <br>
                    <?php
                    $staffid = $_SESSION['faculty_id'];
                    $sql = "SELECT * FROM feedback WHERE staffid = $staffid";
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();
                    echo ($stmt->rowCount());
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="colored-box box-3">
                    Last mentoring session
                    <br>
                    <?php
                    $staffid = $_SESSION['faculty_id'];
                    $sql = "SELECT insertat FROM feedback WHERE staffid = $staffid ORDER BY insertat DESC limit 1";
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchColumn();
                    $timestamp = strtotime($result);
                    $date = date('j M Y', $timestamp);
                    echo ($date);
                    ?>
                </div>
            </div>
            <div class="container">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="selectedDate" class="form-label">Select a Date:</label>
                        <select name="selectedDate" id="selectedDate" class="form-select">
                            <option value="all">All</option>
                            <?php foreach ($availableDates as $date): ?>
                                <option value="<?= $date['date'] ?>">
                                    <?= date('j M Y', strtotime($date['date'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="searchStudentName" class="form-label">Search Student Name:</label>
                        <input type="text" name="searchStudentName" id="searchStudentName" class="form-control"
                            placeholder="Enter student name">
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
                    WHERE feedback.staffid = :mentorid
                    AND DATE(feedback.insertat) = :selectedDate
                    AND student.name LIKE :searchStudentName
                    ORDER BY feedback.insertat DESC";
                    } 
                    
                    //Fetch All entries
                    else {
                        $availableDates = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        // Fetch all entries regardless of the date
                        $sqlAllEntries = "SELECT student.id as ID, student.photo as photo, student.rollno as rollno, student.dept as dept, student.name as name, feedback.remarks as remarks, feedback.insertat as insertat
                    FROM feedback
                    INNER JOIN student ON student.ID = feedback.studentid
                    WHERE feedback.staffid = :mentorid AND student.name LIKE :searchStudentName
                    ORDER BY feedback.insertat DESC";

                        $stmtAllEntries = $dbh->prepare($sqlAllEntries);
                        $stmtAllEntries->bindValue(':searchStudentName', "%$searchStudentName%", PDO::PARAM_STR);
                        $stmtAllEntries->bindParam(':mentorid', $mentorId, PDO::PARAM_INT);
                        $stmtAllEntries->execute();

                        // Fetch all entries
                        $allEntries = $stmtAllEntries->fetchAll(PDO::FETCH_ASSOC);

                        // Organize all entries into groups based on date
                        $groupedAllEntries = [];
                        foreach ($allEntries as $entry) {
                            $date = date('j M Y', strtotime($entry['insertat']));
                            $groupedAllEntries[$date][] = $entry;
                        }
                        // Display all entries grouped by date
                        echo "<h2 class='mt-4'>All Entries</h2>";
                        foreach ($groupedAllEntries as $date => $entries) {
                            echo "<h3 class='mt-3'>$date</h3>";
                            echo "<ul class='mb-4'>";
                            foreach ($entries as $entry) { ?>
                                <div class="row justify-content-center">
                                    <div class="col-lg-3 col-md-3 col-sm-6">
                                        <img src="<?php echo $entry['photo']; ?>" alt="<?php $entry['photo']; ?>" height="150">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 align-self-center">

                                        <h5>
                                            <?php echo $entry['rollno']; ?>
                                        </h5>
                                        <h5>
                                            <?php echo $entry['dept']; ?>
                                        </h5>
                                        <h6>
                                            <?php echo $entry['name']; ?>
                                        </h6>
                                    </div>
                                    <div class="col-lg-3 col-md-4 col-sm-10 align-self-center">
                                        <label for="remark<?php echo $entry["ID"]; ?>" class="form-label">Remarks</label>
                                        <p class="form-control">
                                            <?php
                                            if (strlen($entry['remarks']) == 0) {
                                                echo ("none");
                                            } else {
                                                echo ($entry['remarks']);
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <hr class="my-4">
                                </div>
                            <?php }
                            echo "</ul>";
                        }
                        return;
                    }

                    $stmt = $dbh->prepare($sql);
                    $stmt->bindParam(':mentorid', $mentorId, PDO::PARAM_INT);
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
                    foreach ($filteredEntries as $entry) { ?>
                        <div class="row justify-content-center">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <img src="<?php echo $entry['photo']; ?>" alt="<?php $entry['photo']; ?>" height="150">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-6 align-self-center">

                                <h5>
                                    <?php echo $entry['rollno']; ?>
                                </h5>
                                <h5>
                                    <?php echo $entry['dept']; ?>
                                </h5>
                                <h6>
                                    <?php echo $entry['name']; ?>
                                </h6>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-10 align-self-center">
                                <label for="remark<?php echo $entry["ID"]; ?>" class="form-label">Remarks</label>
                                <p class="form-control">
                                    <?php
                                    if (strlen($entry['remarks']) == 0) {
                                        echo ("none");
                                    } else {
                                        echo ($entry['remarks']);
                                    }
                                    ?>
                                </p>
                            </div>
                            <hr class="my-4">
                        </div>
                    <?php }
                    echo "</ul>";
                }

                ?>

            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous"></script>

</body>

</html>