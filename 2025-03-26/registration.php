<?php
    include_once("./db_connect.php");
    include_once("./error_report");

    $id = $_POST['id2'];
    $course_number = $_POST['course_number2'];
    $score = $_POST['score'];
    $midterm_exam = $_POST['midterm_exam'];
    $final_exam = $_POST['final_exam'];
    
    $insert_sql = "INSERT INTO `Regist` VALUES ({$id}, '{$course_number}', '{$score}', {$midterm_exam}, {$final_exam})";
    
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