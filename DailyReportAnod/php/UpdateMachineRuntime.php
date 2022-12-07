<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['id'];
$machine_error_code = $_POST['machine_error_code'];
$machine_error_start_time = $_POST['machine_error_start_time'];
$machine_error_end_time = $_POST['machine_error_end_time'];

$datetime = date("Y-m-d H:i:s");
try {
    $sql = "UPDATE t_machine_runtime SET 
    material = '$material' ,
    material_type = '$material_type' ,
    weight = '$material_weight'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>