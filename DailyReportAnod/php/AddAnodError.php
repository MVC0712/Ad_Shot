<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$record_anod_id = $_POST['record_anod_id'];
$anod_error_id = $_POST['anod_error_id'];
$ng_quantity = $_POST['ng_quantity'];

try {
    $sql = "INSERT INTO t_record_anod_error(record_anod_id, anod_error_id, ng_quantity
        ) VALUES (
            '$record_anod_id', '$anod_error_id', '$ng_quantity'
        )";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode("INSERTED");
} 
catch(PDOException $e) {
    echo $e;
}
?>