<?php
session_start();
include_once("config.php");

if (isset($_SESSION["faculty_id"])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $staffid = $_SESSION["faculty_id"];
            $stmt = $dbh->prepare("SELECT * FROM student where mentorid=:mentorid");
            $stmt->bindParam(':mentorid', $_SESSION["faculty_id"]);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                foreach ($result as $row) {
                    $studentid = $row["ID"];
                    if (isset($_POST["remark" . $row["ID"]])) {
                        $remarks = $_POST["remark" . $row["ID"]];
                        $stmt = $dbh->prepare("INSERT INTO feedback (studentid, staffid, remarks) VALUES (:studentid, :staffid, :remarks)");
                        $stmt->bindParam(':studentid', $studentid);
                        $stmt->bindParam(':staffid', $staffid);
                        $stmt->bindParam(':remarks', $remarks);
                        $stmt->execute();
                        echo "<script>alert('Feedback added.');window.location.href = 'index.php';</script>";
                    }

                }
            } else {
                echo "error occurred on writing data";
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    ?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mentoring Feedback | CCET</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <?php include_once("navbar.php"); ?>

        <div class="container" style="margin-top: 70px">
            <div class="row justify-content-center">
                <h2 class="mt-3 mb-3 col-lg-5 text-center">Mentoring Feedback</h2>

                <?php
                $currentDay = date('D');
                $facultyId = $_SESSION["faculty_id"];
                $stmt = $dbh->prepare("SELECT * FROM staff_timetable WHERE staffid = :facultyId AND day = :currentDay AND ('AM' IN (hr1, hr2, hr3, hr4, hr5, hr6, hr7, hr8))");
                $stmt->bindParam(':facultyId', $facultyId);
                $stmt->bindParam(':currentDay', $currentDay);
                $stmt->execute();
                // $timetable = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $isMentoringSessionDay = $stmt->rowCount() > 0;
                echo $isMentoringSessionDay;
                ?>
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 col-sm-8 mb-3">
                        <label for="dateselect" class="form-label">Select Date:</label>
                        <select name="dateselect" class="form-select" id="dateselect" onchange="displayStudentSelect()">
                            <?php
                            if ($isMentoringSessionDay) {
                                $currentDate = date('d-m-Y');
                                echo '<option value="" selected disabled>Select Date</option>';
                                echo "<option value='{$currentDate}'>{$currentDate}</option>";
                            } else {
                                echo "<option value='' selected disabled>No Dates Available</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <?php

                if ($isMentoringSessionDay) {

                    // Fetch all students for the faculty
                    $stmt = $dbh->prepare("SELECT * FROM student WHERE mentorid=:mentorid");
                    $stmt->bindParam(':mentorid', $_SESSION["faculty_id"]);
                    $stmt->execute();
                    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($students) {
                        ?>
                        <div id="studentsselection" style="display: none;">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-md-6 col-sm-8 mb-3">
                                    <label for="studentSelect" class="form-label">Select Student:</label>
                                    <select class="form-select" name="studentSelect" id="studentSelect"
                                        onchange="displayStudentInfo()">
                                        <option value="" selected disabled>Select Student</option>
                                        <?php
                                        foreach ($students as $student) {
                                            echo "<option value='{$student['ID']}'>{$student['rollno']} - {$student['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach ($students as $student) {
                            ?>
                            <div class="student-info" id="student<?php echo $student['ID']; ?>" style="display: none;">
                                <form method="post">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-2 col-md-3 col-sm-6 align-self-center">
                                            <img src="<?php echo $student['photo']; ?>" alt="<?php $student['photo']; ?>" height="150">
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-6 align-self-center">
                                            <h5>
                                                <?php echo $student['rollno']; ?>
                                            </h5>
                                            <h5>
                                                <?php echo $student['dept']; ?>
                                            </h5>
                                            <h6>
                                                <?php echo $student['name']; ?>
                                            </h6>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-10 align-self-center">
                                            <label for="remark<?php echo $student["ID"]; ?>" class="form-label">Remarks</label>
                                            <textarea class="form-control" rows=3 name="remark<?php echo $student["ID"]; ?>"
                                                placeholder="Remarks" oninput="validateInput(this)"></textarea>
                                        </div>
                                        <!-- <hr class="my-4"> -->
                                    </div>
                                    <div class="d-grid gap-2 mx-auto col-2 m-5">
                                        <input type="submit" class="btn btn-warning mb-5">
                                    </div>
                                </form>
                            </div>
                            <?php
                        }
                        ?>



                        <script>
                            function displayStudentInfo() {
                                var studentId = document.getElementById("studentSelect").value;

                                var studentDivs = document.querySelectorAll('.student-info');
                                console.log(studentDivs);
                                studentDivs.forEach(function (div) {
                                    div.style.display = 'none';
                                });


                                if (studentId !== "") {
                                    // Display the selected student div
                                    var selectedStudentDiv = document.getElementById("student" + studentId);
                                    if (selectedStudentDiv) {
                                        selectedStudentDiv.style.display = "block";
                                    }
                                }
                            }

                            function validateInput(textarea) {
                                textarea.value = textarea.value.replace(/[^a-zA-Z0-9.,? ]/g, '');
                            }
                        </script>

                        <?php
                    } else {
                        echo "<p>No students found for mentoring.</p>";
                    }
                    ?>
                    <script>
                        function displayStudentSelect() {
                            var dateselect = document.getElementById("dateselect").value;
                            if (dateselect !== "") {
                                document.getElementById("studentsselection").style.display = "block";
                            }
                        }
                    </script>
                    <?php
                }

                ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else {
    header("location:login.php");
}
?>