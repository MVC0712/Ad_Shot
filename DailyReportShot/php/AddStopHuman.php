<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$record_anod_id = $_POST['record_anod_id'];
$stop_human_code = $_POST['stop_human_code'];
$stop_human_start_time = $_POST['stop_human_start_time'];
$stop_human_end_time = $_POST['stop_human_end_time'];

try {
    $sql = "INSERT INTO t_stop_human(line_id, record_id, code_id, start_time, end_time
      ) VALUES (
          1, '$record_anod_id', '$stop_human_code', '$stop_human_start_time', '$stop_human_end_time'
      )";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode("INSERTED");
} 
catch(PDOException $e) {
    echo $e;
}
?>