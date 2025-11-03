<style>
    table, th, td {
        border: 1px solid;
    }
</style>

<?php
    include_once("./db_connect.php");
    include_once("./error_report");

    function table_row($row) {
        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<td>{$value}</td>";
        }
        echo "</tr>";
    }

    $select_sql = $_POST['query'];
    
    $result = $conn->query($select_sql);

    echo "<h1>Query Result</h1>
    <p>Query: {$select_sql}</p>";

    if ($result->num_rows > 0) {
    // output data of each row
        echo "<p>result<p>";

        echo "<table>";
        $row = $result->fetch_assoc();

        echo "<tr>";
        foreach ($row as $key => $value) {
            echo "<th>{$key}</th>";
        }
        echo "</tr>";

        table_row($row);

        while($row = $result->fetch_assoc()) {
            table_row($row);
        }
        echo "</table>";
    } else {
        echo "Result 0 or Error: " . $select_sql . "<br>" . $conn->error;
    }

    $conn->close();
?>