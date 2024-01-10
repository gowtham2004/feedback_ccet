<?php
include_once("config.php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback | CCET</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://www.chettinadtech.ac.in/assets/images/CCET_Logo.png" alt="Chettinad CET">
            </a>
            <button class="btn btn-warning">Login</button>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-8">
                <h1 class="mb-3">Feedback</h1>
                <form action="action.php" method="post">
                    <label class="form-label" for="faculty">Select Faculty</label>
                    <select class="form-select mb-3" name="faculty" id="faculty">
                        <?php
                        $sql = "SELECT * FROM staff";
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($result) {
                            foreach ($result as $row) {
                                //echo "<option value='" . $row['ID'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No staff found</option>";
                        }
                        ?>
                    </select>
                    <label class="form-label" for="student">Select Student</label>
                    <select class="form-select mb-3" name="student" id="student">
                        <?php
                        $sql = "SELECT * FROM student";
                        $stmt = $dbh->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if ($result) {
                            foreach ($result as $row) {
                                //echo "<option value='" . $row['ID'] . "'>" . $row['name'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No student found</option>";
                        }
                        ?>
                    </select>
                    <label class="form-label" for="date">Date</label>
                    <input class="form-control mb-3" type="date" name="date" id="date">
                    <label class="form-label" for="feedback">Feedback</label>
                    <input class="form-control mb-3" type="text" name="feedback" id="feedback">
                    <input type="submit" class="btn btn-warning">
                </form>
            </div>
        </div>
    </div>
    <script>
        var date = new Date();
        document.getElementById("date").value = date.toISOString().substr(0, 10);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>