<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$record_shot_id = $_POST['record_shot_id'];
$machine_error_start_time = $_POST['machine_error_start_time'];
$machine_error_end_time = $_POST['machine_error_end_time'];

try {
    $sql = "INSERT INTO t_machine_runtime(line_id, record_id, start_time, end_time
      ) VALUES (
          2, '$record_shot_id', '$machine_error_start_time', '$machine_error_end_time'
      )";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode("INSERTED");
} 
catch(PDOException $e) {
    echo $e;
}
?>