<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$record_inspect_id = $_POST['record_inspect_id'];
$inspect_error_id = $_POST['inspect_error_id'];
$ng_quantity = $_POST['ng_quantity'];

try {
    $sql = "INSERT INTO t_record_inspect_error(record_inspect_id, inspect_error_id, ng_quantity
        ) VALUES (
            '$record_inspect_id', '$inspect_error_id', '$ng_quantity'
        )";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode("INSERTED");
} 
catch(PDOException $e) {
    echo $e;
}
?>