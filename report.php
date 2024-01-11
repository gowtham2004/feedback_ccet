<?php
session_start();
include_once("config.php");
if (isset($_SESSION["faculty_id"])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Mentoring Report | CCET</title>
    <style>
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
                        echo($stmt->rowCount());
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
                        echo($stmt->rowCount());
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
                        echo($date);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
} else
    header("location:login.php");
?>