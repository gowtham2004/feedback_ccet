<?php
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faculty = $_POST["faculty"];
    $student = $_POST["student"];
    $date = $_POST["date"];
    $feedback = $_POST["feedback"];

    echo $faculty;
    echo $student;
    echo $date;
    echo $feedback;

    try {
        $stmt = $dbh->prepare("INSERT INTO feedback (studentid, staffid, feedback) VALUES (:studentid, :staffid, :feedback)");
        $stmt->bindParam(':studentid', $student);
        $stmt->bindParam(':staffid', $faculty);
        $stmt->bindParam(':feedback', $feedback);
        $stmt->execute();
    
        echo "Data inserted successfully!";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }


}

?>