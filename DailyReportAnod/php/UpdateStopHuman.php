<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['id'];
$stop_human_code = $_POST['stop_human_code'];
$stop_human_start_time = $_POST['stop_human_start_time'];
$stop_human_end_time = $_POST['stop_human_end_time'];

try {
    $sql = "UPDATE t_stop_human SET 
    code_id = '$stop_human_code' ,
    start_time = '$stop_human_start_time' ,
    end_time = '$stop_human_end_time'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>