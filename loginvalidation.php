<?php
session_start();
include_once("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (empty($username) or empty($password)) {
        ?>
        <script>
            alert("Enter valid credentials");
            window.location.href = "login.php";
        </script>
        <?php
        
    } else {
        try {
            $stmt = $dbh->prepare("SELECT * FROM staff WHERE username=:username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user["password"])) {
                $_SESSION["faculty_id"] = $user["id"];
                $_SESSION["name"] = $user["name"];

                header("location:index.php");
            } else {
                // Invalid credentials
                ?><script>
                alert('Invalid username or password.');
                window.location.href = 'login.php';
                </script>
                <?php
                
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}

?>
