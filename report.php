<?php
include_once("config.php");
session_start();

// Assuming you have a PDO connection named $dbh

try {
    // Replace 'your_table', 'feedback.insertat', and other placeholders with your actual table and column names
    $sql = "SELECT DISTINCT DATE(feedback.insertat) as date
            FROM feedback
            INNER JOIN student ON student.id = feedback.studentid
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
    $totalMentoringSessions = $stmt->rowCount();

    // Fetch all entries regardless of the date
    $sqlAllEntries = "SELECT student.id as ID, student.photo as photo, student.regno as rollno, student.dept as dept, student.name as name, feedback.remarks as remarks, feedback.insertat as insertat
                    FROM feedback
                    INNER JOIN student ON student.id = feedback.studentid
                    WHERE feedback.staffid = :councellor
                    ORDER BY feedback.insertat DESC";

    $stmtAllEntries = $dbh->prepare($sqlAllEntries);
    $stmtAllEntries->bindParam(':councellor', $councellor, PDO::PARAM_INT);
    $stmtAllEntries->execute();

    // Fetch all entries
    $allEntries = $stmtAllEntries->fetchAll(PDO::FETCH_ASSOC);

    // Organize all entries into groups based on date
    $groupedAllEntries = [];
    foreach ($allEntries as $entry) {
        $date = date('j M Y', strtotime($entry['insertat']));
        $groupedAllEntries[$date][] = $entry;
    }

    $sqlAllEntries = "SELECT name,id FROM student WHERE councellor=:councellor";
    $stmtAllEntries = $dbh->prepare($sqlAllEntries);
    $stmtAllEntries->bindParam(':councellor', $councellor, PDO::PARAM_STR);
    $stmtAllEntries->execute();

    // Fetch all entries
    $allEntries = $stmtAllEntries->fetchAll(PDO::FETCH_ASSOC);

    // Organize all entries into groups based on date
    $IDmap = [];
    $Names = [];
    foreach ($allEntries as $entry) {
        array_push($Names, $entry['name']);
        $name = $entry['name'];
        $IDmap[$entry['name']] = $entry['id'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">4
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


    <style>
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

        .input-icons i {
            position: absolute;
        }

        .input-icons {
            width: 100%;
            margin-bottom: 10px;
        }

        .icon {
            padding: 10px;
            min-width: 40px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <?php include_once("navbar.php"); ?>
    <div class="container" style="margin-top: 90px">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="colored-box box-1">
                    Total students
                    <br>
                    <?php
                    $staffid = $_SESSION['faculty_id'];
                    $sql = "SELECT * FROM student WHERE councellor=:councellor";
                    $stmt = $dbh->prepare($sql);
                    $stmt->bindParam(':councellor',$staffid, PDO::PARAM_STR);
                    $stmt->execute();
                    echo ($stmt->rowCount());
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="colored-box box-2">
                    Total mentoring sessions
                    <br>
                    <?php
                    // $staffid = $_SESSION['faculty_id'];
                    // $sql = "SELECT * FROM feedback WHERE staffid = $staffid";
                    // $stmt = $dbh->prepare($sql);
                    // $stmt->execute();
                    // echo ($stmt->rowCount());
                    echo $totalMentoringSessions;
                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="colored-box box-3">
                    Last mentoring session
                    <br>
                    <?php
                    $staffid = $_SESSION['faculty_id'];
                    $sql = "SELECT insertat FROM feedback WHERE staffid=:staffid ORDER BY insertat DESC limit 1";
                    $stmt = $dbh->prepare($sql);
                    $stmt->bindParam(':staffid', $staffid);
                    $stmt->execute();
                    $result = $stmt->fetchColumn();
                    $timestamp = strtotime($result);
                    $date = date('j M Y', $timestamp);
                    echo ($date);
                    ?>
                </div>
            </div>
        </div>
        <div class="container mt-3">
            <form action="" method="post" id="selectstudent">
                <div class="row justify-content-center mt-3">
                    <div class="col-lg-4 col-md-6 col-sm-8 mb-3">
                        <label for="selectedStudentID" class="form-label">Select a Student:</label>
                        <select name="selectedStudentID" id="selectedStudentID" class="form-select"
                            onchange="submitform()">
                            <option value="0">Select student</option>
                            <?php foreach ($Names as $row): ?>
                                <option value="<?php echo ($IDmap[$row]); ?>">
                                    <?php echo ($row); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <!-- <button type="submit" name="submit" class="btn btn-primary">Show Entries</button> -->
            </form>
            <script>
                function submitform() {
                    document.getElementById("selectstudent").submit();
                }
            </script>

            <div class="container">
                <div class="row">
                    <div id="studentContainer">
                        <!-- Student entries will be dynamically added here -->
                    </div>
                    <?php
                    if (isset($_POST["selectedStudentID"])) {
                        $studentid = isset($_POST['selectedStudentID']) ? $_POST['selectedStudentID'] : '';
                        if ($studentid == 0) {
                            echo ('<h1>Please select any student</h1>');
                        } else {
                            // Fetch entries based on the selected date and search student name
                            $sql = "SELECT * FROM student WHERE councellor=:councellor AND id=:studid";

                            $stmt = $dbh->prepare($sql);
                            $stmt->bindParam(':councellor', $councellor, PDO::PARAM_INT);
                            $stmt->bindParam(':studid', $studentid, PDO::PARAM_STR);
                            $stmt->execute();
                            if ($stmt->rowCount() == 0) {
                                echo ('<h1>No entries Found</h1>');
                            } else {
                                // Fetch the entries for the selected date and search student name
                                $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($entries as $row) {
                                    ?>
                                    <div class="row gap-3">
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <img src="<?php echo ($row['photo']); ?>" alt="<?php echo ($row['photo']); ?>" height="150">
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-6 align-self-center">
                                            <h2>Personal Details</h2>
                                            <h5>
                                                <strong>RegNo: </strong><?php echo ($row['regno']); ?>
                                            </h5>
                                            <h5>
                                                <strong>Dept: </strong><?php echo ($row['dept']); ?>
                                            </h5>
                                            <h5>
                                                <strong>Name: </strong><?php echo ($row['name']); ?>
                                            </h5>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-3 align-self-center p-2 ms-auto">
                                            <button class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modal<?php echo ($row['id']); ?>">
                                                View Report
                                            </button>
                                        </div>
                                    </div>
                                    <?php
                                    $id = $_SESSION['faculty_id'];
                                    $sql = "SELECT * FROM student WHERE councellor=:id";
                                    $stmt = $dbh->prepare($sql);
                                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($result as $row) {
                                        ?>
                                        <div class="modal fade" id="modal<?php echo $row["id"]; ?>" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            <?php echo $row["name"]; ?>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- <div class="col-6" style="border-right: 1px solid #ddd;">
                                                                <div class="row justify-content-center">
                                                                    <div class="col-4">
                                                                        <img src="<?php //echo $row['photo']; ?>"
                                                                            alt="<?php //$row['photo']; ?>" height="150">
                                                                    </div>
                                                                    <div class="col-3 justify-content-center align-self-center">
                                                                        <h5>
                                                                            <?php //echo $row['regno']; ?>
                                                                        </h5>
                                                                        <h5>
                                                                            <?php //echo $row['dept']; ?>
                                                                        </h5>
                                                                        <h6>
                                                                            <?php //echo $row['name']; ?>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-12 overflow-y-auto" style="max-height:600px;">
                                                                <h3 class="mb-3 text-center">Report</h3>

                                                                <?php

                                                                $q = "SELECT * FROM feedback WHERE studentid=:id";
                                                                $stmt = $dbh->prepare($q);
                                                                $stmt->bindParam(':id', $row["id"], PDO::PARAM_INT);
                                                                $stmt->execute();
                                                                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                foreach ($res as $r) {
                                                                    // echo "<h3>".$r["remarks"]."</h3>";
                                                                    ?>
                                                                    <div class="row">
                                                                        <div class="col-8">
                                                                            <h5><strong>
                                                                                <?php
                                                                                $dt = date('j M Y', strtotime($r["insertat"]));
                                                                                echo $dt;
                                                                                ?>
                                                                            </strong></h5>
                                                                        </div>
                                                                        <div class="col-12" style="text-indent: 30px;">
                                                                            <?php echo $r["remarks"]; ?>
                                                                        </div>                                                                                                                            
                                                                        <hr class="my-1 mb-1">
                                                                        <br>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <!-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                }
                            }
                        }
                    } ?>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>

</body>

</html>