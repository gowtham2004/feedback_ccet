<?php
session_start();
include_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Add some basic styling for better presentation */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .student-entry {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
        }

        img {
            width: 150px;
            border-radius: 8px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Report | CCET</title>
</head>

<body>
    <h2>Student Search</h2>
    <label for="searchInput">Search by Name:</label>
    <input type="text" id="searchInput" oninput="filterStudents()">
    <div class="container">
        <div class="row">
            <div id="studentContainer">
                <!-- Student entries will be dynamically added here -->
            </div>
            <?php
            $id = $_SESSION['faculty_id'];
            $sql = "SELECT * FROM student WHERE mentorid=:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                ?>
                <div class="modal fade" id="modal<?php echo $row["ID"]; ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                    <?php echo $row["name"]; ?>
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6" style="border-right: 1px solid #ddd;">
                                        <div class="row justify-content-center">
                                            <div class="col-4">
                                                <img src="<?php echo $row['photo']; ?>" alt="<?php $row['photo']; ?>"
                                                    height="150">
                                            </div>
                                            <div class="col-3 justify-content-center align-self-center">
                                                <h5>
                                                    <?php echo $row['rollno']; ?>
                                                </h5>
                                                <h5>
                                                    <?php echo $row['dept']; ?>
                                                </h5>
                                                <h6>
                                                    <?php echo $row['name']; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 overflow-y-auto" style="max-height:600px;">
                                        <h3 class="mb-3">Report</h3>
                                        
                                        <?php

                                        $q = "SELECT * FROM feedback WHERE studentid=:id";
                                        $stmt = $dbh->prepare($q);
                                        $stmt->bindParam(':id', $row["ID"], PDO::PARAM_INT);
                                        $stmt->execute();
                                        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($res as $r) {
                                            // echo "<h3>".$r["remarks"]."</h3>";
                                            ?>
                                            <div class="row">
                                                <div class="col-4">
                                                    <h5>
                                                        <?php
                                                        $dt = date('j M Y', strtotime($r["insertat"]));
                                                        echo $dt;
                                                        ?>
                                                    </h5>
                                                </div>
                                                <div class="col-8">
                                                    <?php echo $r["remarks"]; ?>
                                                </div>
                                                <hr class="my-1 mb-1">
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
            <?php } ?>

        </div>

    </div>

    <script>
        // Sample student data (replace with actual data from your database)
        const students = [
            <?php
            $id = $_SESSION['faculty_id'];
            $sql = "SELECT * FROM student WHERE mentorid=:id";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) { ?>
                , {
                    ID: '<?php echo ($row['ID']) ?>',
                    name: '<?php echo ($row['name']) ?>',
                    rollno: '<?php echo ($row['rollno']) ?>',
                    dept: '<?php echo ($row['dept']) ?>',
                    photo: '<?php echo ($row['photo']) ?>'
                },
            <?php } ?>
        ];

        // Function to filter students based on the search input
        function filterStudents() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const studentContainer = document.getElementById('studentContainer');

            // Clear existing student entries
            studentContainer.innerHTML = '';

            // Filter students based on the search input
            const filteredStudents = students.filter(student => student.name.toLowerCase().includes(searchInput) || student.rollno.toLowerCase().includes(searchInput));

            // Display filtered students
            filteredStudents.forEach(student => {
                const studentEntry = document.createElement('div');
                studentEntry.className = 'student-entry';

                // Add text content
                studentEntry.innerHTML += `
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <img src="${student.photo}" alt="${student.photo}" height="150">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 align-self-center">

                        <h5>
                        ${student.rollno}
                        </h5>
                        <h5>
                        ${student.dept}
                        </h5>
                        <h6>
                        ${student.name}
                        </h6>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3 align-self-center">
                        <button class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modal${student.ID}">
                            View Report
                        </button>
                    </div>
                </div>
                `;

                studentContainer.appendChild(studentEntry);
            });
        }

        // Initial display of all students
        filterStudents();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>