<?php
    session_start();
    include_once("config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Report | CCET</title>
</head>
<body>
    <div>
    <?php
        $id = $_SESSION['faculty_id'];
        $sql = "SELECT * FROM student WHERE mentorid=:id";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row) {
            echo('<h3>'.$row['name'].'</h3>');
        }
    ?>
    </div>
</body>
</html>