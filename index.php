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
        <nav class="navbar fixed-top bg-body-tertiary">
            <div class="container-fluid">
                
                <a class="navbar-brand" href="#">
                    <img src="https://www.chettinadtech.ac.in/assets/images/CCET_Logo.png" alt="Chettinad CET">
                </a>
                <span class="navbar-text">
                    <?php echo "Welcome " . $_SESSION["name"]; ?>
                </span>
                <a href="logout.php" class="btn btn-danger"><i class="fa fa-sign-out"></i> LogOut</a>
            </div>
        </nav>

        <div class="container" style="margin-top:85px;">
            <div class="row justify-content-center">
                <h2>Mentoring Feedback</h2>
                <?php
                $stmt = $dbh->prepare("SELECT * FROM student where mentorid=:mentorid");
                $stmt->bindParam(':mentorid', $_SESSION["faculty_id"]);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    ?>
                    <form action="action.php" method="post">
                        <?php
                        foreach ($result as $row) {
                            ?>
                            <div class="row justify-content-center">
                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <img src="<?php echo $row['photo']; ?>" alt="<?php $row['photo']; ?>" height="150">
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <br><br>
                                    <h5>
                                        <?php echo $row['rollno']; ?>
                                    </h5>
                                    <h6>
                                        <?php echo $row['name']; ?>
                                    </h6>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <br><br>
                                    <!-- select menu -->
                                    <select class="form-select" name="feedback<?php echo $row["ID"]; ?>">
                                        <option>Excellent</option>
                                        <option>Good</option>
                                        <option>Average</option>
                                        <option>Bad</option>
                                        <option>Very Bad</option>
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <br><br>
                                    <input type="text" class="form-control" name="remark<?php echo $row["ID"]; ?>" placeholder="Remarks">
                                </div>
                                <hr class="my-4">
                            </div>
                            <?php
                        }
                        ?>
                        <div class="d-grid gap-2 mx-auto col-2 m-5">
                            <input type="submit" class="btn btn-warning btn-lg mb-5">
                        </div>
                    </form>
                    <?php
                } else {
                    echo "<option value=''>No student found</option>";
                }
                ?>

                <img src="" alt="">

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>

    </html>
    <?php
} else
    header("location:login.php");
?>