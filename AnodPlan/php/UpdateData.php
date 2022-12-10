<?php
require_once('../../connection.php');
$dbh = new DBHandler();
if ($dbh->getInstance() === null) {
    die("No database connection");
}
$id = $_POST['targetId'];
$date_plan = $_POST['date_plan'];
$machine_id = $_POST['machine_id'];
$quantity = $_POST['quantity'];
$note = $_POST['note'];

try {
    $sql = "UPDATE t_anod_plan SET 
    machine_id = '$machine_id' ,
    quantity = '$quantity' ,
    note = '$note' ,
    product_date = '$date_plan'
    WHERE id= '$id'";
    $stmt = $dbh->getInstance()->prepare($sql);
    $stmt->execute();
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} 
catch(PDOException $e) {
    echo $e;
}
?>