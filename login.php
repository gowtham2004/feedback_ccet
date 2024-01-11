<?php
session_start();
if (isset($_SESSION["faculty_id"])) {
    header("location:index.php");
}
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
            <a class="navbar-brand" href="https://www.chettinadtech.ac.in">
                <img src="https://www.chettinadtech.ac.in/assets/images/CCET_Logo.png" alt="Chettinad CET">
            </a>
        </div>

    </nav>
    <div class="container">
        <div class=" row justify-content-center">
            <div class="card mt-5 col-lg-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Mentoring Portal</h5>
                    <form action="loginvalidation.php" method="post">
                        <label for="username" class="form-label mt-3">Username</label>
                        <input type="text" class="form-control mb-3" name="username" id="username">

                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control mb-3" name="password" id="password">

                        <input type="submit" value="LOGIN" class="btn btn-warning">
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>

</html>