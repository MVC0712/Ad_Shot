<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['id'];
$machine_error_start_time = $_POST['machine_error_start_time'];
$machine_error_end_time = $_POST['machine_error_end_time'];

$datetime = date("Y-m-d H:i:s");
try {
    $sql = "UPDATE t_machine_runtime SET 
    start_time = '$machine_error_start_time' ,
    end_time = '$machine_error_end_time'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>