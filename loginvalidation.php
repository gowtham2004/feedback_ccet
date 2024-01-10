<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (empty($username) or empty($password)) {
        echo "<script>alert('Enter valid credentials.');</script>";
    } else {
        try {
            $stmt = $dbh->prepare("SELECT * FROM staff WHERE username=:username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user["password"])) {
                $_SESSION["faculty_id"] = $user["ID"];
                
                header("location:index.php");
            } else {
                // Invalid credentials
                echo "<script>
                alert('Invalid username or password.');
                window.location.href = 'login.php';
                </script>";
                
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

?>
