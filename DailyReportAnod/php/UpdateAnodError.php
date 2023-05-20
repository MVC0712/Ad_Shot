<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['id'];
$anod_error_id = $_POST['anod_error_id'];
$ng_quantity = $_POST['ng_quantity'];

$datetime = date("Y-m-d H:i:s");
try {
    $sql = "UPDATE t_record_anod_error SET 
    anod_error_id = '$anod_error_id' ,
    ng_quantity = '$ng_quantity'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>