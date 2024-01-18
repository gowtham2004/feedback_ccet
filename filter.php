<?php
include_once("config.php");
session_start();
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
    <title>Student Search Filter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <hr class="my-4">
                </div>
                `;

                studentContainer.appendChild(studentEntry);
            });
        }

        // Initial display of all students
        filterStudents();
    </script>

</body>

</html>