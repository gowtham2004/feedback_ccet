<?php
include_once("config.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mentoring Feedback | CCET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://www.chettinadtech.ac.in/assets/images/CCET_Logo.png" alt="Chettinad CET">
            </a>
            <button class="btn btn-danger">LogOut</button>
        </div>
    </nav>

    <div class="container mt-2">
        <div class="row justify-content-center">
            <h2>Mentoring Feedback</h2>
            <?php
            $sql = "SELECT * FROM student ";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                foreach ($result as $row) {
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-2">
                            <img src="<?php echo $row['photo']; ?>" alt="<?php $row['photo']; ?>" height="150">
                        </div>
                        <div class="col-2">
                            <br><br>
                            <h5><?php echo $row['rollno']; ?></h5>
                            <h6><?php echo $row['name']; ?></h6>
                        </div>
                        <div class="col-3">
                            <br><br>
                            <!-- select menu -->
                            <select class="form-select" name="feedback<?php $row["ID"] ?>">
                                <option>Excellent</option>
                                <option>Good</option>
                                <option>Average</option>
                                <option>Bad</option>
                                <option>Very Bad</option>
                            </select>
                        </div>
                        <hr class="my-4">
                    </div>
                <?php
                }
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