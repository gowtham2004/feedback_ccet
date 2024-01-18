<?php
session_start();
include_once("config.php");

if (isset($_SESSION["faculty_id"])) {
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
                // Fetch all students for the faculty
                $stmt = $dbh->prepare("SELECT * FROM student WHERE mentorid=:mentorid");
                $stmt->bindParam(':mentorid', $_SESSION["faculty_id"]);
                $stmt->execute();
                $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($students) {
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 col-sm-8 mb-3">
                            <label for="studentSelect" class="form-label">Select Student:</label>
                            <select class="form-select" name="studentSelect" id="studentSelect" onchange="displayStudentInfo()">
                                <option value="" selected disabled>Select Student</option>
                                <?php
                                foreach ($students as $student) {
                                    echo "<option value='{$student['ID']}'>{$student['rollno']} - {$student['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                    foreach ($students as $student) {
                        ?>
                        <div class="student-info" id="student<?php echo $student['ID']; ?>" style="display: none;">
                            <form action="">
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
                                    <input type="submit" class="btn btn-warning btn-lg mb-5">
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