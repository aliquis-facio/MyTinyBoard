<?php
    include_once("./db_connect.php");
    include_once("./error_report");

    $id = $_POST['id'];
    $name = $_POST['name'];
    $grade = $_POST['grade'];
    $department = $_POST['department'];

    $insert_sql = "INSERT INTO `Student` VALUES ({$id}, '{$name}', {$grade}, '{$department}')";
    
    if ($conn->query($insert_sql) === TRUE) {
        echo "New record created successfully";
        echo "<script>
            location.href = './index.php';
            </script>";
    } else {
        echo "Error: " . $insert_sql . "<br>" . $conn->error;
    }

    $conn->close();

?>