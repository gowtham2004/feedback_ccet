<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {
        $stmt = $dbh->prepare("SELECT * FROM student where mentorid=:mentorid");
        $stmt->bindParam(':mentorid', $_SESSION["faculty_id"]);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $row) {
                $studentid = $row["ID"];
                $staffid = $_SESSION["faculty_id"];
                // $feedback = $_POST["feedback" . $row["ID"]];
                $remarks = $_POST["remark" . $row["ID"]];

                $stmt = $dbh->prepare("INSERT INTO feedback (studentid, staffid, remarks) VALUES (:studentid, :staffid, :remarks)");
                $stmt->bindParam(':studentid', $studentid);
                $stmt->bindParam(':staffid', $staffid);
                // $stmt->bindParam(':feedback', $feedback);
                $stmt->bindParam(':remarks', $remarks);
                $stmt->execute();

                echo "<script>alert('Feedback added.');window.location.href = 'index.php';</script>";
            }
        } else {
            echo "error occurred on writing data";
        }

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }


}

?>