<?php
    include_once("./db_connect.php");
    include_once("./error_report");

    $course_number = $_POST['course_number'];
    $subject = $_POST['subject'];
    $credit = $_POST['credit'];
    $department = $_POST['department2'];
    $professor = $_POST['professor'];

    $insert_sql = "INSERT INTO `Subject` VALUES ('{$course_number}', '{$subject}', {$credit}, '{$department}', '{$professor}')";
    
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